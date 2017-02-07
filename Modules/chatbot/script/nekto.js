/**
 * Created by bootta on 13.01.17.
 */
$('#searchCompanyBtn').trigger('click');

var nekto = function(){
var txt_message = '';
setInterval(hello, 5000);

function hello(){
    if($('.mess_block').length>=0){
        if($('.mess_block').hasClass('.window_chat_dialog_new')){
            $('.emojionearea-editor').text('Привет!');
            $('#sendMessageBtn').trigger('click');
        };
        var getNumUltimateMessage = $('.window_chat_dialog_block_nekto.mess_block').length - 1;
        var getUltimateMessage = $('.window_chat_dialog_block_nekto.mess_block')[getNumUltimateMessage];
        var getTextMessage = $(getUltimateMessage).find('.window_chat_dialog_text').text();

        if(txt_message != getTextMessage){
            txt_message = getTextMessage;
            //Здесь отправляем на сервер AJAX запрос.
            //Сервер пытается найти ответ на вопрос и отвечает на него
            //Так же сервер видет логирование всех бесед
            //Если бот задает вопрос то он должен на него обрабаотывать ответ
            // Он должен понимать что вопросы между собой связаны.
            // Должен иметь привязку к теме и понимать что тема продолжается.
        }
        console.log(txt_message);
    }
}
}();

nekto;