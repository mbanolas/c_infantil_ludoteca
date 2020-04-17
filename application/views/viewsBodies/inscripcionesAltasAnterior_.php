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

  <p class="lead"><?php echo 'Alumno: <b>'.$nombre_alumno.' '.$apellido1_alumno.' '.$apellido2_alumno,'</b>'; ?></p>
  <p class="lead"><?php echo 'Inscrit en : Curs <b>'.$texto_curso.'</b>' ?></p>
  
  <?php
  $numerosActividades=explode(',',$id_actividad);
  foreach($numerosActividades as $k=>$v){
    $row=$this->db->query("SELECT  horario_desde, horario_hasta, descripcion FROM c_actividades_infantiles WHERE id='$v'")->row();
    $actividad=$row->descripcion." (Horari: ".substr($row->horario_desde,0,5).'-'.substr($row->horario_hasta,0,5).")";
      ?> 
      <h4 class="lead"><?php echo 'Activitat '.($k+1).': <strong>'.$actividad.'</strong> '; ?></h4>
  <?php
    }
    ?>
  <?php
  $numerosPeriodos=explode(',',$id_trimestre);
  foreach($numerosPeriodos as $k=>$v){
    $sql="SELECT  texto_trimestre FROM c_trimestres WHERE id='$v'";
    mensaje('periodos sql '.$sql);
    $row=$this->db->query($sql)->row();
    $trimestre=$row->texto_trimestre;
      ?> 
      <h4 class="lead"><?php echo 'Període '.($k+1).': <strong>'.$trimestre.'</strong> '; ?></h4>
  <?php
    }
    ?>
  
  <p class="lead"><?php echo 'Preu total activitats : <b>'.$precio.' €</b>' ?></p>
  <hr class="my-4">
  <?php if($pagado==1) { ?>
      <p>Esta inscripció ya está efectuada y pagada.</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfReciboDevolucion/<?php echo $num_usuario ?>" class="btn btn-danger" id="emitirReciboBaja">Donar de Baixa i emetre rebut devolució</a>
  <?php } else { ?>  
      <p>Inscripción no efectuada ni pagada. Pulsar EMETRE REBUT para pagar y efectuar la inscripció.</p>
      <a  href="<?php echo base_url() ?>index.php/reportes/pdfRecibo/<?php echo $num_usuario ?>" class="btn btn-primary" id="emitirRecibo">Emetre Rebut</a>
  <?php } ?>
  <a  href="<?php echo base_url() ?>index.php/usuarios2/usuarios" class="btn btn-warning" id="cancelar">Tornar a Inscrpcions</a>
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
    window.location.replace("<?php echo base_url() ?>index.php/usuarios2/usuarios");
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