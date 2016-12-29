var val = "Fill the field(s): ";
function check_form(id, name){
    if ($('#' + id).val() == ""){
        val = val + name + ", ";
        return false;
    }
    return true;
}


//show post add form
$('#add-post').click(function(e){
    e.preventDefault();
    $('#post-edit').show();
    $('#post-form').append('<input type="hidden" name="add_post" id="add_post" value="1">');
    $('#save').text('Add');
    $('#result').css('visibility', 'hidden');
    $('#comments .comment').remove();
    $('#tag').val( '' );
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].setData('');
    } //silly
    $('#sort-order').val('' );
});

//show post update form
$('.update-link').click(function(e){
    e.preventDefault();
    $('#post-edit').show();
    $('#add_post').remove();
    $('#update_post').remove();
    $('#post-form').append('<input type="hidden" name="update_post" id="update_post" class="update-link" value="' + $(this).attr('id') + '">');
    $('#save').text('Save');
    $('#result').css('visibility', 'hidden');
    id = $(this).attr('id');
    $('#comments .comment').remove();
    $.get( "http://localhost/blog/dml.php", { get_post: $(this).attr('id') }, function(data){
        if(data != 0) {
            var post = JSON.parse(data);
            $('#tag').val( post[0].tag );
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData(post[0].text);
            } //silly
            $('#sort-order').val(post[0].sort_order );

            //get comments
            $.get( "http://localhost/blog/dml.php", {  get_comment: id }, function(arr){
                if (arr != 0) {
                    var jsonArr = JSON.parse(arr);
                    for (var i = 0; i < jsonArr.length; i++) {
                        $('#comments').append('<p class="comment"><b>' + jsonArr[i].writer_name + '</b> [ ' + jsonArr[i].writer_mail + ' ] [ ' + jsonArr[i].comment_time + ' ] : ' + jsonArr[i].text + ' <a class="del-comment" href="' + jsonArr[i].id + '">Sil</a></p>');
                    }
                }
            });
        }
    });
    $('#delete-post').attr('href', 'dml.php?delete_post=' + $(this).attr('id'));
});

//do the save-add post
$('#save').click(function(e){
    e.preventDefault();

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    } //silly
    val = "Fill the field(s): ";
    if ( (check_form('tag', 'Topic') & check_form('post-text', 'Text') & check_form('sort-order', 'Sort Order')) == false ){
        alert ( val.substring(0, val.length-2) );
    }
    else {
        if( $('#save').text() == 'Save' ) {
            $.post( "http://localhost/blog/dml.php", $('#post-form').serialize(), function(data){
                if(data != 0) {
                    var row = data.split("#_#");
                    $('#result').html('Updated');
                    $('#result').css('visibility', 'visible');
                    $('#' + row[0] ).text(row[1]);
                    window.location = '#result';
                }
            });
        }
        else if( $('#save').text() == 'Add' ) {
            $.post( "http://localhost/blog/dml.php", $('#post-form').serialize() );
            window.location = "manage.php";
        }
    }
});

//delete comment
$('#comments').on('click', '.del-comment', function(e){
    e.preventDefault();
    var href = $(this).attr('href');
    $.get('http://localhost/blog/dml.php', {  del_comment: href }, function (data) {
        if (data > 0) {
            $("a[href='" + href + "']").parent().remove();
        }
    });
});


$('.post-link').on ('click', function(e){
    e.preventDefault();
    var current_post_id = $(this).attr('href');
    $.get('http://localhost/blog/dml.php', { get_post:current_post_id }, function(postArr) {
        if(postArr != 0) {
            var jsonArr = JSON.parse(postArr);
            $('#current-post-topic').text(jsonArr[0].tag);
            $('#current-post-text').html(jsonArr[0].text);
            //get writer
            $.get( 'http://localhost/blog/dml.php', {get_blog: jsonArr[0].blog_id }, function(result){
                if (result != 0) {
                    var jsonArrWriter = JSON.parse(result);
                    $('#current-post-author i').text('Written by ' + jsonArrWriter[0].username + ' [ ' + jsonArr[0].post_time + ' ]');
                }
            });
            //get comments
            $('#current-post-comments').html('');
            $.get( 'http://localhost/blog/dml.php', {get_comment: jsonArr[0].id }, function(result){
                if (result != 0) {
                    var jsonArrComments = JSON.parse(result);
                    for (var i = 0; i < jsonArrComments.length; i++) {
                        $('#current-post-comments').html('<p class="comment"><b>' + jsonArrComments[i].writer_name + '</b> [ ' + jsonArrComments[i].writer_mail + ' ] [ ' + jsonArrComments[i].comment_time + ' ] : ' + jsonArrComments[i].text + ' </p>');
                    }
                }
            });
        }
    });
});

