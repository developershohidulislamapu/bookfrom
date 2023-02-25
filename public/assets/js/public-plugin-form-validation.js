jQuery(document).ready(function($) {
    $("form[name='frm_contact']").validate({
        rules: {
            txt_name: "required",
            txt_email: {
                required: false,
                email: true
            },
            txt_phone: "required",
            message: "required",
            datepicker: "required"
        },
        messages: {
            txt_name: "Please Enter Your Name",
            email: "Please Enter a Valid Email Address",
            txt_phone: "Enter a Phone Number",
            message: "Enter Your Desired Text",
            datepicker: "Select a Date Please"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
$("form[name='frm_contact']").validate({
rules: {
    txt_name: "required",
    txt_email: {
        required: false,
        email: true
    },
    txt_phone: "required",
    message: "required",
    datepicker: "required"
},
messages: {
    txt_name: "Please Enter Your Name",
    email: "Please Enter a Valid Email Address",
    txt_phone: "Enter a Phone Number",
    message: "Enter Your Desired Text",
    datepicker: "Select a Date Please"
},
submitHandler: function (form) {
    form.submit();
}
});
