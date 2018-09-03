jQuery(document).ready(function ($) {

    /**
     * Extend Jquery with $(element).hasAttr()
     * @param name
     */
    $.fn.hasAttr = function (name) {
        return this.attr(name) !== undefined;
    };

    // Call functions
    t3h_mobilePlaceholders();
    t3h_confirm();
});

jQuery(window).load(function ($) {

});
