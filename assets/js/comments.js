$('.reply-to').unbind('click');
$('.reply-to').click(function(){    
    var form = $("#comment_form");
    if(!(form && form.length)){
        window.location.href="/login";
    }
    $('html, body').animate({
        scrollTop: form.offset().top
    }, 100);
    $('input[name="comment_id"]').val($(this).attr('data-id'));
    $('button[name="create_comment"]').text('Reply to Comment');
    $('#commentModal').modal();
});
    
$('.markdown_editor').markdown({autofocus:false,savable:false});