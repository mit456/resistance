$(document).ready(function() {
    $('.close_action').click(function() {
        $('.modal').hide();
        $('.loading_image').hide();
    });

    window.onload = window_load;

    $("#broadcast_form").validate({
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            broadcast_message: {
                required: true,
                maxlength: 200
            }
        },
        highlight: function(element) {
            $(element).removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).removeClass('has-error').addClass('has-success');
        },
        submitHandler: function() {
            $('.loading_image').show();
            var url = 'index.php/home/broadcast_submit';
            var data = $('#broadcast_form').serialize();
            $.ajax(url, {
                data: data,
                success: broadcast_success,
                error: onError,
                type: "POST"
            });
            return false;
        }
    });

    $("#saved_messages").click(function(event) {
        event.preventDefault();
        $('.loading_image').show();
        var url = 'index.php/home/get_saved_messages';
        $.ajax(url, {
            success: got_saved_messages,
            error: onError,
            type: "POST"
        });
        return false;
    });

    $("#logout").click(function(event) {
        event.preventDefault();
        $('.loading_image').show();
        var url = 'index.php/home/logout';
        $.ajax(url, {
            success: logout_success,
            error: onError,
            type: "POST"
        });
        return false;
    });
});

var window_load = function() {
    $('.loading_image').show();
    var url = 'index.php/home/get_broadcast_messages';
    $.ajax(url, {
        success: got_messages,
        error: onError,
        type: "POST"
    });
    return false;
};

var got_messages = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        for (var i = 0; i < data.count; i++) {
            show_messages(data.messages[i], data.user_ids[i], data.username, data.message_ids[i]);
        }
        $('.loading_image').hide();
    }

    $(".save_message").click(function(event, element) {
        event.preventDefault();
        $(".loading_image").show();
        var url = 'index.php/home/save_message';
        var message = $(this).attr('value');
        var data = {
            message: message
        };
        $.ajax(url, {
            data: data,
            success: save_message_success,
            error: onError,
            type: "POST"
        });
        return false;
    });

    $(".show_comments").click(function(event) {
        event.preventDefault();
        $(".loading_image").show();
        var id = $(this).attr('id');
        var id_array = id.split('_');
        var url = 'index.php/home/get_comments';
        var comment_data = {
            message_id: id_array[2]
        };
        $.ajax(url, {
            data: comment_data,
            success: got_comments,
            error: onError,
            type: "POST"
        });
        return false;
    });
    
    $(".add_comment").click(function(event){
        var id = $(this).attr('id');
        var id_array = id.split('_');
        show_comment_modal(id_array[2]);
    });
    
    $(".hide_comments").click(function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        var id_array = id.split('_');
        $(".comment_div_" + id_array[2]).hide();
        $("#hide_comment_" + id_array[2]).css('display', 'none');
        $("#show_comment_" + id_array[2]).css('display', 'block');

    });
};

function show_messages(message, user_id, username, message_id) {
    if (user_id === "7") {
        username = 'John Conner';
    }
    var new_message_div = $(document.createElement('div')).attr('id', "message_div_" + user_id).attr('class', "col-md-8 col-xs-12");
    new_message_div.html(
            '<div class="well" id="message_' + message_id + '">' +
            '<h5 style="margin: 0px;color: rgb(211, 0, 0); font-weight: bold; text-decoration: underline;margin-bottom: 15px;">' + username + '</h5>' +
            '<h5 id = "message" style="">' + message + '</h5>' +
            '<div class="col-md-3"><a href="#" id="show_comment_' + message_id + '" class="show_comments">Show Comments</a><a href="#" id="hide_comment_' + message_id + '" class="hide_comments" style="display:none">Hide Comments</a></div>' +
            '<div class="col-md-offset-3 col-md-3"><a href="#" data-toggle="modal" data-target="#comment_modal" class="add_comments" id="add_comment_'+message_id+'" style="color:red;">Add Comments</a></div>' +
            '<div class="col-md-3"><a href="#" class="save_message" value="' + message + '">Save Message</a></div>' +
            '</div>');

    $("#message_part").append(new_message_div);
}

var broadcast_success = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        window.location.href = '/';
    }
};

var got_saved_messages = function(data) {
    data = JSON.parse(data);
    $("#message_part").hide();
    if (data.success) {
        if (data.count === 0) {
            var new_message_div = $(document.createElement('div')).attr('class', "well");
            new_message_div.html('<h4>You dont have any saved messages.</h4>');
            $("#saved_messages_part").append(new_message_div);
        } else {
            for (var i = 0; i < data.count; i++) {
                show_saved_messages(data.messages[i]);
            }
            $("#heading").css('display', 'block');
        }
        $('.loading_image').hide();
    }
};

var got_comments = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        if (data.count === 0) {
            alert("Sorry :( no comments!");
        } else {
            for (var i = 0; i < data.count; i++) {
                show_comments(data.comments[i], data.users_comment[i], data.created_dates[i], data.message_ids[i]);
            }
        }
    }
    $('.loading_image').hide();
};

function show_comment_modal(id){
    
}

function show_comments(comment, username, created_at, message_id) {
    var new_comment_div = $(document.createElement('div')).attr('class', "comment_div well col-md-8 comment_div_" + message_id);
    new_comment_div.html('<h5 style="margin: 0px;color: rgb(211, 0, 0); font-weight: bold; text-decoration: underline;margin-bottom: 15px;">' + username + '</h5>' + '<h5 id = "message" style="">' + comment + '</h5>');
    var div_id = "#message_" + message_id;
    $(div_id).append(new_comment_div);
    $("#show_comment_" + message_id).css('display', 'none');
    $("#hide_comment_" + message_id).css('display', 'block');
}

function show_saved_messages(message) {
    var new_message_div = $(document.createElement('div')).attr('class', "well");
    new_message_div.html('<h5>' + message + '</h5>');
    $("#saved_messages_part").append(new_message_div);
}

var save_message_success = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        $("#success_modal .text-message").html(data.success_message);
        $("#success_modal").show();
    } else {
        $("#error_modal .text-message").html(data.error);
        $("#error_modal").show();
    }
};

var logout_success = function(data) {
    data = JSON.parse(data);
    if (data.success) {
        window.location.href = '/';
    }
};

var onError = function() {
    alert("Somthing Wrong happend");
};

