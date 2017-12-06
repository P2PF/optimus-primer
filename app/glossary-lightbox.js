/* Replace ithoughts-glossary qtip behaviour with good ol' lightbox */
var $ = jQuery;
var fl = require('featherlight.patched');
$('.itg-glossary').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var title = $this.data('term-title');
    var content = $this.data('term-content');
    // console.log(title, content);
    $.featherlight(
        '<div class="glossary-content"><h2>'
        + title
        + '</h2>'
        + content
        + '</div>',
        {
            closeOnClick: 'anywhere'
        });
});