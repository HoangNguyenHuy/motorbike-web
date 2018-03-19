/**
 * @type JBase
 */

var JBase = (function () {
    var self = this;

    function detectFormChange($form) {
        var $inputs = $form.find(':input');
        $inputs.on('keyup change', function() {
            var dataChanged = $inputs.filter(function() {
                if ($(this).is(':checkbox') || $(this).is(':radio')) {
                    var originalValue = this.defaultChecked;
                    var currentValue = this.checked;
                } else {
                    var originalValue = this.defaultValue;
                    var currentValue = this.value;
                }
                return originalValue != currentValue;
            }).length;

            if (dataChanged == 0) {
                $('.btn-save').addClass('hide')
            } else {
                $('.btn-save').removeClass('hide');
            }
        });
    }
    return {
        detectFormChange: detectFormChange
    };
})(jQuery);