/**
 * Created by boott on 03.01.2017.
 */

$.ChatBot = function(params) {


    var data = {
        message: '',
        check: '1',
        role: params.role,
        sessionid: params.sessionid,
        action: 'getchat'
    };

    $.ajax({
        type: "POST",
        url: "{% SITE %}/chatbot/action/b_chat",
        data: data,
        dataType: 'json',
        success: function(e){
            $.each(e, function(sessionid, gettextchat){
                var messages = '';
                $.each(gettextchat, function(key, val){
                    var splits = val.split(':||:');
                    if ( splits[1] == undefined ) { return; }

                    if( splits[0].trim() == 'ChatBot' ){
                        messages += ChatBot(splits[2], splits[1]);
                    }else{
                        messages += client(splits[2], splits[1]);
                    }
                });

                if(params.block == undefined){
                    $('body').append(scilet( messages, params.role, sessionid));
                }else{
                    $(params.block).append(scilet( messages, params.role, sessionid));
                }
                setInterval( autoupdate, 5000 );
            });

            if(params.css != undefined){
                $('.chat-panel.chat-clients').css(params.css);

            }
            if(params.class != undefined){
                $('.chat-box-panel').addClass(params.class);
            }

            button();
            scroll();
        }
    });

    function autoupdate(){
        data = {
            message: '',
            check: '1',
            role: params.role,
            sessionid: params.sessionid,
            action: 'getchat'
        }
        $.ajax({
            type: "POST",
            url: "{% SITE %}/chatbot/action/b_chat",
            data: data,
            dataType: 'json',
            success: function(e){

                //console.log(e);
                $.each(e, function(sessionid, gettextchat){
                    var messages = '';
                    $.each(gettextchat, function(key, val){
                        var splits = val.split(':||:');
                        if ( splits[1] == undefined ) { return; }

                        if( splits[0].trim() == 'ChatBot' ){
                            messages += ChatBot(splits[2], splits[1]);
                        }else{
                            messages += client(splits[2], splits[1]);
                        }
                    });
                    $('.chat#'+sessionid).html(messages);
                });
                //console.log(messages);
            }
        });
    }

    function button(){
        $('.btn.btn-chat').on('click', function(){
            var thisChat = $(this).parent().parent().parent().parent();
            var thisinput = thisChat.find('.btn-input-chat-message');
            var data = {
                message: thisinput.val(),
                check: '1',
                role: thisChat.find('.btn-input-chat-author').val(),
                sessionid: [ thisChat.find('.btn-input-chat-session_id').val() ],
                action: 'save'
            }


            $.ajax({
                type: "POST",
                url: "{% SITE %}/chatbot/action/b_chat",
                data: data,
                dataType: 'json',
                success: function(e){

                    thisChat.find('.btn-input-chat-message').val('');
                    //console.log(e);
                    $.each(e, function(sessionid, gettextchat){
                        var messages = '';
                        $.each(gettextchat, function(key, val){
                            var splits = val.split(':||:');
                            if ( splits[1] == undefined ) { return; }

                            if( splits[0].trim() == 'ChatBot' ){
                                messages += ChatBot(splits[2], splits[1]);
                            }else{
                                messages += client(splits[2], splits[1]);
                            }
                        });
                        $('.chat#'+sessionid).html(messages);
                    });
                },
                complete: function () {
                    thisinput.val('');
                    scroll();
                }
            });

        });
    }

     function scroll(){

        $('.chat-panel').each(function(){
            var height = $(this).find('.chat').height();
            $( this ).find('.panel-body').scrollTop( height );
        });
    }

    //Body to chats///////////////////////
    function scilet( messages, role, sessionid ) {
         //style='position: fixed; width: 300px; z-index: 9999; height: auto; bottom: 0px; right: 19%; padding: 0px; margin: 0px;'
        var html = "<div class='chat-box-panel'><div  class='chat-panel chat-clients panel panel-default' >\
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
        <ul class='chat' id='"+sessionid+"'>\
        <!---chat--->\
        "+ messages +"\
        <!---------->\
        </ul>\
        </div>\
        <!-- /.panel-body -->\
        <div class='panel-footer'>\
        <div class='input-group'>\
        <input type='hidden' name='author' class='btn-input-chat-author' value='"+role+"'>\
        <input type='hidden' name='sessionid' class='btn-input-chat-session_id' value='"+sessionid+"'>\
        <input id='btn-input-chat-message' type='text' class='form-control input-sm btn-input-chat-message' placeholder='Введите ответ...' />\
        <span class='input-group-btn'>\
        <button class='btn btn-warning btn-sm btn-chat' id='btn-chat'>\
        Отправить\
        </button>\
        </span>\
        </div>\
        </div>\
        <!-- /.panel-footer -->\
        </div></div>";
        //console.log(css);

        return html;
    }


    function ChatBot(message, time) {
        var html = "\
    <li class='left clearfix body-chat'>\
        <span class='chat-img pull-left'>\
            <img src='http://placehold.it/50/55C1E7/fff' alt='User Avatar' class='img-circle' />\
        </span>\
        <div class='chat-body clearfix'>\
            <div class='header'>\
                <strong class='primary-font'>ChatBot</strong>\
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

    /////////////////////////////////////
}
