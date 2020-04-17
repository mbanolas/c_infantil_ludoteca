
<style>
/* aumento tamañp barras mení */
a.button-collapse{
    font-size: 20px !important;
}
.card {
    width: 50%;
    margin: auto; 
    /* padding:20px;  */
    /* height: 400px; */
} 
section{
    margin-top: 5rem;
}
.preloader-wrapper.small {
    width: 20px;
    height: 20px;
    margin-left: 20px;
}
#cargarBD{
    margin:0px;
    margin-top:10px;
    margin-bottom:15px;
}
    

</style>

<body style="background-image: url(https://mdbootstrap.com/img/Photos/Others/images/76.jpg);">>


<section >

<!--Form with header-->

<div class="card h-auto p-4">
    <h3 class="h-auto font-weight-bold mb-4">Programa Gestió <?php echo getNombreCasal() ?></h3>
    <!-- <img class="w-25 p-3" src="<?php echo base_url() ?>img/CI_LOGO.jpg " alt="Card image casal"> -->
    <h4 class=""><?php echo $bienvenida . ' ' . $usuario ?></h4>
    <h4 ><?php echo $categoria ?></h4>
    <h5 class="mt-3" >Seleccionar acció en menú lateral  <i class="fa fa-bars"></i>  o barra navegació</h5>
</div>




</section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   
$(document).ready(function(){

    informarAnchoPantalla()

function informarAnchoPantalla(){
  var ancho=$(window).width()
  var alto=$(window).height()
    //ajax para enviar información con ancho pantalla
  $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>"+"index.php/"+"bienvenida/sizePantallaEmail",
            data: {ancho:ancho,alto:alto},
            success: function(datos){
                // alert(datos);
                var datos=$.parseJSON(datos);
                // alert(datos);
        },
            error: function(){
                  alert('Error proceso inicio. Informar ');
            }
        });
      }
    
    
//     $("#myAlert").click(function(){
//         $("#myAlert").hide('fade')
//     })


})
</script>