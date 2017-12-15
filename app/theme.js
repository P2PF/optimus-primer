/* Theme-wide initialization */
var eh=require('equalheight');
jQuery(function(){
    jQuery('.title-logo a,a[rel="home"]').attr({href:'/#home'});
    eh.equalheight('.equalheight');
});
