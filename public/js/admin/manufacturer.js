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
    $modal = null,
    $list = null,
    _$addForm = null,
    _$editForm = null,
    groups_data = [],
    requesting = false,

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
        initItem($item, data);
    },

    editSuccess = function (data) {
        $list.find('#manufacturer_' + data.id + ' .group-name').text(data.name);
        closeModal();
    },

    removeSuccess = function (group_id) {
        $list.find('#manufacturer_' + group_id).remove();
        closeModal();
    },

    closeModal = function () {
        $('.modal.in').modal('hide');
        $('.modal-backdrop.in').remove();
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
                JBase.send('/manufacturer/' + data.id + '/edit', {
                    type: 'get',
                    success: function (res) {
                        requesting = false;
                        showEditModal($(res.html), data);
                    }
                });
            }
        })
    },

    showEditModal = function ($editHtml, data) {
        $modal = JBase.modal({
            body: $editHtml,
            modal_opts: {
                className: 'cem-modal modal-edit-group',
            },
            on_show: function() {
                initEditForm($modal._target.find('form'), data);
            }
        });
    },

    initEditForm = function ($editForm, data, options) {
        _$editForm = $editForm;
        var opts = $.extend({}, {
            onSaveSuccess: editSuccess,
            onRemoveSuccess: removeSuccess
        }, options);
        initForm($editForm, opts);
        // $editForm.find('.btn-remove').click(function () {
        //     confirmRemoveItem(data.id, opts);
        // })
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