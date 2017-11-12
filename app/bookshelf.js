// ------------------------------
/* BOOKS */
var bookshelf = $('.bookshelf');
if (bookshelf.length) {

    bookshelf.find('figure').each(function (index, element) {

        var el = $(this);
        var front = el.find('.front');
        front.css('background-image', 'url(' + front.find('img').attr('src') + ')');

        var spine = el.find('.spine');
        spine.css('background-image', 'url(' + spine.find('img').attr('src') + ')');

        el.find('.open-details').click(function () {
            el.addClass('details-open');
            return false;
        });

        el.find('.close-details').click(function () {
            el.removeClass('details-open');
        });

    });

}

// csstransformspreserve3d check
(function (Modernizr, win) {
    Modernizr.addTest('csstransformspreserve3d', function () {

        var prop = Modernizr.prefixed('transformStyle');
        var val = 'preserve-3d';
        var computedStyle;
        if (!prop) return false;

        prop = prop.replace(/([A-Z])/g, function (str, m1) {
            return '-' + m1.toLowerCase();
        }).replace(/^ms-/, '-ms-');

        Modernizr.testStyles('#modernizr{' + prop + ':' + val + ';}', function (el, rule) {
            computedStyle = win.getComputedStyle ? getComputedStyle(el, null).getPropertyValue(prop) : '';
        });

        return (computedStyle === val);
    });
}(Modernizr, window));
// ------------------------------
