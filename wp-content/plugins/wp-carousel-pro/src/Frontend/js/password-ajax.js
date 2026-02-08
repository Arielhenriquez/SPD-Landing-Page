; (function ($) {
    'use strict';
    
    $('body').find('.wpcp-password-area').each(function () {
        var password_area_id = $(this).attr('id');
        var _this = $(this);
        $('#' + password_area_id + ' .submit_wpcp_password').on('click', function () {
            var password = $('#' + password_area_id + ' .wpcp_password').val();
            var nonce = $('#' + password_area_id + ' .wpcp_password').data('nonce');
            var sid = $('#' + password_area_id + ' .wpcp_password').data('id');
            var ajax_url = $('#' + password_area_id + ' .wpcp_password').data('url');
            // location.reload();
            $.ajax({
                type: 'POST',
                url: ajax_url,
                data: {
                    pword: password,
                    id: sid,
                    action: 'wpcp_password_cookie',
                    nonce: nonce,
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });
    });

    // Enter key press event for password input field
    $('.wpcp-password-area').each(function() {
        let $area = $(this);
        let $passwordInput = $area.find('.wpcp_password');
        let $submitButton = $area.find('.submit_wpcp_password');

        if ($passwordInput.length && $submitButton.length) {
            $passwordInput.on('keypress', function(e) {
                if (e.which === 13) { // 13 = Enter key
                    e.preventDefault(); // prevent default behavior
                    $submitButton.trigger('click'); // trigger AJAX submit
                }
            });
        }
    });

})(jQuery);
