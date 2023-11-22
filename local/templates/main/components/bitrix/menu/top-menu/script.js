$(function(){
    $(".x3-tmenu__icon").click(function(){
        $(".x3-tmenu__wrap").addClass("x3-tmenu__wrap--open");
    });

    $(".x3-tmenu__close").click(function(){
        $(".x3-tmenu__wrap").removeClass("x3-tmenu__wrap--open");
    });

    $(document).on('click','.x3-tmenu__wrap--open > ul > li > a', function(){
		if($(this).not(".root-item").length!=0){
			$(this).toggleClass("open");
			$(this).next("ul").slideToggle();
			return false;
		}
    });




});