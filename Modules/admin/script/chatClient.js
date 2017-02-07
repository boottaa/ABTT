/**
 * Created by bootta on 29.12.16.
 */

$.clientsChat = function(params) {
    var success = {};
    $.ajax({
        type: "POST",
        url: "{% SITE %}/admin/action/loadchat",
        dataType: 'html',
        success: function(e){
            success.full(e);
        }
    });

    success.full = function(e){
        $('body').append(e);
        $('.chat-panel.chat-clients').on('click', function(e){
            //console.log($(e.target).attr('class'));
            if(!$(this).hasClass('close') && $(e.target).hasClass('close-chat')){
                $(this).addClass('close');
            }else{
                $(this).removeClass('close');
            }
        });

        $('#btn-chat').on('click', function(){
            var data = {
                message: $('#btn-input-chat-message').val(),
                check: '1',
                author: $('#btn-input-chat-author').val(),
                sessionid: $('#btn-input-chat-session_id').val()
            }
            $.ajax({
                type: "POST",
                url: "{% SITE %}/admin/action/chat",
                data: data,
                dataType: 'HTML',
                success: function(e){
                    var xxx = $('.chat');
                    $('.chat').append(e);
                    $('#btn-input-chat-message').val('');
                    $('.chat-panel.chat-clients .panel-body').scrollTop($('.chat-panel.chat-clients .panel-body')[0]['scrollHeight']);
                    setInterval( success.autoupdate, 100,  xxx);
                }
            });
        });

        success.autoupdate = function(thisChat){
            console.log(thisChat);
            $.ajax({
                type: "POST",
                url: "{% SITE %}/admin/action/loadchat",
                data: 'action=UPDATE',
                dataType: 'HTML',
                success: function(e){
                    thisChat.html(e);
                    scroll();
                }
            });
        }

    }
}

var scroll = function(){
    $('.chat-panel').each(function(){
        var height = $(this).find('.chat').height();
        $( this ).find('.panel-body').scrollTop( height );
    });
}

