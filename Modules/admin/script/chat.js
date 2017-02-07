/**
 * Created by bootta on 28.12.16.
 */


$(function(){
    //Обновление чата:
    $('.chat-refrash').on('click', function(){
        location.reload();

    });

    $('.btn.btn-chat').on('click', function(){
        var thisChat = $(this).parent().parent().parent().parent();

        var data = {
            message: thisChat.find('#btn-input-chat-message').val(),
            check: '1',
            author: thisChat.find('#btn-input-chat-author').val(),
            sessionid: thisChat.find('#btn-input-chat-session_id').val(),
            action: 'save'
        }

        //console.log(data);

        $.ajax({
            type: "POST",
            url: "{% SITE %}/admin/action/chat",
            data: data,
            dataType: 'HTML',
            success: function(e){
                var height = thisChat.find('.chat').height();
                var xxx = thisChat.find('.chat')
                xxx.append(e);
                thisChat.find('#btn-input-chat-message').val('');
                thisChat.find('.panel-body').scrollTop( height );

                //var setI = setInterval( success.autoupdate, 5000 );
            }
        });


    });

});

function scilet( messages, author, sessionid ) {
    var html = "<div style='position: fixed; width: 300px; z-index: 9999; height: auto; bottom: 0px; right: 19%; padding: 0px; margin: 0px;' class='chat-panel chat-clients panel panel-default'>\
    <div class='panel-heading'>\
        <i class='fa fa-comments fa-fw'></i> Чат\
        <div class='btn-group pull-right'>\
        <button type='button' class='btn btn-default btn-xs close-chat' data-toggle='dropdown'>\
        &nbsp;&#10006&nbsp;\
</button>\
    </div>\
    </div>\
    <!-- /.panel-heading -->\
    <div class='panel-body'>\
        <ul class='chat'>\
        <!---chat--->\
        "+ messages +"\
        <!---------->\
        </ul>\
        </div>\
        <!-- /.panel-body -->\
    <div class='panel-footer'>\
        <div class='input-group'>\
        <input type='hidden' name='author' id='btn-input-chat-author' value='"+author+"'>\
        <input type='hidden' name='sessionid' id='btn-input-chat-session_id' value='"+sessionid+"'>\
        <input id='btn-input-chat-message' type='text' class='form-control input-sm' placeholder='Введите ответ...' />\
        <span class='input-group-btn'>\
        <button class='btn btn-warning btn-sm' id='btn-chat'>\
        Отправить\
        </button>\
        </span>\
        </div>\
        </div>\
        <!-- /.panel-footer -->\
    </div>"
    return html;
}


function admin(message, time) {
    var html = "\
    <li class='left clearfix body-chat'>\
        <span class='chat-img pull-left'>\
            <img src='http://placehold.it/50/55C1E7/fff' alt='User Avatar' class='img-circle' />\
        </span>\
        <div class='chat-body clearfix'>\
            <div class='header'>\
                <strong class='primary-font'>Админ</strong>\
                <small class='pull-right text-muted'>\
                    <i class='fa fa-clock-o fa-fw'></i><i class='chat-addtime'>"+ time +"</i>\
                </small>\
            </div>\
            <p class='chat-message'>\
            "+ message +"\
            </p>\
        </div>\
    </li>";
    return html;

};
function client(message, time) {
    var html = "<li class='right clearfix body-chat'>\
        <span class='chat-img pull-right'>\
            <img src='http://placehold.it/50/FA6F57/fff' alt='User Avatar' class='img-circle' />\
            </span>\
            <div class='chat-body clearfix'>\
            <div class='header'>\
            <small class=' text-muted'>\
            <i class='fa fa-clock-o fa-fw'></i><i class='chat-addtime'>"+ time +"</i>\
        </small>\
        <strong class='pull-right primary-font'>Клиент</strong>\
            </div>\
            <p id='chat-message'>\
                " + message + "\
            </p>\
        </div>\
        </li>"
    return html;
};
var scroll = function(){
    $('.chat-panel').each(function(){
        var height = $(this).find('.chat').height();
        $( this ).find('.panel-body').scrollTop( height );
    });
}

var autoupdate = function(){
    $.ajax({
        type: "POST",
        url: "{% SITE %}/admin/action/chatsadmin",
        data: 'action=UPDATE',
        dataType: 'JSON',
        success: function(e){

            //console.log(e);

            $.each(e, function ( sessionid, v ) {
                var message = '';
                $.each(v, function(key, val){
                    var splits = val.split(':||:');
                    if ( splits[1] == undefined ) { return; }

                    if( splits[0].trim() == 'Admin' ){
                        message += admin(splits[2], splits[1]);
                    }else{
                        message += client(splits[2], splits[1]);
                    }
                    //console.log(message);
                    $('.chat#'+sessionid).html(message);
                    scroll();
                });
            });
        }
    });

}

setInterval( autoupdate, 100 );