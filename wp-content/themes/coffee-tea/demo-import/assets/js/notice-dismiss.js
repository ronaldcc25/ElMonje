jQuery(document).ready(function ($) {
    // When the notice is dismissed
    $(document).on('click', '.coffee-tea-notice .notice-dismiss', function () {
        $.post(ajaxurl, {
            action: 'coffee_tea_dismiss_notice'
        });
    });
});