$('#signup-show-btn').click(function(){
    $('#signin-form').hide();
    $('#signup-form').show();
});
$('#signup-cancel-btn').click(function(){
    $('#signin-form').show();
    $('#signup-form').hide();
});

$('#signup-btn').on('click', function(e){
    e.preventDefault();
    val = "Fill the field(s): ";
    if ( (check_form('new-username', 'Username') & check_form('new-mail', 'Mail Address') & check_form('new-password', 'Password')) == false ){
        alert ( val.substring(0, val.length-2) );
    }
    else {
        $.post('dml.php', $('#signup-form').serialize(), function(result){
            if(result != 0) {
                $('#message-signup').css('visibility', 'visible');
                $('#message-signup').text('Sign up succesfull, let you sign in');
                $('#signup-form').hide();
                $('#signin-form').show();
            }
            else {
                $('#message-signup').text('Username and mail must be unique');
                $('#message-signup').css('visibility', 'visible');
            }
        });
    }
});

$('#signin-btn').on('click', function(e){
    e.preventDefault();
    val = "Fill the field(s): ";
    if ( (check_form('username', 'Username') & check_form('password', 'Password')) == false ){
        alert ( val.substring(0, val.length-2) );
    }
    else {
        $.post('dml.php', $('#signin-form').serialize(), function(result){
            if(result != 0)
                window.location = 'manage.php';
            else {
                $('#message-signin').text('Invalid username/mail or password');
                $('#message-signin').css('visibility', 'visible');
            }
        });
    }
});
$('#sign-in-out').on('click', function(e){
    e.preventDefault();
    if ($(this).text() == 'Sign in' ) {
        window.location = 'login.php';
    }
    else{
        $.get('http://localhost/blog/dml.php', {signout:1}, function(result){
            if(result != 0) window.location = 'index.php';
        });
    }
});
$('#username, #new-username, #password, #new-password').on('focus', function(){
    $('#message-signin, #message-signup').text('');
    $('#message-signin, #message-signup').css('visibility', 'hidden');
});

//change password
$('#change-password-btn').on('click', function(e){
    e.preventDefault();
    val = "Fill the field(s): ";
    if ( (check_form('password-old', 'Old Password') & check_form('password-new', 'New Password')) == false ){
        alert ( val.substring(0, val.length-2) );
    }
    else
        $.post('http://localhost/blog/dml.php', $('#change-password-form').serialize(), function(result){
                if(result == 1) {
                    $('#message-change-password').text('Your password changed succesfully');
                    $('#message-change-password').css('visibility', 'visible');
                }
                else if(result == 0) {
                    $('#message-change-password').text('Incorrect password');
                    $('#message-change-password').css('visibility', 'visible');
                }
        });

});

//search
var searchSource = [];
$('#searchText').keypress(function(){
    if ( $('#searchText').val().length > 1 )
        $.get('http://localhost/blog/dml.php', { term: $(this).val() }, function(data){
            var jsonArr = JSON.parse(data);
            for (var i = 0; i < jsonArr.length; i++) {
                searchSource.push( jsonArr[i][0] );
            }
            searchSource = jsonArr;
        });
});
$('#searchText').autocomplete({
    source: searchSource
});
/*
$('#doSearch').on('click', function(e){
    e.preventDefault();
    var container = $('.container-fluid');
    var scrollTo = $(   '#' + $("a:contains('" + $('#searchText').val() + "')").attr('id')     );

    container.scrollTop(
        scrollTo.offset().top - container.offset().top + container.scrollTop()
    );

    // Or you can animate the scrolling:
    container.animate({
        scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
    });​


});*/

//
$('#message-change-password').css('visibility', 'hidden');

//manage page
$('#post-edit').hide();
$('#result').css('visibility', 'hidden');

//login page
$('#signup-form').hide();
$('#message-signin').css('visibility', 'hidden');
$('#message-signup').css('visibility', 'hidden');


CKEDITOR.replace( 'post-text' );
