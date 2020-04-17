<?php

?>
<style>
    .jumbotron {
        margin-top: 100px;
        margin-left: 80px;
        margin-right: 80px;
    }
    .fa.fa-bars{
        font-size: 20px;
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
    <!-- <script src="http://localhoost:8888/casal_infantil/assets/grocery_crud/themes/mdb/js/bootstrap/dropdown.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/jquery-plugins/bootstrap-growl.min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/jquery-plugins/jquery.print-this.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/common/common.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/js/common/lazyload-min.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/datagrid/gcrud.datagrid.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/themes/mdb/js/datagrid/list.js"></script>
    <script src="<?php echo base_url() ?>assets/grocery_crud/js/jquery_plugins/jquery.chosen.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/grocery_crud/js/jquery_plugins/config/jquery.chosen.config.js"></script> -->

    <!-- Bootstrap tooltips -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/popper.min.js"></script> -->
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script> -->
    <!-- MDB core JavaScript -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/mdb.min.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/usuarios.js"></script>




    <div class="jumbotron">

        <h2 class="display-5">Incripcions nen/nena al <?php echo getTituloCasal() ?> - Curs <?php echo $ultimoCursoTexto ?></h2>
        <h2 class="display-5">Activitats <?php echo $tipo_actividad ?></h2>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <select id="usuario" class="mdb-select md-form colorful-select dropdown-primary" searchable="Cercar aquí..">
                        <?php
                        echo "<option value='' disabled selected>Cercar nen/nena</option>";
                        foreach ($usuarios as $v) {
                            $usuario = $v->nombre_alumno . " " . $v->apellido1_alumno . ' ' . $v->apellido2_alumno . ' DNI tutor/a ' . $v->dni_tutor;
                            echo "<option value='$v->num_usuario'>$usuario</option>";
                        } ?>
                    </select>
                    <label class="mdb-main-label">Nen/nema</label>
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-md-12">
                            <select id="actividades" class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Cercar aquí">
                                <?php
                                echo "<option value='' disabled selected>Seleccionar activitats</option>";
                                foreach ($actividades as $v) {
                                    $actividad = $v->descripcion;
                                    if ($v->completa == 1)
                                        echo "<option value='$v->num_actividad' >$actividad - ACTIVITAT PLENA</option>";
                                    else
                                        echo "<option value='$v->num_actividad' >$actividad</option>";
                                } ?>
                            </select>
                            <label class="mdb-main-label">Activitats</label>
                            <!-- <button class="btn-save btn btn-primary btn-sm">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-md-12">
                            <select id="trimestres" class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Seleccionar períodes">
                                <?php
                                echo "<option value='' disabled selected>Seleccionar períodes</option>";
                                foreach ($periodos as $v) {
                                    $periodo = $v->texto_trimestre;
                                    mensaje("<option value='$v->num_trimestre'>$periodo</option>");
                                    $value = $v->id . $v->num_trimestre;
                                    echo "<option value='$value'>$periodo</option>";
                                } ?>
                            </select>
                            <label class="mdb-main-label">Períodes</label>
                            <!-- <button class="btn-save btn btn-primary btn-sm">Save</button> -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="numHermano" class="form-control" value="" placeholder="Germà núm">
                        <label for="numHermano" class="">Germà núm</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="descuento_ayuntamiento" class="form-control" value="" placeholder="Introduir % descompte">
                        <label for="descuento_ayuntamiento" class="">% Beca Ajuntament</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="descuento_servicios_sociales" class="form-control" value="" placeholder="Introduir % descompte">
                        <label for="descuento_ServiciosSociales" class="disabled">% Beca Serv. Socials</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="precio_estandard" class="form-control" value="0.00" disabled>
                        <label for="precio_estandard" class="disabled">Preu estàndard</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="precio_acordado" class="form-control" value="" placeholder="Introcudir preu especial">
                        <label for="precio_acordado" class="disabled">Preu acordat</label>
                    </div>
                </div>
            </div>
            <button id="calcular_precio" type="button" class="btn btn-primary d-none">Calcular preu</button>

            <hr>
            <h3>Pagament </h3>
            <div class="row">
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="precio_a_pagar" class="form-control" value="0.00" disabled>
                        <label for="precio_a_pagar" class="">Preu a pagar</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="pagado" class="form-control" value="0.00" disabled>
                        <label for="pagado" class="disabled">Pagat</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="number" id="pendiente_pago" class="form-control" value="0.00" disabled>
                        <label for="pendiente_pago" class="disabled">Pendent pagament</label>
                    </div>
                </div>

            </div>
            <button id="emitir_recibo" type="button" class="btn btn-primary">Guardar i preparar rebut</button>
            <button class="btn btn-warning cancel-button waves-effect waves-light" type="button" id="cancel-button">
                <i class="fa fa-warning"></i>
                Cancel·lar                            
            </button>
        </div>



        <!--Blue select-->






</body>
<script>
    $(document).ready(function() {
        // Material Select Initialization
        $('.mdb-select').materialSelect();

        // pone color a las actividades que están completas
        $('body > div.jumbotron > div.container-fluid > div:nth-child(1) > div.col-sm-5 > div > div > div > ul > li').each(function(index){
            if($( this ).text().indexOf('PLENA')>0){
                $(this).addClass('red accent-1')
            }
        })

        inicializar()

        // // boton calcular precio - oculto 
        // $('#calcular_precio').click(function() {
        //     getPrecio()
        // })

        $('#emitir_recibo').click(function() {
            reciboPdf()
        })
        $('#cancel-button').click(function() {
            window.open("<?php echo base_url()?>index.php/bienvenida","_self")
        })



        $('#usuario').change(function() {
            getDatosUsuario($(this).val())
            inicializar()
        })

        function getDatosUsuario(usuario) {
            console.log('usuario: ' + usuario)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/usuarios2/getDatosUsuario/" + usuario,
                data: "",
                success: function(datos) {
                    // console.log(datos)
                    var datos = $.parseJSON(datos)
                    console.log(datos)
                    console.log("datos['hermano_num']" + datos['hermano_num'])
                    $('#descuento_ayuntamiento').val(datos['becas_descuento_ayuntamiento'])
                    $('#descuento_servicios_sociales').val(datos['becas_descuento_servicios_sociales'])
                    $('#numHermano').val(datos['hermano_num'])
                    // $('#numHermano > option:nth-child(3)').attr('selected','selected')
                },
                error: function() {
                    alert('Error en getDatosUsuario. Informar administrador')
                }
            })
        }

        $('#actividades').change(function() {
            var actividades = $('#actividades').val()
            inicializar()
            console.log('actividades ' + actividades)
        })

        // controla que los periodos entrados sean correctos
        // variable global
        var gruposPeriodos = 0

        $('#trimestres').change(function() {
            inicializar()
            gruposPeriodos = 0
            var trimestres = ($('#trimestres').val())
            // alert(trimestres)
            counter = {}
            trimestres.forEach(function(obj) {
                var key = JSON.stringify(obj)
                console.log('key.length ' + key.length)
                var n = key.substr(key.length - 2, 1)
                counter[n] = (counter[n] || 0) + 1
            })
            $.each(counter, function(index, value) {
                if (value > 0) gruposPeriodos++
            });

            if (gruposPeriodos > 1) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Els períodes seleccionats no són compatibles. Han de ser:<br> - Tot l'any;<br>- Un o diversos trimestres;<br>- Un o diversos mesos")
                $('#modalInfo').modal('show')
            }
        })

        $('#numHermano').keyup(function() {
            var numHermano = $('#numHermano').val()
            inicializar()
            console.log('numHermano ' + numHermano)
        })
        $('#descuento_ayuntamiento').keyup(function() {
            var descuento_ayuntamiento = $('#descuento_ayuntamiento').val()
            inicializar()
            console.log('descuento_ayuntamiento ' + descuento_ayuntamiento)
        })
        $('#descuento_servicios_sociales').keyup(function() {
            var descuento_servicion_sociales = $('#descuento_servicios_sociales').val()
            inicializar()
            console.log('descuento_servicios_sociales ' + descuento_servicios_sociales)
        })

        $('#precio_acordado').keyup(function() {
            var precio_acordado = $('#precio_acordado').val()
            inicializar()
            console.log('precio_acordado ' + precio_acordado)
        })


        var numActividadesListaEspera = []
        var listaEspera = []
        var actividadesValidas

        setActividades()

        function setActividades() {
            var actividades = $('#actividades').val()
            actividadesValidas = actividades
            listaEspera = []
            $.each(numActividadesListaEspera, function(index) {
                var espera = numActividadesListaEspera[index]['num_actividad']
                listaEspera.push(espera)
                var posicion = actividadesValidas.indexOf(espera)
                if (posicion > -1) {
                    actividadesValidas.splice(posicion, 1)
                }
            })
        }

        $('#listaEsperaNo').click(function() {
            setActividades()
            listaEspera = []
            console.log(listaEspera)
            console.log(actividadesValidas)
        })
        $('#listaEsperaSi').click(function() {
            // numActividadesListaEspera=datos['actividadesListaEspera']
            setActividades()
            console.log(listaEspera)
            console.log(actividadesValidas)
        })


        // calcula el precio a aplicar
        function getPrecio() {
            // debe existir un periodo
            if (gruposPeriodos > 1) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Els períodes seleccionats no són compatibles. Han de ser:<br> - Tot l'any;<br>- Un o diversos trimestres;<br>- Un o diversos mesos")
                $('#modalInfo').modal('show')
                return
            }

            var curso = <?php echo $ultimoCurso; ?>;
            var usuario = $('#usuario').val()
            var actividades = $('#actividades').val()
            console.log(actividades)
            var trimestres = $('#trimestres').val()


            // verificacion_no_inscrito

            var numHermano = $('#numHermano').val()
            var descuentoAyuntamiento = $('#descuento_ayuntamiento').val()
            var descuentoServiciosSociales = $('#descuento_servicios_sociales').val()
            var precioAcordado = $('#precio_acordado').val()

            //si falta alguna informacion NO se calcula el precio (precio=0)
            // NO se emite mensaje para evitar repeticiones de warnings
            if ($.isEmptyObject(usuario) || $.isEmptyObject(actividades) || $.isEmptyObject(trimestres)) return



            //obtenemos datos actuales inscripciones
            // $.ajax({
            //     type: "POST",
            //     url: "<?php echo base_url() ?>" + "index.php/asistentes/getAsistencias/",
            //     data: {
            //         usuario: usuario,
            //         curso: curso,
            //         actividades,
            //         trimestres
            //     },
            //     success: function(datos) {
            //         // alert(datos)
            //         var datos = $.parseJSON(datos)
            //         // alert(datos)

            //     },
            //     error: function() {
            //         alert('Error en getDatosUsuario. Informar administrador')
            //     }
            // })



            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/actividades/getPreciosActividades/",
                data: {
                    actividades: actividades,
                    trimestres: trimestres,
                    numHermano: numHermano,
                    usuario: usuario,
                    descuentoAyuntamiento: descuentoAyuntamiento,
                    descuentoServiciosSociales: descuentoServiciosSociales,
                    precioAcordado: precioAcordado
                },
                success: function(datos) {
                    // alert(datos)
                    var datos = $.parseJSON(datos)
                    // console.log(datos['precioEstandard'])
                    // console.log(datos['precioAPagar'])
                    var actividadesListaEspera = ""
                    $.each(datos['actividadesListaEspera'], function(index) {
                        actividadesListaEspera += datos['actividadesListaEspera'][index]['descripcion'] + ", "
                        numActividadesListaEspera = datos['actividadesListaEspera']
                    })
                    // var actividadesListaEspera=datos['actividadesListaEspera'][0]['descripcion']
                    // alert(actividadesListaEspera)
                    $('#precio_estandard').val(datos['precioEstandard'].toFixed(2))
                    $('#precio_a_pagar').val(datos['precioAPagar'].toFixed(2))
                    $('#pendiente_pago').val(datos['precioAPagar'].toFixed(2))
                    $('#pago').val(datos['precioAPagar'].toFixed(2))
                    // alert(actividadesListaEspera)
                    setActividades()
                    if (actividadesListaEspera) {
                        $('#modalListaEsperaLabel').text("Activitats plenes")
                        $('.modal-body').html("L'activitat <strong>" + actividadesListaEspera + "</strong> és plena. <br>Vol apuntar-se a la llista d'espera?")
                        $('.delete-confirmation-button').text('No')
                        $('#modalListaEspera').modal('show')
                    }

                },
                error: function() {
                    alert("Error en getPreciosActividades. Informar l'administrador")
                }
            })

        }

        function reciboPdf() {

            var curso = <?php echo $ultimoCurso; ?>;
            var usuario = $('#usuario').val()
            var actividades = $('#actividades').val()
            // alert(actividades)
            var trimestres = $('#trimestres').val()

            if ($.isEmptyObject(usuario)) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Se ha de seleccionar un nen/nena")
                $('#modalInfo').modal('show')
                return
            }

            if ($.isEmptyObject(actividades)) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("S'han d'seleccionar una o diverses activitats ")
                $('#modalInfo').modal('show')
                return
            }

            if ($.isEmptyObject(trimestres)) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("S'han d'seleccionar un o diversos períodes")
                $('#modalInfo').modal('show')
                return
            }

            var precioAPagar = $('#precio_a_pagar').val()
            var actividades = actividadesValidas
            // alert(actividades)
            // var actividades = $('#actividades').val()
            console.log('actividades ' + actividades)
            // if(parseFloat(precioAPagar)==0) {
            //     $('#modalInfoLabel').text("Informació")
            //     $('.modal-body').html("Abans d'emetre el rebut, s'ha de calcular el preu.")
            //     $('#modalInfo').modal('show')
            //     return
            // }

            var usuario = $('#usuario').val()
            var actividades = actividadesValidas
            // alert(actividades)

            var trimestres = $('#trimestres').val()
            var numHermano = $('#numHermano').val()
            var descuentoAyuntamiento = $('#descuento_ayuntamiento').val()
            var descuentoServiciosSociales = $('#descuento_servicios_sociales').val()
            var precioAcordado = $('#precio_acordado').val()
            var id_curso = '<?php echo $ultimoCurso ?>'
            var precioEstandard = $('#precio_estandard').val()
            var precioAPagar = $('#precio_a_pagar').val()
            var pagado = $('#pagado').val()
            var pendientePago = $('#pendiente_pago').val()

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/inscripciones/guardarDatos/",
                data: {
                    usuario: usuario,
                    actividades: actividades,
                    listaEspera: listaEspera,
                    trimestres: trimestres,
                    numHermano: numHermano,
                    descuento_ayuntamiento: descuentoAyuntamiento,
                    descuento_servicios_sociales: descuentoServiciosSociales,
                    precio_acordado: precioAcordado,
                    precio_a_pagar: precioAPagar,
                    id_curso: id_curso,
                    precio_estandard: precioEstandard,
                    pagado: pagado,
                    pendiente_pago: pendientePago,
                    numActividadesListaEspera: numActividadesListaEspera

                },
                success: function(datos) {
                    console.log(datos)
                    var datos = $.parseJSON(datos)
                    // alert(datos)
                    // datos = id de la inscripcion
                    window.location.replace("<?php echo base_url() ?>index.php/inscripciones/recibo/" + datos);
                },
                error: function() {
                    alert("Error en getPreciosActividades. Informar l'administrador")
                }
            })



        }

        // funcion inicializar valores al cambiar campos que afectan al precio
        function inicializar() {
            $('#precio_estandard').val('0.00')
            // $('#precio_acordado').val('')
            $('#precio_a_pagar').val('0.00')
            $('#pagado').val('0.00')
            $('#pago').val('0.00')
            $('#pendiente_pago').val('0.00')
            $('#forma_pago').val('1')

            getPrecio()
        }



    });
</script>

</html>