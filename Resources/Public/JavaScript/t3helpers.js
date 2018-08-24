/**
 * Placeholders for mobile. Usage:
 * <input type="text" placeholder="Text for desktop" data-mobile-placeholder="Text for mobile"/>
 */
function t3h_mobilePlaceholders(){

    function replacePlaceholders(){
        if($(window).innerWidth() <= 640){
            $('input[placeholder]').each(function(){
                if(!$(this).hasAttr('data-original-placeholder')){
                    $(this).attr('data-original-placeholder',$(this).attr('placeholder'));
                }
                $(this).attr('placeholder',$(this).attr('data-mobile-placeholder'));
            });
        }else{
            $('input[placeholder]').each(function(){
                if($(this).hasAttr('data-original-placeholder')) {
                    $(this).attr('placeholder', $(this).attr('data-original-placeholder'));
                }
            });
        }
    }
    replacePlaceholders();

    $( window ).resize(function() {
        replacePlaceholders();
    });
}