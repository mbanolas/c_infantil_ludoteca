<style>
.jumbotron{
    margin-top:100px;
    margin-left:80px;
    margin-right:80px;
}
</style>



<div class="jumbotron">
<?php if($pagado!=1) { ?>
  <h2 class="display-5">Incripcion Usuari/usuària ludoteca</h2>
  <?php } else { ?> 
    <h2 class="display-5">Baixa Inscripció usuari/usuària ludoteca</h2>
    <?php } ?>

  <p class="lead"><?php echo 'Alumno: <b>'.$nombre_alumno.' '.$apellido1_alumno.' '.$apellido2_alumno,'</b>'; ?></p>
  <p class="lead"><?php echo 'Inscrit en : Curs <b>'.$texto_curso.'</b>' ?></p>
  <p class="lead"><?php echo 'Activitat: <strong>'.$descripcion.'</strong> '; ?></p>
  <p class="lead"><?php echo 'Periodo: <strong>'.$texto_periodo.'</strong> '; ?></p>
  <p class="lead"><?php echo 'Dies setmana: <strong>'.$texto_dias_semana.'</strong> '; ?></p>
  <p class="lead"><?php echo 'Horari :<b>'.substr($horario_desde,0,5).' - '.substr($horario_hasta,0,5).'</b> '; ?></p>
  <p class="lead"><?php echo 'Trimestres: <b>'.$texto_trimestre.'</b>' ?>
  <p class="lead"><?php echo 'Preu ludoteca : <b>'.$precio.' €</b>' ?></p>
  <hr class="my-4">
  <?php if($pagado==1) { ?>
      <p>Esta inscripció ya está efectuada y pagada.</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfReciboUsuarioLudotecaDevolucion/<?php echo $num_usuario ?>" class="btn btn-danger" id="emitirReciboBaja">Donar de Baixa i emetre rebut devolució</a>
  <?php } else { ?>  
      <p>Inscripción no efectuada ni pagada. Pulsar EMETRE REBUT para pagar y efectuar la inscripció.</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfReciboUsuarioLudoteca/<?php echo $num_usuario ?>" class="btn btn-primary" id="emitirRecibo">Emetre Rebut</a>
  <?php } ?>
  <a  href="<?php echo base_url() ?>index.php/usuariosLudoteca2/usuarios" class="btn btn-warning" id="cancelar">Tornar a Inscrpcions</a>
  <!-- <button type="button" class="btn btn-warning">Cancel·lar</button> -->
</div>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> 

<script>
 $(document).ready(function() {
  // alert(<?php echo $inscripciones ?>)
  // alert(<?php echo $num_maximo ?>)
  <?php if($pagado==2 && $inscripciones>=$num_maximo){ ?>
    $('a#emitirRecibo').addClass('disabled')
    $('a#emitirRecibo').attr('href','')

    $('#modalInfoLabel').text("Informació")
     $('.modal-body').html("No se pueden hacer inscripciones en este grupo, por haber sido YA completado")
     $('#modalInfo').modal('show')
  <?php } else { ?>
    $('a#emitirRecibo').removeClass('disabled')
  <?php } ?>
   
  $("#modalInfo").on("hidden.bs.modal", function () {
    // put your default event here
    console.log('cierre modal window')
    window.location.replace("<?php echo base_url() ?>index.php/usuariosLudoteca2/usuarios");
});

  $('#emitirRecibo').click(function(){
    console.log('ver si pagado')
    $('#modalInfoLabel').text("Informació")
   $('.modal-body').html("Inscripción realizada y recibo correctamente.")
   $('#modalInfo').modal('show')
  
   
  })


  $('#emitirReciboBaja').click(function(){
    console.log('ver si pagado')
    $('#modalInfoLabel').text("Informació")
   $('.modal-body').html("Baja inscripción realizada. Se ha emitido recibo devolucion.")
   $('#modalInfo').modal('show')
 
 
   
  })


 })

</script>