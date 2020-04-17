<style>
.jumbotron{
    margin-top:100px;
    margin-left:80px;
    margin-right:80px;
}
</style>



<div class="jumbotron">
<?php if($pagado!=1) { ?>
  <h2 class="display-5">Incripcions Altes</h2>
  <?php } else { ?> 
    <h2 class="display-5">Baixa Inscripció</h2>
    <?php } ?>

  <p class="lead"><?php echo 'Alumno: '.$nombre_alumno.' '.$apellido1_alumno.' '.$apellido2_alumno; ?></p>
  <p class="lead"><?php echo 'Inscrit en : Curs '.$texto_curso.' - Activitat <strong>'.$nombre_actividad.'- '.$grupo.'</strong> '; ?></p>
  <p class="lead"><?php echo 'Period: '.$texto_trimestre ?>
  <p class="lead"><?php echo 'Preu activitat : '.$precio.' €' ?></p>
  <hr class="my-4">
  <?php if($pagado==1) { ?>
      <p>Esta inscripció ya está efectuada y pagada. Pulsar Donar de Baixa i emetre rebut devolució</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfReciboDevolucion/<?php echo $num_usuario ?>" class="btn btn-danger" id="emitirReciboBaja">Donar de Baixa i emetre rebut devolució</a>
  <?php } else { ?>  
      <p>Pulsar EMETRE REBUT para pagar y efectuar la inscripció.</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfRecibo/<?php echo $num_usuario ?>" class="btn btn-primary" id="emitirRecibo">Emetre Rebut</a>
  <?php } ?>
  <a  href="<?php echo base_url() ?>index.php/usuarios2/usuarios" class="btn btn-warning" id="cancelar">Tornar a inscrpcions</a>
  <!-- <button type="button" class="btn btn-warning">Cancel·lar</button> -->
</div>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> 

<script>
 $(document).ready(function() {

  $("#modalInfo").on("hidden.bs.modal", function () {
    // put your default event here
    console.log('cierre modal window')
    window.location.replace("<?php echo base_url() ?>index.php/usuarios2/usuarios");


});

  $('#emitirReciboBaja').click(function(){
    console.log('ver si pagado')
    $('#modalInfoLabel').text("Informació")
   $('.modal-body').html("Baja inscripción realizada. Se ha Recibo devolucion")
   $('#modalInfo').modal('show')
    <?php if($pagado==1) { ?>
<?php } else { ?> 
  
  <?php } ?>
   
  })
 })

</script>