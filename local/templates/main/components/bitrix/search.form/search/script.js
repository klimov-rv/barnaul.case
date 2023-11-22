$(function(){
    $(".x3-search__icon").click(function(){
        $(".x3-search-panel").addClass("x3-search-panel--show");
        $(".x3-search-panel input[type='text']").focus();
    });

    $(".x3-search-panel__close").click(function(){
        $(".x3-search-panel").removeClass("x3-search-panel--show");
    });

    $(document).keyup(function(e) {
        if (e.key === "Escape" && $(".x3-search-panel").hasClass("x3-search-panel--show")) {
            $(".x3-search-panel").removeClass("x3-search-panel--show");
        }
    });
});