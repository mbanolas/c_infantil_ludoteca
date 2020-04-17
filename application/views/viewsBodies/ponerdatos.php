<?php


?>
<style>
    .jumbotron {
        margin-top: 100px;
        margin-left: 80px;
        margin-right: 80px;
    }

    body > header > nav > div.float-left > a{
        font-size: 20px !important;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url() ?>css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">
</head>

<body>




    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <!-- Se cargan los mismos .js de grocery_crud, excepto el último de config -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/grocery_crud/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/build/js/global-libs.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/mdb/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/mdb/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/bootstrap/dropdown.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/jquery-plugins/bootstrap-growl.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/jquery-plugins/jquery.print-this.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/common/common.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/js/common/lazyload-min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/datagrid/gcrud.datagrid.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/datagrid/list.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/js/jquery_plugins/jquery.chosen.min.js"></script>
    <!-- <script src="http://localhost:8888/casal_infantil/assets/grocery_crud/js/jquery_plugins/config/jquery.chosen.config.js"></script> -->

    <!-- Bootstrap tooltips -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/popper.min.js"></script> -->
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script> -->
    <!-- MDB core JavaScript -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/mdb.min.js"></script> -->


    <div class="jumbotron">

        <h2 class="display-5">Introduir dades en activitats <?php echo getTituloCasal() ?> </h2>

        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="precioAnual" class="form-control" value="">
                        <label for="precioAnual" class="">Preu anual</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="precioTrimestral" class="form-control" value="">
                        <label for="precioTrimestral" class="">Preu trimestre</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="precioMensual" class="form-control" value="">
                        <label for="precioMensual" class="">Preu mensual</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="md-form">
                        <input type="time" id="horarioDesde" class="form-control" value="">
                        <label for="horarioDesde" class="">Horari inici</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="md-form">
                        <input type="time" id="horarioHasta" class="form-control" value="">
                        <label for="horarioHasta" class="">Horari fins</label>
                    </div>
                </div>
            </div>

            <div class="row">



                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-md-12">
                            <select id="actividadesAplicar" class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here..">
                                <?php
                                echo "<option value='' disabled selected>Seleccionar activitats</option>";
                                foreach ($actividades as $v) {
                                    $actividad = $v->descripcion;
                                    mensaje("<option value='$v->num_actividad'>$actividad</option>");
                                    echo "<option value='$v->num_actividad'>$actividad</option>";
                                } ?>
                            </select>
                            <label class="mdb-main-label">Activitats a aplicar</label>
                            <!-- <button class="btn-save btn btn-primary btn-sm">Save</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <button id="aplicar" type="button" class="btn btn-primary">Aplicar</button>
            <a id="cancelar" href="<?php echo base_url() ?>index.php/actividades/actividades" class="btn btn-warning">Cancel·lar i anar a taula activitats</a>


        </div>



        <!--Blue select-->






</body>
<script>
    $(document).ready(function() {
        // Material Select Initialization
        $('.mdb-select').materialSelect();

        $("#modalInfo").on("hidden.bs.modal", function() {
            window.location.href = "<?php echo base_url() ?>index.php/actividades/actividades";
        });

        $('#aplicar').click(function() {
            var precioAnual = $('#precioAnual').val()
            var precioTrimestral = $('#precioTrimestral').val()
            var precioMensual = $('#precioMensual').val()
            var horarioDesde = $('#horarioDesde').val()
            var horarioHasta = $('#horarioHasta').val()
            var actividadesAplicar = $('#actividadesAplicar').val()
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/actividades/putDatos/",
                data: {
                    precioAnual: precioAnual,
                    precioTrimestral: precioTrimestral,
                    precioMensual: precioMensual,
                    horarioDesde: horarioDesde,
                    horarioHasta: horarioHasta,
                    actividadesAplicar: actividadesAplicar


                },
                success: function(datos) {
                    // alert('datos '+datos)
                    var datos = $.parseJSON(datos)
                    // alert('datos '+datos)
                    if (datos == 1) {
                        $('#modalInfoLabel').text("Informació")
                        $('.modal-body').html("Les dades s'han introduït correctament")
                        $('#modalInfo').modal('show')

                    } else {
                        $('#modalInfoLabel').text("Informació")
                        $('.modal-body').html("No s'han introduït cap dada o no ha seleccionat cap activitat.")
                        $('#modalInfo').modal('show')
                    }

                },
                error: function() {
                    alert('Error en putDatos. Informar administrador')
                }
            })


        })

        function getPrecio() {
            var usuario = $('#usuario').val()
            var actividades = $('#actividades').val()
            var trimestres = $('#trimestres').val()
            var numHermano = $('#numHermano').val()
            if (!usuario || !actividades || !trimestres) {
                $('#precioEstandard').val('0.00')
                return
            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/actividades/getPreciosActividades/",
                data: {
                    actividades: actividades,
                    trimestres: trimestres,
                    numHermano: numHermano,
                    usuario: usuario
                },
                success: function(datos) {
                    // alert(datos)
                    var datos = $.parseJSON(datos)

                    // alert(datos)
                },
                error: function() {
                    alert('Error en getActividadesOptions. Informar administrador')
                }
            })

        }


    });
</script>

</html>