$("#mission_reason_contract_end").hide();
$("#mission_reason_contract_end").attr('required', false);
$("#mission_date_end").attr('required', false);
$("#mission_status").change(function () {
    var val = $("#mission_status").val();
    if (val == "TERMINE" || val == "EN ATTENTE") {
        $("#mission_reason_contract_end").show();
        $("#mission_reason_contract_end").attr('required', true);
        $("#mission_date_end").attr('required', true);
    } else {
        $("#mission_reason_contract_end").hide();
        $("#mission_reason_contract_end").attr('required', false);
        $("#mission_date_end").attr('required', false);
    }
});