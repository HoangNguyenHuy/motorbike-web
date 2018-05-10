;
var Sale = (function () {

    var requesting = false,
        $modal = null,

    init = function () {
    },

    showAddProduct = function () {
        var $addNewModal = $("#_add_lead_modal");
            $addNewModal.on('shown.bs.modal', function () {
                $(this).find("input:visible:eq(0)").focus()
            }).modal("show");
    };

    return {
        init: init,
        showAddProduct: showAddProduct
    }

})();