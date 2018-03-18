(function($) {
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

    $(document).ready(function () {
        new PictureUpdate;
        // TODO test crop image
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

    });
})(jQuery);
