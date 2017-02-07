/**
 * Created by bootta on 27.12.16.
 */


$(function(){
    $('.btncart').on('click', function(){
        var data = {},
            id = $(this).parent().parent().find('.id_products').val();
        data.id = id;
        if($(this).hasClass('cart_bay_cancel')){
            data.action = 'cancel';
        }else if($(this).hasClass('cart_bay_up')){
            data.action = 'up';
        }else if($(this).hasClass('cart_bay_down')){
            data.action = 'down';
        }


        $.ajax({
            type: "POST",
            url: "{% SITE %}/shop/action/cart_editor",
            data: data,
            success: function(e){
                console.log(e);
                location.reload();
            }
        });
        console.log(data);
    });
});