;(function($) {
    "use strict";
var Manufacturer = (function () {
    var options = {
        onAddItem: null
    },
    $list = null,
    groups_data = [],

    init = function ($container, groups, opts) {
        options = $.extend({}, options, opts);
        // TODO handle same group-management.js in olivia
        initForm($('#manufacturerForm'), {
            onSaveSuccess: onAddItem
        });
    },

    onAddItem = function (data) {
        $container.find('.group-list').removeClass('hide');
        addItem(data);
        if (options.onAddItem) {
            options.onAddItem();
        }
    },

    addItem = function (data) {
        var $item = [];
        renderItem(data);
        $list.prepend($item);
        groups_data.unshift(data);
        initItem($item, data);
    },

    initItem = function ($item, data) {
        $item.off('click').on('click', function () {
            if (options.onItemClick) {
                options.onItemClick(data.id);
            } else {
                if (requesting) {
                    return;
                }
                requesting = true;
                JBase.send('/settings/group-management/' + data.id, {
                    type: 'get',
                    success: function (res) {
                        requesting = false;
                        showEditModal($(res.html), data);
                    }
                });
            }
        })
    },

    initForm = function ($form, options) {
        var rules = {
            name: {
                validators: {
                    notEmpty: {
                        message: Base_Validator.validate_errors.required
                    }
                }
            }
        };
        Base_Validator.set_validator($form, rules);
        $form.on('success.form.bv', function(e) {
            e.preventDefault();
            doSubmit($form, options);
        });
    },

    doSubmit = function($form, options) {
        var self = this;
        var url = $form.attr('action');
        JBase.send(url,{
            type: 'POST',
            data: $form.serialize(),
            success: function(res) {
                if (res.success) {
                    JBase.message(ostring.changes_saved);
                } else {
                    handleSubmitError($form, res);
                }
            }
        });
    },

    handleSubmitError = function ($form, res) {
        $form.trigger('submit_error', res);
    }

});

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