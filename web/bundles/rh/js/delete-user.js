$(document).ready(function(){
    $('.btn-delete').click(function(e){
        e.preventDefault();//para evitar la recarga de páginas al dar click al botón eliminar
        
        var row = $(this).parents('tr');
        
        var id = row.data('id');
        
        //alert(id); return;
        
        var form = $('#form-delete');
        
        var url = form.attr('action').replace(':USER_ID', id);
        
        var data = form.serialize();
        
        //alert(url);return;
        
        bootbox.confirm(message, function(res){
            if(res == true)//si le damos ok a la ventana de confirmacion
            {
                $('#delete-progress').removeClass('hidden');
                $('#message-danger').addClass('hidden');
                $('#message').addClass('hidden');
                //alert(url);return;
                
                $.post(url, data, function(result){
                    //alert(res);return;
                    $('#delete-progress').addClass('hidden');
                    
                    if(result.removed == 1)//variable enviada desde el controlador que me indica si esta eliminado
                    {
                        row.fadeOut();//eliminar la fila
                        $('#message').removeClass('hidden');
                        
                        $('#user-message').text(result.message);
                    }
                    else
                    {
                        $('#message-danger').removeClass('hidden');
                        
                        $('#user-message-danger').text(result.message);
                    }
                }).fail(function(){
                    $('#delete-progress').addClass('hidden');
                    alert('Ha ocurrido un error en el proceso');
                    row.show();
                });
            }
        });
    });
});