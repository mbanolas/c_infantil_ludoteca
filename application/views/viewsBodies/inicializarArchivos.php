<style>
.jumbotron{
    margin-top:100px;
    margin-left:80px;
    margin-right:80px;
}
</style>



<div class="jumbotron">
<h2 class="display-5">Inicializar TODOS los archivos</h2>
<br>
<a  class="btn btn-primary btn-sm" id="inicializarArchivos">Pulsar para inicializar</a>


</div>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> 
<script>
 $(document).ready(function() {
    $('#inicializarArchivos').click(function(){
        $('#modalSiNoLabel').text("Inicialización Archivos")
        $('.modal-body').html("Seguro que quiere inicializar los archivos de la aplicación?")
        $('.delete-confirmation-button').text('Inicializar archivos')
        $('#modalSiNo').modal('show')
    })
    $('.delete-confirmation-button').click(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>"+"index.php/desarrollo/borrarArchivos",
            data: {},
            success: function(datos){
                $('#modalSiNo').modal('hide')
                console.log(datos);
               var datos=$.parseJSON(datos)
               console.log(datos);
               $salida=true
               $.each(datos,function(index, value){
                    if(!value) $salida=false
               })
               if($salida){
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Borrados archivos correctamente")
                $('#modalInfo').modal('show')
               }
               else{
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Ha habido algún problema "+datos)
                $('#modalInfo').modal('show')
               }
              // window.location.href = "<?php echo base_url() ?>index.php/bienvenida";
            },
            error: function(){
                $('button.resultado').html("Error en el borrado")
                
            }
        })  

    })
        
    $("#modalInfo").on("hidden.bs.modal", function () {
        window.location.href = "<?php echo base_url() ?>index.php/bienvenida";
    // window.location.replace("<?php echo base_url() ?>index.php/bienvenida";
    })


 })
 </script>