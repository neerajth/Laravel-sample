jQuery(document).ready(function(){
    jQuery("input[type='radio'], input[type='checkbox'], select").uniform();
    
    jQuery('.menu-click').click(function() {
        var parent = jQuery(this).parent('.main');
        if(parent.hasClass('open')) {
            jQuery(parent).find('nav').slideUp(1000);
            parent.removeClass('open');
        } else {
            jQuery(parent).find('nav').slideDown(1000);
            parent.addClass('open');
        }
    });
    
    jQuery('.drop-title').click(function() {
        var parent = jQuery(this).parent('.dropdown');
        if(parent.hasClass('open')) {
            jQuery(parent).find('.dropdown ul').slideUp(1000);
            parent.removeClass('open');
        } else {
            jQuery(parent).find('.dropdown ul').slideDown(1000);
            parent.addClass('open');
        }
    });
    
    
})