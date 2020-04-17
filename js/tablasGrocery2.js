$(document).ready(function(){

//cambia texto Search de las columna
$('.searchable-input').each(function(){
    var placeholder=$(this).attr('placeholder').replace('Search','Buscar')
    $(this).attr('placeholder',placeholder)
})

//sube la posicion de la ventana modal
$('.modal-content').css('margin-top','2rem')

//define tamaño botón
$('#save-and-go-back-button').removeClass('btn-sm')

//oculta el botón save
$('#form-button-save').addClass('d-none')

})


