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

function wcpValidateMinAge(dob) {
    var birthdate = new Date(dob);
    var year = birthdate.getFullYear();
    var today = new Date();
    if (year <= 1899 || year >= today.getFullYear() + 1) {
        return false;
    }

    var limit = new Date((today.getFullYear() - 18), today.getMonth(), today.getDate());
    return birthdate < limit;
};