$(document).ready(function(){
    checkConditions();

    function checkConditions() {
        $("#conditions-to-approve input[type=checkbox]").each(function(){
            $(this).on("change",function(){
                if($(this).is(":checked")) {
                    $(".js-payment-option-form:visible button:visible").prop("disabled",false);
                }
                else {
                    $(".js-payment-option-form:visible button:visible").prop("disabled",true);
                    return false;
                }
            });
        });
    }
});