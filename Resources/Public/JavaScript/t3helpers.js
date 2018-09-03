/**
 * Placeholders for mobile. Usage:
 * <input type="text" placeholder="Text for desktop" data-mobile-placeholder="Text for mobile"/>
 */
function t3h_mobilePlaceholders() {

    function replacePlaceholders() {
        if ($(window).innerWidth() <= 640) {
            $('input[placeholder]').each(function () {
                if (!$(this).hasAttr('data-original-placeholder')) {
                    $(this).attr('data-original-placeholder', $(this).attr('placeholder'));
                }
                $(this).attr('placeholder', $(this).attr('data-mobile-placeholder'));
            });
        } else {
            $('input[placeholder]').each(function () {
                if ($(this).hasAttr('data-original-placeholder')) {
                    $(this).attr('placeholder', $(this).attr('data-original-placeholder'));
                }
            });
        }
    }

    replacePlaceholders();

    $(window).resize(function () {
        replacePlaceholders();
    });
}

function t3h_confirm() {
    $('.t3hconfirm').each(function () {
        if ($(this).hasAttr('data-t3h-confirm')) {
            $(this).click(function (event) {
                var href = $(this).attr('href');
                event.stopPropagation();
                if (confirm($(this).attr('data-t3h-confirm'))) {
                    location.href = href;
                }
            });
        }
    });
}