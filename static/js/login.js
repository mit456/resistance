$(document).ready(function() {
    $('.close_action').click(function() {
        $('.modal').hide();
        $('.loading_image').hide();
    });

    $("#login_form").validate({
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            login_email: {
                required: true,
                email: true
            },
            login_password: {
                required: true,
                minlength: 6
            }
        },
        highlight: function(element) {
            var id_attr = "#" + $(element).attr("id") + "_mark";
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
        unhighlight: function(element) {
            var id_attr = "#" + $(element).attr("id") + "_mark";
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        submitHandler: function() {
            var data = $('#login_form').serialize();
            var url = 'index.php/home/login_submit';
            $('.loading_image').show();
            $.ajax(url, {
                data: data,
                success: login_success,
                error: onError,
                type: "POST"
            });
            return false;
        }
    });


    $("#signup_form").validate({
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            first_name: {
                required: true,
                onlyalpha: true,
                maxlength: 100
            },
            last_name: {
                required: true,
                onlyalpha: true,
                maxlength: 100
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        highlight: function(element) {
            var id_attr = "#" + $(element).attr("id") + "_mark";
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
        unhighlight: function(element) {
            var id_attr = "#" + $(element).attr("id") + "_mark";
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        submitHandler: function() {
            var data = $('#signup_form').serialize();
            var url = 'index.php/home/signup_submit';
            $('.loading_image').show();
            $.ajax(url, {
                data: data,
                success: signup_success,
                error: onError,
                type: "POST"
            });
            return false;
        }
    });
    
    $("#7").click(function(event) {
        alert(1);
    });
    
    $.validator.addMethod("onlyalpha", function(only_alpha, element) {
        return this.optional(element) || (only_alpha.match(/^[a-zA-Z ]+$/));
    }, "Please enter only alphabets");

});

var login_success = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        window.location.href = '/';
        $('.loading_image').hide();
    } else {
        $("#error_modal .text-message").html(data.error);
        $("#error_modal").show();
    }
};

var signup_success = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        $("#success_modal .text-message").html(data.success_message);
        $("#success_modal").show();
    } else {
        $("#error_modal .text-message").html(data.error);
        $("#error_modal").show();
    }
};

var onError = function() {
    alert("Not Done");
};
