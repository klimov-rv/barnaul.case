$(function(){
    // Валидация
    $("#x3-request-form").validate();
    $.validator.messages.required = 'Это поля обязательно для заполнения';

    // Заполнение названия заявки
    $(".x3-request-form__input--1, .x3-request-form__input--2").change(function(){
        let requestName = $(".x3-request-form__input--1").val() +" "+ $(".x3-request-form__input--2").val();
        $(".x3-request-form__input--NAME").val(requestName);
        console.log(requestName);
    });
});