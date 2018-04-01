/**
 * @type JBase
 */

var JBase = (function () {
    var self = this;

    function setDefaultValue($form) {
        var $inputs = $form.find('input[type!=submit][type!=button]');
        var json = {};
        $inputs.filter(function () {
            var key = $(this).attr('name');
            var default_value = '';
            if ($(this).is(':checkbox') || $(this).is(':radio')) {
                default_value = this.checked;
            } else {
                default_value = this.value;
            }
            json[key] = default_value;
        });
        window.jsonDefaultValue = JSON.stringify(json);
    }

    function detectFormChange($form) {
        var $inputs = $form.find('input[type!=submit][type!=button]');
        $inputs.on('keyup change', function() {
            var default_value = window.jsonDefaultValue;
            var json = {};
            $inputs.filter(function () {
                var key = $(this).attr('name');
                var value = '';
                if ($(this).is(':checkbox') || $(this).is(':radio')) {
                    value = this.checked;
                } else {
                    value = this.value;
                }
                json[key] = value;
            });
            json = JSON.stringify(json);
            if (json === default_value) {
                $('.btn-save').addClass('hide')
            } else {
                $('.btn-save').removeClass('hide');
            }
        });
    }

    this.isFunction= function (vrbl) {
        return typeof vrbl == 'function';
    };

    function csrfSafeMethod(method) {
        // these HTTP methods do not require CSRF protection
        return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
    }

    this.send = function (url, params, output) {
        //html, json, jsonp, script, or text.
        var outputParams = output || false;
        var _self = this;
        params.beforeSend = function (xhr, settings) {
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                var csrftoken = $('meta[name="csrf-token"]').attr('content');
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        };
        var requestParams = {
            type: params.type || 'POST',
            statusCode: {
                404: function () {
                }
            },
            context: params.context || null,
            crossDomain: params.crossDomain || false
        };
        if (!params.data) {
            var parameters = {};
            requestParams.data = parameters;
        } else {
            var parameters = '';
            if (typeof params.data == 'object') {
                parameters = params.data;
            } else {
                parameters = params.data;
            }
            requestParams.data = parameters;
        }

        if (outputParams) {
            requestParams.dataType = outputParams;
        }
        if (params.xhrFields) {
            requestParams.xhrFields = {
                withCredentials: true
            }
        }
        requestParams.success = function (data) {
            if (params.success && self.isFunction(params.success)) {
                if (typeof data !== 'object') {
                    try {
                        data = $.parseJSON(data);
                    } catch (e) {
                    }
                }
                params.success(data);
            }
        };
        requestParams.complete = function (xhr, textStatus) {
            if (xhr.status == 401 || xhr.status == 432) {
                window.location = '/';
            }
            if (params.complete && self.isFunction(params.complete)) {
                params.complete(xhr, textStatus);
            }
        };
        if (params.beforeSend && self.isFunction(params.beforeSend)) {
            requestParams.beforeSend = function (xhr, settings) {
                params.beforeSend(xhr, settings);
            };
        }
        var request = jQuery.ajax(url, requestParams);
        return request;
    };
    return {
        send: send,
        detectFormChange: detectFormChange,
        setDefaultValue: setDefaultValue
    };
})(jQuery);

var Base_Validator = (function () {
    /*
     Validate using BootstrapValidator
     http://bv.doc.javake.cn/validators/
     */
    var validate_errors = {
        'required': 'This field is required',
        'number': 'Enter a valid number',
        'email': 'Enter a valid email address',
        'url': 'Enter a valid URL',
        'required_suffix': ' is required',
        'unique_suffix': ' must be unique.'
    };


    var rule_required = {
        validators: {
            notEmpty: {
                message: validate_errors.required
            }
        }
    };
    function set_validator($form, rules, options) {
        options = $.extend({
            feedbackIcons: false,
            live_validate: "enabled"
        }, options);

        $.each(rules, function(i, rule) {
            rule.validators.blank = {};
        });

        $form.bootstrapValidator({
            fields: rules,
            feedbackIcons: options.feedbackIcons,
            live: options.live_validate
        }).on('reset', function () {
            $form.data('bootstrapValidator').resetForm(true);
        }).on('submit_error', function(ev, errors) {
            if (typeof errors == 'object' && 'errors' in errors) {
                errors = errors['errors'];
            }

            var bv = $form.data('bootstrapValidator');
            $.each(errors, function(index, error){
                if (error['field'] !== ''){
                    bv.updateMessage(error['field'], 'blank', error['message']);
                    bv.updateStatus(error['field'], 'INVALID', 'blank');
                } else {
                    $form.trigger('non_field_error', error);
                }
            });
        }).on('non_field_error', function(ev, error) {
            var $error = "<p>" + error['message'] + "</p>";
            if ($form.find('.alert').length) {
                $form.find('.alert').html($error);
            } else {
                $form.prepend("<div class='alert alert-danger text-center'>" + $error + "</div>");
            }
            $form.on('submit', function() {
                $form.find('.alert').remove();
            });
        });
    }

    function get_required_suffix_error(error) {
        return error + validate_errors.required_suffix;
    }

    function get_unique_suffix_error(error) {
        return error + validate_errors.unique_suffix;
    }

    //Return public function, variable
    return {
        validate_errors: validate_errors,
        rule_required: rule_required,
        set_validator: set_validator,
        get_required_suffix_error: get_required_suffix_error,
        get_unique_suffix_error: get_unique_suffix_error
    };
})(jQuery);


