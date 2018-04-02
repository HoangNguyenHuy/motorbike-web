;(function($) {
    "use strict";

    var URL_avatar_change = '';
    var PictureUpdate = (function () {
        function PictureUpdate() {
            this.profile = $('.profile-pic');
            this.updateProfile();
        }
        PictureUpdate.prototype.updateProfile = function () {
            var self = this;
            var input = $('input', this.profile);
            var inputAvatar = $('#changePicture');
            input.on('change',function ()
            {
                var file_data = inputAvatar.prop("files")[0];
                if (!file_data){
                    return;
                }
                var type = file_data.type;
                var match= ["image/gif", "image/png", "image/jpg", "image/jpeg"];
                if(match.includes(type)){
                    URL_avatar_change = URL.createObjectURL(file_data);
                    var form_data = new FormData();
                    form_data.append("avatar", file_data);
                    $('#cropModal').modal('show');
                    // $('#myModal').modal('hide');
                    // self.fireAJAX('/save-avatar', form_data, self.profile);
                }
                else {
                    alert('Chỉ được upload file ảnh');
                    inputAvatar.val('');
                }
            });
        };
        PictureUpdate.prototype.fireAJAX = function (url, avatar, element) {
            var self = this;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: avatar,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    self.startLoader(element);
                },
                success: function(res) {
                    setTimeout(function () {
                        self.destroyLoader(element);
                        $('img', element).fadeIn('fast').attr({'src':URL_avatar_change, 'alt':res});
                    }, 500);
                    $('#avatar').val(res);
                }
            });
        };
        PictureUpdate.prototype.startLoader = function (element) {
            var loader = $('.layer', element);
            loader.addClass("visible");
        };
        PictureUpdate.prototype.destroyLoader = function (element) {
            var loader = $('.layer', element);
            loader.removeClass("visible");
        };
        return PictureUpdate;
    }());

    window.UserInfo = {
        init : function($form){
            this.initCrop();
            this.initForm($form);
        },
        initCrop: function(){
            // TODO test crop image
            // imageResize in dropupload.js of olivia
            // how to resize image file?
            var imageResize = function(file, max_size, callback) {
                var resizedImg;
                if(file.type.match(/image.*/)) {
                    var reader = new FileReader();
                    reader.onload = function (readerEvent) {
                        var image = new Image();
                        image.onload = function (imageEvent) {
                            var canvas = document.createElement('canvas'),
                                width = image.width,
                                height = image.height;
                            if (width > height) {
                                if (width > max_size) {
                                    height *= max_size / width;
                                    width = max_size;
                                }
                            } else {
                                if (height > max_size) {
                                    width *= max_size / height;
                                    height = max_size;
                                }
                            }
                            canvas.width = width;
                            canvas.height = height;
                            canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                            resizedImg = canvas.toDataURL(file.type);
                            if($.isFunction(callback)){
                                callback(resizedImg);
                            }
                        }
                        image.src = readerEvent.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            };
            // imageResize in dropupload.js of olivia
            var $uploadCrop = $('#upload-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });
            $('#changePicture').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });

                };
                reader.readAsDataURL(this.files[0]);
            });
            $('.upload-result').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (resp) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: "/save-avatar",
                        data: {"image":resp},
                        success: function (data) {
                            var html = '<img src="' + resp + '" />';
                            $("#upload-demo-i").html(html);
                        }
                    });
                });
            });
        },
        initForm: function ($form) {
            var self = this;
            var rules = {
                name : {
                    validators: {
                        notEmpty: {
                            message: 'Please enter full name'
                        }
                    }
                },
                email : {
                    validators: {
                        notEmpty: {
                            message: 'Please enter email'
                        },
                        regexp: {
                            regexp: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
                            message: 'Invalid email'
                        }
                    }
                },
                phone_number : {
                    validators: {
                        notEmpty: {
                            message: 'Please enter phone number'
                        },
                        phone: {
                            country: 'GB',
                            message: 'Invalid phone number'
                        }
                    }
                }
            };
            Base_Validator.set_validator($form, rules, {live_validate: "disabled"});
            $form.on('success.form.bv', function(e) {
                e.preventDefault();
                self.doSubmit($form);
            });
        },
        doSubmit: function($form) {
            var self = this;
            var url = $form.attr('action') + '/1';
            JBase.send(url,{
                type: 'POST',
                data: $form.serialize(),
                success: function(res) {
                    if (res.success) {
                        $form.find("input[type='submit']").addClass('hide');
                        JBase.setDefaultValue($form);
                        JBase.message(ostring.changes_saved);
                    } else {
                        self.handleSubmitError($form, res);
                    }
                    // TODO check this method in olivia
                    // DocumentListener.unbind();
                }
            });
        },
        handleSubmitError: function ($form, res) {
            $form.trigger('submit_error', res);
        }
    };
    $(document).ready(function () {
        new PictureUpdate;
        JBase.setDefaultValue($(this).find('#userInfoForm'));
        JBase.detectFormChange($(this).find('#userInfoForm'));
        window.UserInfo.init($(this).find('#userInfoForm'));
    });
})(jQuery);
