
$(document).ready(function(){
    $('.add-to-cart').on('click', function(e){
        e.preventDefault();

        var $btn = $(this);
        var id = $btn.parent().parent().find('.product-id').val();
        var color = $btn.parent().parent().find('.color').val() || '';
        var qty = $btn.parent().parent().find('.quantity').val();

        var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="color" value="' + color + '"><input type="hidden" name="qty" value="' + qty + '">');

        $('body').append($form);
        $form.submit();
    });

    $('.btn-update').on('click', function(){
        var $btn = $(this);
        var id = $btn.attr('data-id');
        var qty = $btn.parent().parent().find('.quantity').val();
        var color = $btn.attr('data-color');

        var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="update" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="qty" value="'+qty+'"><input type="hidden" name="color" value="'+color+'">');

        $('body').append($form);
        $form.submit();
    });

    $('.btn-remove').on('click', function(){
        var $btn = $(this);
        var id = $btn.attr('data-id');
        var color = $btn.attr('data-color');

        var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="remove" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="color" value="'+color+'">');

        $('body').append($form);
        $form.submit();
    });

    $('.btn-empty-cart').on('click', function(){
        var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="empty" value="">');

        $('body').append($form);
        $form.submit();
    });
});