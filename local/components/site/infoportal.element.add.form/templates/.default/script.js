$(function(){
    // Валидация
    $("#x3-request-form").validate();
    $.validator.messages.required = 'Это поля обязательно для заполнения';

    // Заполнение названия заявки
    /*$(".x3-request-form__input--1, .x3-request-form__input--2").change(function(){
        let firstName = $(".x3-request-form__input--1").val()
        let requestName = $(".x3-request-form__input--2").val() +" "+ firstName[0];
        $(".x3-request-form__input--NAME").val(requestName);
    });*/
    $(".x3-request-form__input--4").change(function(){
        $(".x3-request-form__input--NAME").val("Заявка от " + $(".x3-request-form__input--4").val());
    });

    $("select").each(function(){
        $(this).select2();
    });
});