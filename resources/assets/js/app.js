(function() {
    "use strict";

    /**
     * Menu Dropdown
     */
    jQuery('.menu-list > a').click(function() {

        var parent = jQuery(this).parent();
        var sub = parent.find('> ul');

        if(!jQuery('body').hasClass('sidebar-collapsed')) {
            if(sub.is(':visible')) {
                sub.slideUp(300, function(){
                    parent.removeClass('nav-active');
                    jQuery('.body-content').css({height: ''});
                    adjustMainContentHeight();
                });
            } else {
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(300, function(){
                    adjustMainContentHeight();
                });
            }
        }
        return false;
    });

    function visibleSubMenuClose() {
        jQuery('.menu-list').each(function() {
            var t = jQuery(this);
            if(t.hasClass('nav-active')) {
                t.find('> ul').slideUp(300, function(){
                    t.removeClass('nav-active');
                });
            }
        });
    }

    function adjustMainContentHeight() {
        var docHeight = jQuery(document).height();
        if(docHeight > jQuery('.body-content').height())
            jQuery('.body-content').height(docHeight);
    }

    jQuery('.side-navigation > li').hover(function(){
        jQuery(this).addClass('nav-hover');
    }, function(){
        jQuery(this).removeClass('nav-hover');
    });

    jQuery('.toggle-btn').click(function(){

        var body = jQuery('body');
        var bodyposition = body.css('position');

        if(bodyposition != 'relative') {

            if(!body.hasClass('sidebar-collapsed')) {
                body.addClass('sidebar-collapsed');
                jQuery('.side-navigation ul').attr('style','');

            } else {
                body.removeClass('sidebar-collapsed chat-view');
                jQuery('.side-navigation li.active ul').css({display: 'block'});

            }
        } else {

            if(body.hasClass('sidebar-open'))
                body.removeClass('sidebar-open');
            else
                body.addClass('sidebar-open');

            adjustMainContentHeight();
        }

    });

    /**
     * Nicescroll INIT
     */
    $("html").niceScroll({
        styler: "fb",
        cursorcolor: "#a979d1",
        cursorwidth: '5',
        cursorborderradius: '15px',
        background: '#404040',
        cursorborder: '',
        zindex: '12000'
    });

    /**
     * Mascaras
     */
    $('.telefone').mask('(00) 0000-0000');
    $('.telefone').blur(function(event) {
        if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
           $('.telefone').mask('(00) 00000-0009');
        } else {
           $('.telefone').mask('(00) 0000-00009');
        }
     });

    $('.data').mask("00/00/0000");
    $('.placa').mask("SSS-0000");
    $('.cep').mask("00.000-000");
    $('.cnpj').mask("00.000.000/0000-00");
    $('.valor').mask('000.000.000.000.000,00', {reverse: true});
    $('.quilometragem').mask('000.000.000.000.000', {reverse: true});

    
})(jQuery);