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
        toggleEditRow();
        events(data);
        _addType($editForm, data.id);
        $editForm.find('.btn-remove').click(function () {
            confirmRemoveItem(data.id, opts);
        });
        JBase.setDefaultValue($editForm, $editForm.find('#type'));
        JBase.detectFormChange($editForm, $editForm.find('#type'));
    },

    confirmRemoveItem = function (mft_id, options) {
        closeModal();
        JBase.confirm({
            title: 'Confirm',
            body: ostring.confirm_delete_manufacturer,
            ok_text: 'Yes',
            ok_callback: function () {
                handleRemove(mft_id, options);
            },
            cancel_text: 'No',
        });
    },

    handleRemove = function (mft_id, options) {
        JBase.send('manufacturer/' + mft_id, {
            type: 'DELETE',
            success: function (res) {
                if (res.success) {
                    if (options.onRemoveSuccess) {
                        options.onRemoveSuccess(mft_id);
                    }
                }
            }
        });
    },

    setTypes = function ($form) {
        var types = '';
        $form.find('._results ul li').each(function () {
            var type = $(this).find('.name-type').text();
            if (!types)
                types = type;
            else
                types = types+', ' + type;
        });
        var mft_id = $form.find('[name=id]').val();
        var filter = '#manufacturer_' + mft_id + ' .group-type';
        if (!types)
            types = ostring.currently_unused;
        $('#manufacturer').find(filter).text(types);
    };

    _addType = function ($form, mfr_id) {
        var mfr_id = mfr_id;
        $form.find('.btn-add').on('click', function() {
            var input_type = $('#type');
            if (!input_type.val()){
                return false;
            }
            _handleSubmitType(null,{
                name:input_type.val(),
                mft_id:mfr_id,
            });
        });
    },

    events = function(data){
        var mft_id = data.id;
        $('#motor-type').on('click', '.tools .save', function(){
            var $row = $(this).closest('li');
            _handleSubmitType($row, {
                name: $row.find('.name-type').text(),
                mft_id:mft_id,
            });
        }).on('click', '.tools .delete', function(){
            var $row = $(this).closest('li');
            _handleSubmitType($row, '',true);
        });
    },

    _handleSubmitType = function($row, params, is_del){
        var type_id = $row?$row.attr('id'):null;
        var url = 'motor-type';
        var method = 'POST';
        if(type_id){
            url = url + '/' + type_id;
            method = 'PUT';
        }
        if(is_del){
            method = 'DELETE';
        }
        JBase.send(url, {
            type: method,
            data: params,
            success: function(res) {
                if (res.success) {
                    if(is_del){
                        delRow($row);
                    }
                    if(method === 'POST'){
                        var $rowClone = $('#new-type').clone();
                        var input_type = $('#type');
                        $rowClone.attr('id', res.data.id);
                        $rowClone.find('.name-type').text(input_type.val());
                        $('._items').prepend($rowClone);
                        input_type.val('');
                    }
                    setTypes($('#form_edit_manufacturer'));
                }else {
                    handleSubmitError($('#form_edit_manufacturer'), res);
                }
            },
            error: function () {
                JBase.message(ostring.try_again_later);
            }
        });
    },

    delRow = function($row){
        $row.remove();
        // $row.fadeOut('100', function(){
        //     $(this).remove();
        // });
    },

    toggleEditRow = function(){
        $('#motor-type').on('click', '.tools .edit', function(){
            var $row = $(this).closest('li');
            $(this).closest('.tools').addClass('editing');
            $row.find('.allow-edit').attr('contenteditable', true);
        }).on('click', '.tools .save', function(){
            var $row = $(this).closest('li');
            var $tools = $(this).closest('.tools').removeClass('editing');
            $row.find('.allow-edit').removeAttr('contenteditable');
        });
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
                    $('#name').val('');
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