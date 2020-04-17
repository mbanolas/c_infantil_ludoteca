
$(document).ready(function() {

    //pone class d-visible para controlar por css parte del pie de la table
  //  $('.card-footer > div > div:nth-child(1), .card-footer > div > div:nth-child(3) ').addClass('d-visible')

    //las columnas fechas NO se ordenarán
    //$('[data-order-by^="fecha"]').css('color','red')
    //$('[data-order-by^="fecha"]').click(function () {   //maba
    //    alert('Las columnas de fechas con formato local NO permiten ordenarse, pero sí la búsqueda (tablasGrocery)')         //maba
    //}) 

    //incluir for en los label con el id del input para que clicando sobre el label se seleccione el input
    $('input[id^=field]').each(function(index, value) {  
        // console.log($(this).attr('class'))  
        $(this).parent().children('label').attr('for', $(this).attr('id'))
    });
    


    //cambia texto Search de las columna
    $('.searchable-input').each(function(){
        var placeholder=$(this).attr('placeholder').replace('Search','Cercar')
        $(this).attr('placeholder',placeholder)
        $(this).css('padding-left','5px')
    })

    //sube la posicion de la ventana modal
    $('.modal-content').css('margin-top','7rem')

    //elimina tamaño pequeño de mdb grocery
    $('#save-and-go-back-button').removeClass('btn-sm')

    //sube la posicion de la ventana modal
    $('.modal-content').css('margin-top','2rem')

    //oculta el botón save
    $('#form-button-save').addClass('d-none')

    $('#form-button-save').click(function(e){
        e.preventDefault()
        // console.log('Se ha clickado button save')
    })

    $('.form-control').click(function(e){
        // console.log(e)
        var code = e.keyCode || e.which;
        if(code == 13) { //Enter keycode
            $('#save-and-go-back-button').trigger('click')
        }
    })

})
    