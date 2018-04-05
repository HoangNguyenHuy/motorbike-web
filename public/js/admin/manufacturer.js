;
var Manufacturer = (function () {
    var markup = [
        '<div class="bdr-bottom group-row cursor-pt" id="manufacturer_{{:id}}">',
        '<div class="row">',
        '<div class="col-xs-6 col-md-5 padding-right-10 group-name first-letter">{{:name}}</div>',
        '<div class="col-xs-6 col-md-7 no-padding-left group-type first-letter">{{:bike_types}}</div>',
        '<i class="fa fa-chevron-right"></i>',
        '</div>',
        '</div>',
    ].join(''),
    options = {
        onAddItem: null,
        onItemClick: null
    },
    $list = null,
    _$addForm = null,
    groups_data = [],

    init = function ($container, groups, opts) {
        $list = $container.find('.group-items');
        options = $.extend({}, options, opts);
        renderList(groups);
        _$addForm = $container.find('#manufacturerForm');
        initForm(_$addForm, {
            onSaveSuccess: onAddItem
        });
    },

    renderList = function (list) {
        list.map(function (item) {
            addItem(item);
        })
    },

    renderItem = function (context) {
        if(!context.bike_types){
            context.bike_types = ostring.currently_unused;
        }
        return $($.templates(markup).render(context));
    },

    onAddItem = function (data) {
        $container.find('.manufacturer-list').removeClass('hide');
        addItem(data);
        if (options.onAddItem) {
            options.onAddItem();
        }
    },

    addItem = function (data) {
        var $item = renderItem(data);
        $list.prepend($item);
        groups_data.unshift(data);
        // TODO it is the show popup edit form
        // initItem($item, data);
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
        Base_Validator.set_validator($form, rules, {live_validate: "disabled"});
        $form.on('success.form.bv', function(e) {
            e.preventDefault();
            doSubmit($form, options);
        });
    },

    doSubmit = function($form, options) {
        var url = $form.attr('action');
        JBase.send(url,{
            type: 'POST',
            data: $form.serialize(),
            success: function(res) {
                if (res.success) {
                    options.onSaveSuccess(res.data);
                    JBase.message(ostring.changes_saved);
                } else {
                    handleSubmitError($form, res);
                }
            },
            error: function () {
                JBase.message(ostring.try_again_later);
            },
        });
    },

    handleSubmitError = function ($form, res) {
        $form.trigger('submit_error', res);
    };
    return {
        init: init
    }

})();