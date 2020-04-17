<style>
.jumbotron{
    margin-top:100px;
    margin-left:80px;
    margin-right:80px;
}
</style>



<div class="jumbotron">
<?php if($pagado!=1) { ?>
  <h2 class="display-5">Contractació Ludoteca</h2>
  <?php } else { ?> 
    <h2 class="display-5">Baixa Contractació Ludoteca</h2>
    <?php } ?>

  <p class="lead"><?php echo 'Contratant: <strong>'.$nombre_contratante.' '.$apellido1_contratante.' '.$apellido2_contratante.' ('.$entidad_contratante.'</strong>)'; ?></p>
  <p class="lead"><?php echo 'Curs <strong>'.$texto_curso.'</strong>' ?></p>
  <p class="lead"><?php echo 'Ludoteca <strong>'.$nombre_ludoteca.'</strong> '; ?></p>
  <p class="lead"><?php echo 'Period: <strong>'.$texto_periodo.'</strong>' ?>
  <p class="lead"><?php echo 'Dies Setmane: <strong>'.$texto_dias_semana.'</strong>' ?>
  <p class="lead"><?php echo 'Horari: <strong>'.$texto_horario.'</strong>' ?></p>
  <p class="lead"><?php echo 'Preu Ludoteca:<strong> '.$precio.' € - '.($id_pago_global==1?'Pagament global':'Pagament individual segon tarifes').'</strong>' ?></p>
   <hr class="my-4">
  <?php if($pagado==1) { ?>
      <p>Esta contratación ya está efectuada y pagada. Pulsar Donar de Baixa i emetre rebut baixa i devolució</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfReciboDevolucionLudoteca/<?php echo $num_ludoteca ?>" class="btn btn-danger" id="emitirReciboBaja">Donar de Baixa i emetre rebut devolució</a>
  <?php } else { ?>  
      <p>Pulsar EMETRE REBUT para pagar y efectuar la contratación.</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfReciboLudoteca/<?php echo $num_ludoteca ?>" class="btn btn-primary" id="emitirRecibo">Emetre Rebut</a>
  <?php } ?>
  <a  href="<?php echo base_url() ?>index.php/ludotecas/ludotecas" class="btn btn-warning" id="cancelar">Tornar a inscrpcions</a>
  <!-- <button type="button" class="btn btn-warning">Cancel·lar</button> -->
</div>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> 

<script>
 $(document).ready(function() {

  $("#modalInfo").on("hidden.bs.modal", function () {
    // put your default event here
    console.log('cierre modal window')
    window.location.replace("<?php echo base_url() ?>index.php/ludotecas/ludotecas");


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