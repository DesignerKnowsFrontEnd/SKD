/*----------------------------------------------------*/
/*   Cookie Policy
/*----------------------------------------------------*/
$("#acceptCookie").click(function ()
{
    setCookie("acceptCookies", "true", 30);
    $('.cookie-policy').removeClass('fadeInUp').addClass('fadeOutDown');
});

/*----------------------------------------------------*/
/*   Set Cookie
/*----------------------------------------------------*/
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/*----------------------------------------------------*/
/*   Get Cookie
/*----------------------------------------------------*/
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/*----------------------------------------------------*/
/*   Check Cookie
/*----------------------------------------------------*/
function checkCookie() {
    var cookiePolicy = getCookie("acceptCookies");
    if (cookiePolicy == "" || cookiePolicy == null) {
        $('.cookie-policy').show();
    } else {
        $('.cookie-policy').hide();
    }
}

$( document ).ready(function() {
    //Contact form 7 input placeholders
    $('.generic-input').click(function(){
        $(this).parent('span').parent('div').find('label').addClass('labelActive');
    });

    $('.generic-input').blur(function(){
        if($(this).val() == '') {
            $(this).parent('span').parent('div').find('label').removeClass('labelActive');
        }
    });

    $('.generic-input').each(function(){
        if($(this).val()){
            $(this).parent('span').parent('div').find('label').addClass('labelActive');
        }
    });


    /*----------------------------------------------------*/
    /*	Back Top Link
    /*----------------------------------------------------*/
    var offset = 200;
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(400);
        } else {
            $('.back-to-top').fadeOut(400);
        }
    });
    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 600);
        return false;
    });


    /*----------------------------------------------------*/
    /* Check cookie for Cookie Policy
    /*----------------------------------------------------*/
    checkCookie();

    /*----------------------------------------------------*/
    /*	CSS3 Transition
    /*----------------------------------------------------*/
    if( typeof $.fn.appear !== 'undefined' && $.isFunction($.fn.appear) ) {
        $('*').each(function () {
            if ($(this).data('animation')) {
                var $animationName = $(this).data('animation'),
                    $animationDelay = "delay-" + $(this).data('animation-delay');
                $(this).appear(function () {
                    $(this).removeClass('animate');
                    $(this).addClass('animated').addClass($animationName);
                    $(this).addClass('animated').addClass($animationDelay);
                });
            }
        });
    }

    /*----------------------------------------------------*/
    /* Replace all SVG images with inline SVG
    /*----------------------------------------------------*/
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
});