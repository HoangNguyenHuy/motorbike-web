;(function($) {
    "use strict";

    window.Manufacturer = {
        init : function($form){
            this.initForm($form);
        },
        initForm: function ($form) {
            var self = this;
            var rules = {
                name : {
                    validators: {
                        notEmpty: {
                            message: "Please enter manufacturer's name"
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
            var url = $form.attr('action');
            JBase.send(url,{
                type: 'POST',
                data: $form.serialize(),
                success: function(res) {
                    if (res.success) {
                        JBase.message(ostring.changes_saved);
                    } else {
                        self.handleSubmitError($form, res);
                    }
                }
            });
        },
        handleSubmitError: function ($form, res) {
            $form.trigger('submit_error', res);
        }
    };
    $(document).ready(function () {
        window.Manufacturer.init($(this).find('#manufacturerForm'));
    });
})(jQuery);