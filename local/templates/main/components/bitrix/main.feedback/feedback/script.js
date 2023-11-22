$(function(){
    // Валидация
    $("#x3-form form").validate();
    $.validator.messages.required = 'Это поля обязательно для заполнения';

    // Маска для e-mail
    $("input[name='user_email']").inputmask("email");

    /*$(".x3-form-check input[type='checkbox']").change(function(){
        var form = $(this).parents("form");
        if($(this).is(":checked"))
            form.find("input[type='submit']").prop("disabled", false);
        else
            form.find("input[type='submit']").prop("disabled", true);
    });*/
});