/*
 * JBase alert or confirm bootstrap
 */
$.fn.extend(JBase, {
    _target: null,
    _df_opts: {
        title: ['The page at', location.hostname, 'says'].join(' '),
        body: '{Body}',
        ok_text: 'Ok',
        cancel_text: 'Cancel',
        ok_callback: null,
        cancel_callback: null,
        on_show: null,
        on_hide: null,
        on_render: null,
        hide_on_success: true,
    },
    _opts: {},
    _buildModal: function (opts, is_alert) {
        var self = this;
        if (typeof opts == 'string') {
            opts = {body: opts}
        }
        this._opts = $.extend(this._df_opts, opts)
        this._target = $('.ai-modal.template').clone();
        if (opts.blank) {
            this._buildBlankModal(opts.modal_opts);
        } else {
            this._target.find('.modal-title').html(this._opts.title);
            this._target.find('.modal-body').html(this._opts.body);
            this._target.find('.ok-btn').html(this._opts.ok_text);
            if (this._opts.modal_opts && this._opts.modal_opts.className) {
                this._target.addClass(this._opts.modal_opts.className);
            }
            if (is_alert) {
                this._target.addClass('alert-modal');
                this._target.find('.cancel-btn').remove();
            } else {
                this._target.find('.cancel-btn').html(this._opts.cancel_text);
            }
        }
        this._target.removeClass('template');
        $('body').append(this._target);
        this._target.modal('show');
        this._initEvents();
        return this;
    },
    _initEvents: function () {
        var self = this;
        this._target.on('shown.bs.modal', function (e) {
            if ($.isFunction(self._opts.on_show)) {
                self._opts.on_show($(this));
            }
        }).on('hide.bs.modal', function (e) {
            if ($.isFunction(self._opts.on_hide)) {
                self._opts.on_hide($(this));
            }
            self._target.remove();
        });
        this._target.find('.ok-btn').on('click', function () {
            if ($.isFunction(self._opts.ok_callback)) {
                self._opts.ok_callback();
            }
            if (self._opts.hide_on_success) {
                self._target.modal('hide');
            }
        });
        this._target.find('.cancel-btn').on('click', function () {
            if ($.isFunction(self._opts.cancel_callback)) {
                self._opts.cancel_callback();
            }
            self._target.modal('hide');
        });
        if($.isFunction(self._opts.on_render)){
            self._opts.on_render(self._target);
        }
    },
    _buildBlankModal: function(modal_opts) {
        this._target.find('.modal-footer, .modal-header').remove();
        if (modal_opts.className) {
            this._target.addClass(modal_opts.className);
        }
        this._target.find('.modal-body').addClass("clearfix").html(this._opts.body);
        if (modal_opts.close_el) {
            var $close_el = '<span class="close" data-dismiss="modal">' +  modal_opts.close_el + '</span>';
            this._target.find('.modal-body').append($close_el);
        }
    },
    alert: function (opts) {
        return this._buildModal(opts, true);
    },
    confirm: function (opts) {
        return this._buildModal(opts, false);
    },
    modal: function(opts) {
        opts.blank = typeof(opts.blank) == 'undefined' ? true : opts.blank;
        return this._buildModal(opts);
    },
    message_time_out: null,
    getSingleErrorMessage: function(errors) {
        var errorMessage = 'There is something when saving data. Please try again!';
        if (typeof errors == 'object' && 'errors' in errors) {
            errors = errors['errors'];
        }

        if (errors.length > 0) {
            errorMessage = errors[0]['message'];
        }

        return errorMessage;
    },
    message: function (opts, is_error) {
        if (JBase.message_time_out) {
            clearTimeout(JBase.message_time_out);
        }
        if (typeof opts == 'string') {
            opts = {
                message: opts
            }
        }
        var options = {
            timeout: 3000,
            message: '',
            close: {
                text: 'X',
                onClose: function () {

                }
            },
            $ctn: $('#message-ctn')
        };
        options = $.extend(true, options, opts);
        var $ctn = options.$ctn;
        var $action = $ctn.find('.action').first();
        $ctn.find('.message').text(options.message);
        $ctn.toggleClass("error", is_error || false);
        $action.text(options.close.text).unbind('click')
            .bind('click', function () {
                // $ctn.css("opacity", 0);
                $ctn.css("transform", "translateY(-50px)");
                // $ctn.hide();
                if ($.isFunction(options.close.onClose)) {
                    options.close.onClose();
                }
                return false;
            });
        // $ctn.css("opacity", 1);
        $ctn.css("transform", "translateY(50px)");
        // $ctn.show();
        if (options.timeout) {
            JBase.message_time_out = setTimeout(function () {
                // $ctn.css("opacity", 0);
                $ctn.css("transform", "translateY(-50px)");
                // $ctn.hide();
            }, options.timeout);

        }
    },
    error_message: function(opts){
        this.message(opts, true);
    },
    close: function() {
        this._target.modal('hide');
    }
});