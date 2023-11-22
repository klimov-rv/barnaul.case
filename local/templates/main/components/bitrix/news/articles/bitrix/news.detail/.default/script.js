$(function(){
    // Magnific popup на дополнительные изображения
    $('.x3-article__photos').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled:true
            }
        });
    });

    // Высота блока с дополнительными изображениями равна 1 линии
    var photoHeight = $(".x3-article__photos a").eq(0).height();
    $(".x3-article__photos").css("maxHeight", photoHeight);

    $(".js-more-photo").click(function(){
        $(".x3-article__photos").toggleClass("_show");
        if($(".x3-article__photos._show").length) {
            $(this).find("span").text("Свернуть");
        }else{
            $(this).find("span").text("Развернуть");
        }
        return false;
    });
});

