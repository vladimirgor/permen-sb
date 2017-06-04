$(document).ready(function (){

    var checkboxes = $("input[type='checkbox']"),
        radio = $("input[type='radio']"),
        submit_del = $("#del_inc_exp"),
        submit_add = $("#add_inc_exp");

    submit_del.attr("disabled", !checkboxes.is(":checked"));
    submit_add.attr("disabled", !radio.is(":checked"));

    checkboxes.click(function() {
        submit_del.attr("disabled", !checkboxes.is(":checked"));
    });
    radio.click(function() {
        submit_add.attr("disabled", !radio.is(":checked"));
    });
});
