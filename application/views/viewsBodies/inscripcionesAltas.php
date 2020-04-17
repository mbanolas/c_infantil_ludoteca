<style>
    .jumbotron {
        margin-top: 100px;
        margin-left: 80px;
        margin-right: 80px;
    }

    #pago {
        color: red;
        font-size: 1.5rem !important;
        padding-top: 10px !important;
    }

    body>div.jumbotron>div.row>div:nth-child(5)>div>input {
        height: calc(4.2rem + 2px);
        font-size: 1.5rem !important;
        color: red;
    }
</style>



<div class="jumbotron">
    <?php if ($pagado != 1) { ?>
        <h2 class="display-5">Rebut altes / mofificació inscripció</h2>
    <?php } else { ?>
        <h2 class="display-5">Baixa Inscripció</h2>
    <?php } ?>
    <?php
    $inscripcion = $resultInscripcion['resultInscripcion'];
    $actividades = $resultInscripcion['resultActividades'];
    $listaEspera = $resultInscripcion['resultListaEspera'];
    $trimestres = $resultInscripcion['resultTrimestres']
    ?>

    <p class="lead"><?php echo 'Alumno: <b>' . $inscripcion->nombre_alumno . ' ' . $inscripcion->apellido1_alumno . ' ' . $inscripcion->apellido2_alumno, '</b>'; ?></p>
    <p class="lead"><?php echo 'Inscrit en : Curs <b>' . $inscripcion->texto_curso . '</b>' ?></p>
    <?php foreach ($actividades as $k => $v) { mensaje('actividades '.$k.' '.$v)?>
        <h5 class="lead"><?php echo 'Activitat: <strong>' . $v->descripcion . '</strong> (Horari: ' . substr($v->horario_desde, 0, 5) . ' - ' . substr($v->horario_hasta, 0, 5) . ')'; ?></h5>
    <?php } ?>
    <?php foreach ($trimestres as $k => $v) { ?>
        <h5 class="lead"><?php echo 'Període: <strong>' . $v->texto_trimestre . '</strong>'; ?></h5>
    <?php } ?>
    <?php foreach ($listaEspera as $k => $v) { mensaje('listaEspera '.$k.' '.$v)?>
        <h6 class="lead"><?php echo 'Llista espera: <strong>' . $v->descripcion . '</strong>'; ?></h6>
    <?php } ?>
    

    <hr>
    <h3>Pagament </h3>
    <div class="row">
        <div class="col-sm-2">
            <!-- Material input -->
            <div class="md-form">
                <input type="number" id="precio_a_pagar" class="form-control" value="<?php echo $inscripcion->precio_a_pagar ?>" disabled>
                <label for="precio_a_pagar" class="">Preu a pagar</label>
            </div>
        </div>
        <div class="col-sm-2">
            <!-- Material input -->
            <div class="md-form">
                <input type="number" id="pagado" class="form-control" value="<?php echo $inscripcion->pago ?>" disabled>
                <label for="pagado" class="disabled">Pagat</label>
            </div>
        </div>
        <div class="col-sm-2">
            <!-- Material input -->
            <div class="md-form">
                <input type="number" id="pendiente_pago" class="form-control" value="<?php echo $inscripcion->pendiente_pago ?>" disabled>
                <label for="pendiente_pago" class="disabled">Pendent pagament</label>
            </div>
        </div>
        <div class="col-sm-2">
            <!-- Material input -->
            <div class="md-form input-group-lg">
                <input type="number" id="pago" name="pago" class="form-control" value="<?php echo $inscripcion->pendiente_pago ?>">
                <label for="pago" class="disabled">Emetre rebut per</label>
            </div>
        </div>
        <div class="col-sm-2">
            <select id="forma_pago" name="forma_pago" class="mdb-select md-form" searchable="Search here..">
                <!-- <option value="" disabled selected>Choose your country</option> -->
                <option value="1" selected>Metàl·lic</option>
                <option value="2">Targeta</option>
                <option value="3">Transferència</option>
            </select>
            <label class="mdb-main-label">Forma de pagament</label>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
    </div>
   
    <div id="textoPagoACuenta" class="col-sm-2 d-none">
    <h5>Pagament a compte<span class="badge badge-primary"></span></h5>
    </div>

    </div>
    <!-- <button class="btn btn-primary" id="emitirRecibo">Emetre Rebut</button> -->
    <a class="btn btn-primary d-none animated jello infinite " id="emitirRecibo" href="<?php echo base_url() ?>index.php/reportes/pdfReciboInscripcion/<?php echo $inscripcion->id ?>" class="btn btn-primary" id="emitirRecibo">Emetre Rebut</a>
    <a class="btn btn-primary" id="registrarPago">Registrar pagament i emetre rebut</a>
    <?php 
        switch($_SESSION['tipo_actividad']){
            case 0:
                $inscripciones='inscripciones';
            break;
            case 1:
                $inscripciones='inscripciones_relaciones';
            break;
            case 2:
                $inscripciones='inscripciones_navidad';
            break;
            case 3:
                $inscripciones='inscripciones_verano';
            break;
            case 4:
                $inscripciones='inscripciones_ludoteca';
            break;
            default:
            $inscripciones='inscripciones_ludoteca';
        }
    ?>
    <a href="<?php echo base_url() ?>index.php/inscripciones/<?php echo $inscripciones ?>" class="btn btn-warning" id="cancelar">Tornar a Inscrpcions</a>






    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {

            // Material Select Initialization
            $('.mdb-select').materialSelect();

            $("#modalInfo2").on("hidden.bs.modal", function() {
                // se ha cerrado ventana modal
                // console.log('cierre modalInfo window')
                // var pago = parseFloat($('input#pago').val())
                // var pago = $('input#pago').val()
                // var formaPago = $('#forma_pago').val()
                // window.location.href = '<?php echo base_url() ?>index.php/reportes/pdfReciboInscripcion/'+<?php echo $inscripcion->id ?>+"/"+formaPago+"/"+pago 
                // window.location.href = '<?php echo base_url() ?>index.php/inscripciones/recibo/'+<?php echo $inscripcion->id ?>+"/"+formaPago+"/"+pago 
                window.location.href = '<?php echo base_url() ?>index.php/inscripciones/inscripciones/inscripciones' 

            });
            var inscripcionId

            $('input#pago').keyup(function(e){

                console.log(e)
                console.log($(this).val())
                console.log($('#pendiente_pago').val())
                console.log(($('#pendiente_pago').val()-$('input#pago').val()))
                console.log(($('#pendiente_pago').val()-$('input#pago').val())>0)
                $('#textoPagoACuenta').addClass('d-none')
                if(($('#pendiente_pago').val()-$('input#pago').val())>0){
                    $('#textoPagoACuenta').removeClass('d-none')
                }
                else {
                    $('#textoPagoACuenta').addClass('d-none')
                }
            })

            $('#emitirRecibo').click(function() {

                        $('#modalInfoLabel2').text("Informació")
                        $('.modal-body').html("Rebut emès.")
                        $('#modalInfo2').modal('show')
            })
            $('#registrarPago').click(function() {
                // comprobamos si lo que se va a pagar es superior a pendiente pago
                var pago = parseFloat($('input#pago').val())
                var pendientePago = parseFloat($('input#pendiente_pago').val())
                console.log('pago' + pago)
                console.log('pendientePago' + pendientePago)
                if (pago > pendientePago && pendientePago>0) {
                    $('#modalInfoLabel').text("Informació")
                    $('.modal-body').html("El pagament és superior a la quantitat pendent de pagar")
                    $('#modalInfo').modal('show')
                    return
                }
                
                //grabamos datos del recibo en la inscripcion
                inscripcionId = window.location.href.substring(window.location.href.lastIndexOf('/') + 1)

                var pago = $('input#pago').val()
                var formaPago = $('#forma_pago').val()
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + "index.php/inscripciones/cobro/",
                    data: {
                        id: inscripcionId,
                        pago: pago,
                        forma_pago: formaPago
                    },
                    success: function(datos) {
                        // alert('datos '+datos)
                        var datos = $.parseJSON(datos)

                        // alert(' numero de recibo '+datos)
                        // $('#modalInfoLabel').text("Informació")
                        // $('.modal-body').html("Cobrament realitzat. Emetre rebut.")
                        // $('#modalInfo').modal('show')
                        
                        // $('#emitirRecibo').removeClass('d-none')
                        $('#registrarPago').addClass('d-none')
                        window.location.href = "<?php echo base_url() ?>index.php/reportes/pdfReciboInscripcion/<?php echo $inscripcion->id ?>"

                        // alert("Cobrament realitzat. S'emet rebut.")
                        // window.location.href = "<?php echo base_url() ?>index.php/reportes/pdfReciboInscripcion/" + inscripcionId+"/"+formaPago+"/"+pago
                        // alert(datos)
                    },
                    error: function() {
                        alert('Error en inscripciones/cobro. Informar administrador')
                    }
                })

            })

            // $('#cancelar').click(function()){
            //     window.location.replace("<?php echo base_url() ?>index.php/inscripciones/inscripciones");
            // }

        })
    </script>