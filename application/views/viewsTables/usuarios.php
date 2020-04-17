<?php
// mensaje('$ultimoCurso desde página '.$data['ultimoCurso']);
// echo $data['ultimoCurso'];
foreach ($css_files as $k => $file) : ?>
    <link type="text/css" <?php echo $k; ?> rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach ($js_files as $k => $file) : ?>
    <script <?php echo $k; ?> src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<!-- css especifico para la tabla c_usuarios -->
<!-- <link href="<?php echo base_url() ?>css/usuariosEdit.css" rel="stylesheet" id="usuariosEdit"> --> -->
<link href="<?php echo base_url() ?>css/tablasGrocery.css" rel="stylesheet" id="tablasGrocery">
<link href="<?php echo base_url() ?>css/cssTables/usuarios.css" rel="stylesheet">

</head>


<!-- <script src="<?php echo base_url() ?>js/tablasGrocery2.js" ?>></script> -->
<script src="<?php echo base_url() ?>js/tablasGrocery.js" ?></script>
<script src="<?php echo base_url() ?>js/maba.js"></script>

<script>
    $(document).ready(function() {
        
        // elimina última columna
        $('#gcrud-search-form > table > tbody > tr:nth-child(1) > td').css('min-width','0px')

        // indica en la barra del menú las dimensiones de la pantalla
        $('#screenSize').text(' (' + window.screen.width + 'x' + window.screen.height + ' - ' + $(document).width() + 'x' + $(document).height()+')')
        window.onresize = function() {
            $('#screenSize').text(' (' + window.screen.width + 'x' + window.screen.height + ' - ' + $(document).width() + 'x' + $(document).height()+')')
        }

        // replica campos alumno vs tutor
        $('#field-direccion_tutor').change(function(){
            var copia=$('#field-direccion_alumno');
            if(!copia.val()) {
                copia.parent().children().addClass('active')
                copia.val($(this).val())
            }
        })
        $('#field-poblacion_tutor').change(function(){
            var copia=$('#field-poblacion_alumno');
            if(!copia.val()) {
                copia.parent().children().addClass('active')
                copia.val($(this).val())
            }
        })
        $('#field-provincia_tutor').change(function(){
            var copia=$('#field-provincia_alumno');
            if(!copia.val()) {
                copia.parent().children().addClass('active')
                copia.val($(this).val())
            }
        })
        $('#field-codigo_postal_tutor').change(function(){
            var copia=$('#field-codigo_postal_alumno');
            if(!copia.val()) {
                copia.parent().children().addClass('active')
                copia.val($(this).val())
            }
        })

        // se ha eliminado el datapicker en grocery crud mdb porque no funciona
        // ver assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js 
        // tambien se elimina '(dd/mm/aaaa)'   
        $('a.datepicker-input-clear').remove()
        var nodes = $(".becas_desde_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }
        nodes = $(".becas_hasta_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }
        nodes = $(".monitora_desde_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }
        nodes = $(".monitora_hasta_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }
        nodes = $(".fecha_nacimiento_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                // console.log(i)
                // console.log(e)
                if (i == 5) $(this).remove()
            })
        }

        // comentarios_precio no visible si NO contiene nada
        // if ($('#field-comentarios_precio').val() == "")
        //     $('.comentarios_precio_form_group').addClass('d-none')

        //si precio se modifica manualmente, se requiere un comentario
        // $('#field-precio').keyup(function(e) {
        //     if (!$('#field-comentarios_precio').val()) {
        //         $('#modalInfoLabel').text("Informació")
        //         $('.modal-body').html("Si voleu introduir un preu manualment, en primer lloc és obligat posar un comentari de preu")
        //         $('#modalInfo').modal('show')
        //     }
        //     $('.comentarios_precio_form_group').removeClass('d-none')
        // })

        //si se quita comentarios_precio se calcula precio según tarifas
        // $('#field-comentarios_precio').keyup(function(e) {
        //     // console.log('#field-comentarios_precio')
        //     if (!$(this).val()) {
        //         $('#modalInfoLabel').text("Informació")
        //         $('.modal-body').html("A l'eliminar els comentaris preu, es calcula el preu segons les tarifes de les activitats i períodes")
        //         $('#modalInfo').modal('show')
        //         // comprobarActividad()
        //     }
        // })

        //si no se ha indicado actividad marca error y no se puede validar
        // if(!$('#field-id_actividad').val()){
        //     $('#save-and-go-back-button').attr('disabled','disabled')
        //     $('#report-error').css('display','block')
        //     $('#report-error').html("<p>L'activitat no és correcta</p>")
        // }else{
        //     $('#save-and-go-back-button').removeAttr('disabled')
        //     $('#report-error').css('display','none')
        //     $('#report-error').html('')
        // }


        $('button.dropdown-toggle').next('div').each(function() {
            var href = $(this).children('a.dropdown-item').attr('href')
            var href2 = $(this).children('a.dropdown-item').next().attr('href')
            var href3 = $(this).children('a.dropdown-item').next().next().attr('data-target')
            // alert(href) 
            // alert(href2) 
            // alert(href3)  
            $(this).parent().parent().append('<a class="delete-row btn btn-danger btn-sm waves-effect waves-light" data-target="' + href3 + '" href="javascript:void(0)" title="Esborrar"><i class="fa fa-trash-o"></i></a>')
            $(this).parent().parent().append('<a class="btn default-color-ficha btn-sm edit-button waves-effect waves-light" href="' + href + '">Fitxa</a>')
            // $(this).parent().parent().append('<a class="btn default-color-ficha btn-sm edit-button waves-effect waves-light" href="' + href2 + '">Pagament</a>')
        })
        $('button.dropdown-toggle').parent().addClass('d-none')

        //ocultar boton delete
        // $('a.delete-row').addClass('d-none')
        // $('#gcrud-search-form > table > tbody > tr > td:nth-child(7) > div.d-block.d-md-none > a:nth-child(4)').addClass('d-none')
        // $('#gcrud-search-form > table > tbody > tr > td:nth-child(7) > div.d-none.d-lg-block.d-xl-block.d-md-block').removeClass('d-none')
        // $('#gcrud-search-form > table > tbody > tr > td:nth-child(7) > div.d-block.d-md-none > a:nth-child(3)').addClass('d-none')
        
        //proceso borrado 
        var numUsuario = 0
        $(document).on('click', 'a.delete-row', function(e) {
            // alert('a.delete-row click')
            var stringDato = $(this).attr('data-target')
            // alert('stringDato '+stringDato)
            var splittedDato = stringDato.split("/")
            numUsuario = splittedDato[splittedDato.length - 1]
            // alert('numUsuario '+numUsuario)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/inscripciones/getDatosInscripciones/" + numUsuario,
                data: "",
                success: function(datos) {
                     console.log(datos)
                    var datos = $.parseJSON(datos)
                    console.log(datos)
                    // console.log("datos['numInscipciones'] "+datos)
                    if (datos > 0) {
                        //no se puede eliminar
                        $('.delete-confirmation-button').addClass('d-none')
                        $('#modalInfoLabel').text("Esborrar Usuari/Usuària")
                        $('.modal-body').html("Aquest usuari no es pot esborrar perquè té "+ datos +" inscripcions.")
                        return
                    } else {
                        //si se puede eliminar
                        $('.delete-confirmation-button').removeClass('d-none')
                        $('.modal-body').html("Segur que vols esborrar aquest usuari/usuària?")
                    }

                },
                error: function() {
                    alert('Error en getDatosActividad. Informar administrador')
                }
            })
        });


        

        // $("#modalSiNo").on("hidden.bs.modal", function () {
        //     // put your default event here
        //     console.log('cierre modal window')
        //     window.location.replace("<?php echo base_url() ?>index.php/usuarios2/usuarios");
        // });

        //elimina Cleaner (Neteja) en datapicker 
        //$('.datepicker-input-clear').text('')


        //width columnas en tabla
        //     $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(2)').css('width', '5px') 
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 3)').css('width', '20px')
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 4)').css('width', '20px')
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 5)').css('width', '20px')
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 6)').css('width', '20px')
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 7)').css('width', '20px')
        // ajuste anchura última columna (acciones)
        // $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 8)').css('width', 'auto')
        
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 9)').css('width', '5px ')
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(10)').css('width', '5px')

        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(8)').css('width', '14px') 
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(9)').css('width', '80px') 
        //    $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(9)').css('width', '10px') 
        //alineamiento columnas
        //$('#gcrud-search-form > table > tbody > tr > td:nth-child(9)').css('text-align', 'right')

        // establecer width columna acciones
        $('#gcrud-search-form > table > tbody > tr > td:nth-child(7)').css('width','250px')

        // establecer anchura datos última columna (acciones)
        $('#gcrud-search-form > table > tbody > tr > td:nth-child(8)').css('padding-right','0px')
        $('#gcrud-search-form > table > tbody > tr > td:nth-child(8)').css('width', 'auto')

        //para ocultar text select id_actividad
        // $('#crudForm > div > div.card-body > div.md-form.id_actividad_form_group > label').text("")

        //para ocultar texto select pagado
        // $('#crudForm > div > div.card-body > div.md-form.pagado_form_group > label').text("")

        // //si está pagado, no se pueden modificar lo que afecta al precio
        // var usuario = $('#field-num_usuario').val()
        // $.ajax({
        //     type: "POST",
        //     url: "<?php echo base_url() ?>" + "index.php/usuarios/comprobarPagado/" + usuario,
        //     data: "",
        //     success: function(datos) {
        //         var datos = $.parseJSON(datos)
        //         if (datos == 1) {
        //             // console.log('sí, ya pagado')

        //             // $('select#field-id_actividad').attr('disabled', 'disabled') 
        //             $('#field-id_actividad > option').attr('disabled', 'disabled')
        //             $('#field-comentarios_precio').attr('disabled', 'disabled')
        //             // $('select[name="id_actividad"]').attr('disabled', 'disabled')
        //         }
        //     },
        //     error: function() {
        //         alert('Error en comprobarPagado. Informar administrador')
        //     }
        // })

        function* values(obj) {
            for (let prop of Object.keys(obj)) // own properties, you might use
                // for (let prop in obj)
                yield obj[prop];
        }

        var valoresInicialesActividades = $('#field-id_actividad').val()
        var valoresInicialesTrimestres = $('#field-id_trimestre').val()



        //comprueba si la actividad es OK y si sí poner precio
        // function comprobarActividad() {
        //     var pagado = $('#crudForm > div > div.card-body > div.md-form.texto_status_pagado_form_group > label').html()

        //     if (pagado == "Sí" || $('#field-comentarios_precio').val() != "") {
        //         $('#modalInfoLabel').text("Informació")
        //         $('.modal-body').html("Usuari amb activitat pagada: no es modificaran el preu, las activitats, períodes, ni percentatges de reduccions preu.<br> Per canviar-los s'ha de procedir, primer, a devolució de l'pagament de la inscripció i, després, modificar-la convenientment.")
        //         $('#modalInfo').modal('show')
        //     }
        //     // si se ha puesto un comentario precio, entonces se conserva el precio puesto manualmente
        //     if ($('#field-comentarios_precio').val() != "") return;
        //     // si está pagado no se recalcula el precio
        //     if (pagado == "Sí") {
        //         $('#field-id_actividad').val(valoresInicialesActividades)
        //         $('#field-id_trimestre').val(valoresInicialesTrimestres)
        //         return
        //     }
        //     if ($('#field-comentarios_precio').val() != "") {
        //         $('#field-id_actividad').val(valoresInicialesActividades)
        //         $('#field-id_trimestre').val(valoresInicialesTrimestres)
        //         return
        //     }
        //     var actividades = $('#field-id_actividad').val()
        //     var trimestres = $('#field-id_trimestre').val()
        //     // console.log('actividades ' + actividades)
        //     // console.log('trimestres ' + trimestres)
        //     // if (!actividades) {
        //     //     $('#modalInfoLabel').text("Informació")
        //     //     $('.modal-body').html("S'ha de seleccionar al menys una activitat")
        //     //     $('#modalInfo').modal('show')
        //     //     // $('#save-and-go-back-button').attr('disabled', 'disabled')
        //     //     $('#report-error').css('display', 'block')
        //     //     $('#report-error').html("<p>S'ha de seleccionar al menys una activitat</p>")
        //     //     return
        //     // }
        //     // if (!trimestres) {
        //     //     $('#modalInfoLabel').text("Informació")
        //     //     $('.modal-body').html("S'ha de seleccionar al menys un període")
        //     //     $('#modalInfo').modal('show')
        //     //     // $('#save-and-go-back-button').attr('disabled', 'disabled')
        //     //     $('#report-error').css('display', 'block')
        //     //     $('#report-error').html("<p>S'ha de seleccionar al menys un període</p>")
        //     //     return
        //     // }
        //     // var trimestresArray=trimestres.split(',')
        //     // console.log('trimestresArray ' + typeof(trimestres))
        //     let arr = Array.from(values(trimestres));
        //     // console.log('arr ' + typeof(arr))
        //     // console.log('arr v' + arr)
        //     var curso = 0;
        //     var trimestre = 0
        //     var mes = 0
        //     arr.forEach(function(item, index) {
        //         // console.log('index ' + index + ' item ' + item)
        //         if (item == 1) curso += 1
        //         if (item >= 2 && item <= 4) trimestre += 1
        //         if (item >= 6) mes += 1
        //     });
        //     if (curso == 1 && trimestre == 0 && mes == 0) {
        //         calcularPrecio(actividades, curso, trimestre, mes)
        //         return
        //     }
        //     if (curso == 0 && trimestre > 0 && mes == 0) {
        //         calcularPrecio(actividades, curso, trimestre, mes)
        //         return
        //     }
        //     if (curso == 0 && trimestre == 0 && mes > 0) {
        //         calcularPrecio(actividades, curso, trimestre, mes)
        //         return
        //     }
        //     $('#modalInfoLabel').text("Informació")
        //     $('.modal-body').html("La selecció dels períodes ha de ser:<br> només tot el curs,<br> un o diversos trimestres, <br>un o diversos mesos.<br> No es pot seleccionar altres combinacions")
        //     $('#modalInfo').modal('show')
        //     // $('#save-and-go-back-button').attr('disabled', 'disabled')
        //     $('#report-error').css('display', 'block')
        //     $('#report-error').html("<p>La selecció dels períodes ha de ser: només tot el curs, un o diversos trimestres, un o diversos mesos. No es pot seleccionar altres combinacions</p>")
        //     return


        //     // return
        //     // alert('num_actividad '+actividades);

        //     // if (actividades) {
        //     //     // if(true){
        //     //     $.ajax({
        //     //         type: "POST",
        //     //         url: "<?php echo base_url() ?>" + "index.php/actividades/comprobarInscripcion/",
        //     //         data: {actividades: actividades},
        //     //         success: function(datos) {
        //     //             //  alert('success '+datos)
        //     //             var datos = $.parseJSON(datos)
        //     //             if (!datos) {
        //     //                 calcularPrecio()
        //     //                 $('#save-and-go-back-button').removeAttr('disabled')
        //     //                 $('#report-error').css('display', 'none')
        //     //                 $('#report-error').html('')

        //     //                 $('#modalInfoLabel').text("Informació")
        //     //                 $('.modal-body').html("Preu recalculat")
        //     //                 $('#modalInfo').modal('show')

        //     //                 return true;
        //     //             }
        //     //             $('#modalInfoLabel').text("Informació")
        //     //             $('.modal-body').html(datos)
        //     //             $('#modalInfo').modal('show')
        //     //             $('#save-and-go-back-button').attr('disabled', 'disabled')
        //     //             $('#report-error').css('display', 'block')
        //     //             $('#report-error').html("<p>L'activitat no és correcta</p>")
        //     //             return false;
        //     //         },
        //     //         error: function() {
        //     //             alert('Error en comprobarActividad. Informar administrador')
        //     //         }
        //     //     })
        //     // }
        // }

        function yearsOld(fechaNacimiento) {
            if (!fechaNacimiento) return -1;
            var fechaNacimiento = new Date(fechaNacimiento);
            var today = new Date();
            var age = Math.floor((today - fechaNacimiento) / (365.25 * 24 * 60 * 60 * 1000));

            return age;
        }

        if ($('#field-fecha_nacimiento').val()) {
            $('.texto_edad_form_group').children().text('')
            var fechaNacimiento = getFechaAnoMesDia($('#field-fecha_nacimiento').val())
            // console.log(fechaNacimiento)
            var edad = yearsOld(fechaNacimiento)
            // console.log(edad)
            if (edad == -1) {
                return
            }
            $('.texto_edad_form_group').children().text(edad)
        }

        $('#field-fecha_nacimiento').change(function() {
            $('.texto_edad_form_group').children().text('')
            var fechaNacimiento = getFechaAnoMesDia($('#field-fecha_nacimiento').val())
            // console.log(fechaNacimiento)
            var edad = yearsOld(fechaNacimiento)
            // console.log(edad)
            if (edad == -1) {
                return
            }
            $('.texto_edad_form_group').children().text(edad)
        })

        //function para calcularPrecio
        function calcularPrecio(actividades, curso, trimestre, mes) {



            var precio = $('#field-precio').val()
            //if (precio!=0) return


            var hermanosActividad = $('#field-hermanos_actividad').val()
            var hermanosNum = $('#field-hermano_num').val()
            var becasAyuntamiento = $('#field-becas_descuento_ayuntamiento').val()
            var becasServiciosSociales = $('#field-becas_descuento_servicios_sociales').val()

            // console.log(' precio ' + precio)
            // console.log(' actividades ' + actividades)
            // console.log(' curso ' + curso)
            // console.log(' trimestre ' + trimestre)
            // console.log(' mes ' + mes)
            // console.log(' hermanosActividad ' + hermanosActividad)
            // console.log(' hermanosNum ' + hermanosNum)
            // console.log(' becasAyuntamiento ' + becasAyuntamiento)
            // console.log(' becasServiciosSociales ' + becasServiciosSociales)

            // console.log('actividad ' + actividad)
            // if (!trimestre) trimestre = 1
            if (!hermanosActividad) hermanosActividad = 0
            if (!hermanosNum) hermanosNum = 0
            if (!becasAyuntamiento) becasAyuntamiento = 0
            if (!becasServiciosSociales) becasServiciosSociales = 0
            // console.log('trimestre ' + trimestre)
            // console.log('hermanosActividad ' + hermanosActividad)
            // console.log('hermanosNum ' + hermanosNum)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/usuarios2/calcularPrecio/",
                data: {
                    actividades: actividades,
                    curso: curso,
                    trimestre: trimestre,
                    mes: mes,
                    hermanosActividad: hermanosActividad,
                    hermanosNum: hermanosNum,
                    // edad: edad,
                    becasAyuntamiento: becasAyuntamiento,
                    becasServiciosSociales: becasServiciosSociales
                },
                success: function(datos) {
                    // console.log(datos)
                    var datos = $.parseJSON(datos)
                    // console.log(datos)
                    $('.precio_form_group label').addClass('active')
                    $('#field-precio').val(datos)
                },
                error: function() {
                    alert('Error en calculoPrecio. Informar administrador')
                }
            })
        }


        //verifica que el German Núm sea gual o superior a Total Germans
        $('#field-hermano_num').change(function() {
            if ($(this).val() > $('#field-hermanos_actividad').val()) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("El Total germans debe ser igual o superior a German Núm")
                $('#modalInfo').modal('show')
                $(this).val(0)
            }
        })

        $('#field-id_hermanos_actividad').change(function() {
            if ($(this).val() == 2) {
                $('#field-hermanos_actividad').val(0)
                $('#field-hermano_num').val(0)
            }
            // comprobarActividad()
        })

        // comprobarActividad()

        $('#field-fecha_nacimiento').change(function() {
            // comprobarActividad()
        })
        $('#field-id_actividad').change(function() {
            // comprobarActividad()
        })

        $('#field-id_trimestre').change(function() {
            // comprobarActividad()
        })
        $('#field-hermanos_actividad').change(function() {
            // comprobarActividad()
        })
        $('#field-hermano_num').change(function() {
            // if ($(this).val() != 0)
            // comprobarActividad()
        })
        $('#field-becas_descuento_ayuntamiento').change(function() {
            // if ($(this).val() != 0)
            // comprobarActividad()
        })
        $('#field-becas_descuento_servicios_sociales').change(function() {
            // if ($(this).val() != 0)
            // comprobarActividad()
        })






        // $('#field-id_curso option [value="3"]').attr('selected','selected')
        // $('[name=id_curso]').val( 2 );
        //$('select[name="id_curso"] option[value="3"]').attr("selected","selected"); 

        //$('#field-id_curso > option:nth-child(4)').attr('selected','selected')

        // $('#form-button-save').attr('data-toggle','modal')
        // $('#form-button-save').attr('data-target','#modalInfo')
        // $('#save-and-go-back-button').attr('data-toggle','modal')
        // $('#save-and-go-back-button').attr('data-target','#basicExampleModal')

        $('#form-button-save').click(function(e) {
            return;
            e.preventDefault()
            // $('#modalInfoLabel').text('Recibo Pago Actividad '+$('#field-dni_tutor').val())
            // $('.modal-body').text('Hola 2')
            // // $('#modalInfo').modal('show')
            // e.preventDefault()
            //alert("voy a actualizar")
        })


        //pone cursor en dni_tutor
        if ($('#crudForm > div > div.card-header.red.white-text').text().includes('Afegir')) {
            $('#field-dni_tutor').val(" ");
            $('#field-dni_tutor').focus();
        }

        //cuando se ha introducido el dni_tutor y si ya existe y es añadir copia valoes del tutor
        $('#field-dni_tutor').blur(function() {
            var dni_tutor = $(this).val().trim()
            if (dni_tutor == "") dni_tutor = "1"
            if ($('#crudForm > div > div.card-header.red.white-text').text().includes('Afegir')) {
                //ver si existe en la BD este tutor
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + "index.php/usuarios/getDatosTutor/" + dni_tutor,
                    //data: {dni_tutor:dni_tutor},
                    success: function(datos) {
                        // alert(datos)
                        // alert(datos.length)
                        if (datos.length !== 4) {
                            var datos = $.parseJSON(datos)
                            $('#field-nombre_tutor').val(datos.nombre_tutor)
                            $('#field-nombre_tutor').focus()
                            $('#field-apellido1_tutor').val(datos.apellido1_tutor)
                            $('#field-apellido2_tutor').focus()
                            $('#field-apellido2_tutor').val(datos.apellido2_tutor)
                            $('#field-apellido1_tutor').focus()
                            $('#field-direccion_tutor').val(datos.direccion_tutor)
                            $('#field-direccion_tutor').focus()
                            $('#field-poblacion_tutor').val(datos.poblacion_tutor)
                            $('#field-poblacion_tutor').focus()
                            $('#field-provincia_tutor').val(datos.provincia_tutor)
                            $('#field-provincia_tutor').focus()
                            $('#field-email_tutor').val(datos.email_tutor)
                            $('#field-email_tutor').focus()
                            $('#field-codigo_postal_tutor').val(datos.codigo_postal_tutor)
                            $('#field-codigo_postal_tutor').focus()
                            $('#field-telefono1_tutor').val(datos.telefono1_tutor)
                            $('#field-telefono1_tutor').focus()
                            $('#field-telefono2_tutor').val(datos.telefono2_tutor)
                            $('#field-telefono2_tutor').focus()
                            $('#field-profesion_madre').val(datos.profesion_madre)
                            $('#field-profesion_madre').focus()
                            $('#field-profesion_padre').val(datos.profesion_padre)
                            $('#field-profesion_padre').focus()
                            $('#field-dni_alumno').val(" ")
                            $('#field-dni_alumno').focus()
                        }


                    },
                    error: function() {
                        alert('Error en getDatosTutor. Informar administrador')
                    }
                })

                // $('#field-nombre_tutor').val("Miguel Angel")
                // $('#field-nombre_tutor').focus()

            }
        })

        //cuando se ha introducido el dni_alumno y si ya existe y es añadir copia valoes del tutor
        $('#field-dni_alumno').blur(function() {
            var dni_alumno = $(this).val().trim()
            if (dni_alumno == "") dni_alumno = "1"

            if ($('#crudForm > div > div.card-header.red.white-text').text().includes('Afegir')) {
                //ver si existe en la BD este alumno
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + "index.php/usuarios/getDatosAlumno/" + dni_alumno,
                    //data: {dni_alumno:dni_alumno},
                    success: function(datos) {
                        // alert(datos)
                        if (datos.length !== 4) {
                            var datos = $.parseJSON(datos)
                            $('#field-nombre_alumno').val(datos.nombre_alumno)
                            $('#field-nombre_alumno').focus()
                            $('#field-apellido1_alumno').val(datos.apellido1_alumno)
                            $('#field-apellido2_alumno').focus()
                            $('#field-apellido2_alumno').val(datos.apellido2_alumno)
                            $('#field-apellido1_alumno').focus()
                            $('#field-direccion_alumno').val(datos.direccion_alumno)
                            $('#field-direccion_alumno').focus()
                            $('#field-poblacion_alumno').val(datos.poblacion_alumno)
                            $('#field-poblacion_alumno').focus()
                            $('#field-provincia_alumno').val(datos.provincia_alumno)
                            $('#field-provincia_alumno').focus()

                            $('#field-codigo_postal_alumno').val(datos.codigo_postal_alumno)
                            $('#field-codigo_postal_alumno').focus()
                            var fecha = datos.fecha_nacimiento.substring(8, 10) + "/" + datos.fecha_nacimiento.substring(5, 7) + "/" + datos.fecha_nacimiento.substring(0, 4)
                            $('#field-fecha_nacimiento').val(fecha)
                            $('#field-fecha_nacimiento').focus()
                            //oculta selector fechas
                            $('#ui-datepicker-div > div.ui-datepicker-buttonpane.ui-widget-content > button.ui-datepicker-close.ui-state-default.ui-priority-primary.ui-corner-all').trigger('click')
                            $('#field-escuela').val(datos.escuela)
                            $('#field-curso_escolar').focus()
                        }


                    },
                    error: function() {
                        alert('Error en getDatosAlumno. Informar administrador')
                    }
                })

                // $('#field-nombre_alumno').val("Miguel Angel")
                // $('#field-nombre_alumno').focus()

            }
        })

        //click para ocultar mensaje de error
        if ($('#report-error').length) {
            if ($('#report-error >p').html() != "L'activitat no és correcta")
                $('#report-error').click(function() {
                    $(this).css('display', 'none')
                })
        }


        $("<p class='subtitulo subtitulo1'><strong>1. DADES PERSONALS RESPONSABLE</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.dni_tutor_form_group");
        $("<p class='subtitulo subtitulo1a'><strong>2. DADES SEGON CONTACTE</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.dni_tutor_2_form_group");
        $("<p class='subtitulo subtitulo2'><strong>3. DADES PERSONALS INFANT/ JOVE</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.dni_alumno_form_group");
        // $("<p class='subtitulo subtitulo3'><strong>3. GRUP ON REALITZA LA INSCRIPCIÓ</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo4'><strong>4. MÉS DADES</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.texto_id_becas_form_group");
        $("<p class='subtitulo subtitulo5'><strong>5. FITXA DE SALUT</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.texto_id_alergia_form_group");
        $("<p class='subtitulo subtitulo6'><strong>6. DOCUMENTACIÓ A ADJUNTAR</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.texto_id_presenta_dni_tutor_form_group");
        $("<p class='subtitulo subtitulo7'><strong>7. COMUNICACIONS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.texto_id_comunicaciones_form_group");
        $("<p class='subtitulo subtitulo8'><strong>8. AUTORITZACIONS ENTRADES I SORTIDES</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.texto_id_aut_acompanar_form_group");
        $("<p class='subtitulo subtitulo9'><strong>9. AUTORITZACIONS LEGALS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.texto_id_decisiones_urgentes_form_group");
        $("<p class='subtitulo subtitulo10'><strong>SIGNATURA PARE/ AMRE/ TUTOR/A</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");

        /*control tamaño pantalla*/
        var texto = $('#crudForm > div > div.card-header.red.white-text').text()
        $('#crudForm > div > div.card-header.red.white-text').text(texto)

        //num_usuario disabled y quita linea
        $('#field-num_usuario').addClass('disabled')
        $('#field-num_usuario').css('border-bottom', '0px')


        // //inicializar mostrar .becas_desde_form_group
        // if ($('#field-id_becas').val() == 1) {
        //     $('.becas_desde_form_group').removeClass('d-none')
        //     $('.becas_desde_form_group').addClass('d-block')
        //     $('.becas_hasta_form_group').removeClass('d-none')
        //     $('.becas_hasta_form_group').addClass('d-block')
        // } else {
        //     $('.becas_desde_form_group').removeClass('d-block')
        //     $('.becas_desde_form_group').addClass('d-none')
        //     $('.becas_hasta_form_group').removeClass('d-block')
        //     $('.becas_hasta_form_group').addClass('d-none')
        // }

        // $('#field-id_becas').change(function() {
        //     // console.log('#field-id_becas')
        //     $('.becas_desde_form_group').removeClass('d-block')
        //     $('.becas_desde_form_group').removeClass('d-none')
        //     $('.becas_hasta_form_group').removeClass('d-block')
        //     $('.becas_hasta_form_group').removeClass('d-none')
        //     if ($(this).val() != 1) {
        //         $('.becas_desde_form_group').addClass('d-none')
        //         $('.becas_hasta_form_group').addClass('d-none')
        //     } else {
        //         $('.becas_desde_form_group').removeClass('d-block')
        //         $('.becas_hasta_form_group').removeClass('d-block')
        //     }
        // })

        //inicializar mostrar .becas_desde_form_group
        if ($('#field-id_becas').val() == 1) {
            // console.log('field-id_becas vale 1')
            $('.becas_descuento_ayuntamiento_form_group').removeClass('d-none')
            $('.becas_descuento_ayuntamiento_form_group').addClass('d-block')
            $('.becas_descuento_servicios_sociales_form_group').removeClass('d-none')
            $('.becas_descuento_servicios_sociales_form_group').addClass('d-block')
        } else {
            // console.log('field-id_becas vale 0')
            $('.becas_descuento_ayuntamiento_form_group').removeClass('d-block')
            $('.becas_descuento_ayuntamiento_form_group').addClass('d-none')
            $('.becas_descuento_servicios_sociales_form_group').removeClass('d-block')
            $('.becas_descuento_servicios_sociales_form_group').addClass('d-none')
        }

        $('#field-id_becas').change(function() {
            // console.log('#field-id_becas')
            $('.becas_descuento_ayuntamiento_form_group').removeClass('d-block')
            $('.becas_descuento_ayuntamiento_form_group').removeClass('d-none')
            $('.becas_descuento_servicios_sociales_form_group').removeClass('d-block')
            $('.becas_descuento_servicios_sociales_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.becas_descuento_ayuntamiento_form_group').addClass('d-none')
                $('.becas_descuento_servicios_sociales_form_group').addClass('d-none')
            } else {
                $('.becas_descuento_ayuntamiento_form_group').removeClass('d-block')
                $('.becas_descuento_servicios_sociales_form_group').removeClass('d-block')
            }
        })



        //inicializar mostrar .monitora_desde_form_group
        if ($('#field-id_monitora').val() == 1) {
            $('.monitora_desde_form_group').removeClass('d-none')
            $('.monitora_desde_form_group').addClass('d-block')
            $('.monitora_hasta_form_group').removeClass('d-none')
            $('.monitora_hasta_form_group').addClass('d-block')
        } else {
            $('.monitora_desde_form_group').removeClass('d-block')
            $('.monitora_desde_form_group').addClass('d-none')
            $('.monitora_hasta_form_group').removeClass('d-block')
            $('.monitora_hasta_form_group').addClass('d-none')
        }

        $('#field-id_monitora').change(function() {
            $('.monitora_desde_form_group').removeClass('d-block')
            $('.monitora_desde_form_group').removeClass('d-none')
            $('.monitora_hasta_form_group').removeClass('d-block')
            $('.monitora_hasta_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.monitora_desde_form_group').addClass('d-none')
                $('.monitora_hasta_form_group').addClass('d-none')
            } else {
                $('.monitora_desde_form_group').removeClass('d-block')
                $('.monitora_hasta_form_group').removeClass('d-block')
            }
        })
        //inicializar mostrar .hermanos_actividad_form_group
        // alert($('#field-id_hermanos_actividad').val())
        if ($('#field-id_hermanos_actividad').val() == 1) {
            $('.hermanos_actividad_form_group').removeClass('d-none')
            $('.hermanos_actividad_form_group').addClass('d-block')
            $('.hermano_num_form_group').removeClass('d-none')
            $('.hermano_num_form_group').addClass('d-block')
        } else {
            $('.hermanos_actividad_form_group').removeClass('d-block')
            $('.hermanos_actividad_form_group').addClass('d-none')
            $('.hermano_num_form_group').removeClass('d-block')
            $('.hermano_num_form_group').addClass('d-none')
        }

        $('#field-id_hermanos_actividad').change(function() {
            $('.hermanos_actividad_form_group').removeClass('d-block')
            $('.hermanos_actividad_form_group').removeClass('d-none')
            $('.hermano_num_form_group').removeClass('d-block')
            $('.hermano_num_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.hermanos_actividad_form_group').addClass('d-none')
                $('.hermano_num_form_group').addClass('d-none')
            } else {
                $('.hermanos_actividad_form_group').removeClass('d-block')
                $('.hermano_num_form_group').removeClass('d-block')
            }
        })


        //inicializar mostrar .asistencia_atencion_form_group
        // alert($('#field-id_asistencia_atencion').val())

        if ($('#field-id_asistencia_atencion').val() == 1) {
            $('.asistencia_atencion_form_group').removeClass('d-none')
            $('.asistencia_atencion_form_group').addClass('d-block')
        } else {
            $('.asistencia_atencion_form_group').removeClass('d-block')
            $('.asistencia_atencion_form_group').addClass('d-none')
        }

        $('#field-id_asistencia_atencion').change(function() {
            $('.asistencia_atencion_form_group').removeClass('d-block')
            $('.asistencia_atencion_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.asistencia_atencion_form_group').addClass('d-none')
            } else {
                $('.asistencia_atencion_form_group').removeClass('d-block')
            }
        })
        // if ($('#field-id_derivado').val() == 1) {
        //     $('.derivado_form_group').removeClass('d-none')
        //     $('.derivado_form_group').addClass('d-block')
        // } else {
        //     $('.derivado_form_group').removeClass('d-block')
        //     $('.derivado_form_group').addClass('d-none')
        // }

        // $('#field-id_derivado').change(function() {
        //     $('.derivado_form_group').removeClass('d-block')
        //     $('.derivado_form_group').removeClass('d-none')
        //     if ($(this).val() != 1) {
        //         $('.derivado_form_group').addClass('d-none')
        //     } else {
        //         $('.derivado_form_group').removeClass('d-block')
        //     }
        // })
        if ($('#field-id_alergia').val() == 1) {
            $('.alergia_form_group').removeClass('d-none')
            $('.alergia_form_group').addClass('d-block')
            $('.alergia_medicacion_form_group').removeClass('d-none')
            $('.alergia_medicacion_form_group').addClass('d-block')
        } else {
            $('.alergia_form_group').removeClass('d-block')
            $('.alergia_form_group').addClass('d-none')
            $('.alergia_medicacion_form_group').removeClass('d-block')
            $('.alergia_medicacion_form_group').addClass('d-none')
        }

        $('#field-id_alergia').change(function() {
            $('.alergia_form_group').removeClass('d-block')
            $('.alergia_form_group').removeClass('d-none')
            $('.alergia_medicacion_form_group').removeClass('d-block')
            $('.alergia_medicacion_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.alergia_form_group').addClass('d-none')
                $('.alergia_medicacion_form_group').addClass('d-none')
            } else {
                $('.alergia_form_group').removeClass('d-block')
                $('.alergia_medicacion_form_group').removeClass('d-block')
            }
        })

        if ($('#field-id_insuficiencia').val() == 1) {
            $('.insuficiencia_form_group').removeClass('d-none')
            $('.insuficiencia_form_group').addClass('d-block')
            $('.insuficiencia_medicacion_form_group').removeClass('d-none')
            $('.insuficiencia_medicacion_form_group').addClass('d-block')
        } else {
            $('.insuficiencia_form_group').removeClass('d-block')
            $('.insuficiencia_form_group').addClass('d-none')
            $('.insuficiencia_medicacion_form_group').removeClass('d-block')
            $('.insuficiencia_medicacion_form_group').addClass('d-none')
        }

        $('#field-id_insuficiencia').change(function() {
            $('.insuficiencia_form_group').removeClass('d-block')
            $('.insuficiencia_form_group').removeClass('d-none')
            $('.insuficiencia_medicacion_form_group').removeClass('d-block')
            $('.insuficiencia_medicacion_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.insuficiencia_form_group').addClass('d-none')
                $('.insuficiencia_medicacion_form_group').addClass('d-none')
            } else {
                $('.insuficiencia_form_group').removeClass('d-block')
                $('.insuficiencia_medicacion_form_group').removeClass('d-block')
            }
        })


        if ($('#field-id_respiratoria').val() == 1) {
            $('.respiratoria_form_group').removeClass('d-none')
            $('.respiratoria_form_group').addClass('d-block')
        } else {
            $('.respiratoria_form_group').removeClass('d-block')
            $('.respiratoria_form_group').addClass('d-none')
        }

        $('#field-id_respiratoria').change(function() {
            $('.respiratoria_form_group').removeClass('d-block')
            $('.respiratoria_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.respiratoria_form_group').addClass('d-none')
            } else {
                $('.respiratoria_form_group').removeClass('d-block')
            }
        })

        if ($('#field-id_vascular').val() == 1) {
            $('.vascular_form_group').removeClass('d-none')
            $('.vascular_form_group').addClass('d-block')
        } else {
            $('.vascular_form_group').removeClass('d-block')
            $('.vascular_form_group').addClass('d-none')
        }

        $('#field-id_vascular').change(function() {
            $('.vascular_form_group').removeClass('d-block')
            $('.vascular_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.vascular_form_group').addClass('d-none')
            } else {
                $('.vascular_form_group').removeClass('d-block')
            }
        })
        if ($('#field-id_cronica').val() == 1) {
            $('.cronica_form_group').removeClass('d-none')
            $('.cronica_form_group').addClass('d-block')
        } else {
            $('.cronica_form_group').removeClass('d-block')
            $('.cronica_form_group').addClass('d-none')
        }

        $('#field-id_cronica').change(function() {
            $('.cronica_form_group').removeClass('d-block')
            $('.cronica_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.cronica_form_group').addClass('d-none')
            } else {
                $('.cronica_form_group').removeClass('d-block')
            }
        })

        if ($('#field-id_hemorragia').val() == 1) {
            $('.hemorragia_form_group').removeClass('d-none')
            $('.hemorragia_form_group').addClass('d-block')
        } else {
            $('.hemorragia_form_group').removeClass('d-block')
            $('.hemorragia_form_group').addClass('d-none')
        }

        $('#field-id_hemorragia').change(function() {
            $('.hemorragia_form_group').removeClass('d-block')
            $('.hemorragia_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.hemorragia_form_group').addClass('d-none')
            } else {
                $('.hemorragia_form_group').removeClass('d-block')
            }
        })
        if ($('#field-id_medicacion').val() == 1) {
            $('.medicacion_form_group').removeClass('d-none')
            $('.medicacion_form_group').addClass('d-block')
        } else {
            $('.medicacion_form_group').removeClass('d-block')
            $('.medicacion_form_group').addClass('d-none')
        }

        $('#field-id_medicacion').change(function() {
            $('.medicacion_form_group').removeClass('d-block')
            $('.medicacion_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.medicacion_form_group').addClass('d-none')
            } else {
                $('.medicacion_form_group').removeClass('d-block')
            }
        })
        if ($('#field-id_nadar').val() == 1) {
            $('.nadar_form_group').removeClass('d-none')
            $('.nadar_form_group').addClass('d-block')
        } else {
            $('.nadar_form_group').removeClass('d-block')
            $('.nadar_form_group').addClass('d-none')
        }

        $('#field-id_nadar').change(function() {
            $('.nadar_form_group').removeClass('d-block')
            $('.nadar_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.nadar_form_group').addClass('d-none')
            } else {
                $('.nadar_form_group').removeClass('d-block')
            }
        })
        if ($('#field-id_nee').val() == 1) {
            $('.nee_form_group').removeClass('d-none')
            $('.nee_form_group').addClass('d-block')
        } else {
            $('.nee_form_group').removeClass('d-block')
            $('.nee_form_group').addClass('d-none')
        }

        $('#field-id_nee').change(function() {
            $('.nee_form_group').removeClass('d-block')
            $('.nee_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.nee_form_group').addClass('d-none')
            } else {
                $('.nee_form_group').removeClass('d-block')
            }
        })


        if ($('#field-id_presenta_otras').val() == 1) {
            $('.presenta_otras_form_group').removeClass('d-none')
            $('.presenta_otras_form_group').addClass('d-block')
        } else {
            $('.presenta_otras_form_group').removeClass('d-block')
            $('.presenta_otras_form_group').addClass('d-none')
        }

        $('#field-id_presenta_otras').change(function() {
            $('.presenta_otras_form_group').removeClass('d-block')
            $('.presenta_otras_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.presenta_otras_form_group').addClass('d-none')
            } else {
                $('.presenta_otras_form_group').removeClass('d-block')
            }
        })

        //comprueba si se ha añadido ventana modal
        // $('#field-dni_tutor').blur(function(){
        //     alert('blur')
        $('.add-edit-modal').on('shown.bs.modal', function() {
            // alert('blur editar')
            if ($('.card-header').text().includes('Editar')) {

                // alert('blur editar')
            }

        })
        // })

        // console.log('#field-id_actividad '+$('#field-id_actividad').val())

        function marcarError(campo) {
            if ($('#field-id_' + campo).val() == 1 && $('input#field-' + campo).val() == 0) {
                $('input#field-' + campo).css('border-bottom', '3px solid red')
            }
        }

        function marcarErrorCampoObligatorio(campo) {
            if ($('input#field-' + campo).val() == 0) {
                $('input#field-' + campo).css('border-bottom', '3px solid red')
            }
        }

        function marcarErrorNoValidado(campo) {
            $('input#field-' + campo).css('border-bottom', '3px solid red')
        }

        function marcarErrorSiNo(campo) {
            $('div#field_' + campo + '_chosen').children('a').css('border', '3px solid red')
        }




        $('#save-and-go-back-button, #form-button-save').click(function(e) {
            // alert('click save and go ...')
            // alert('id_actividad: '+$('#field-id_actividad').val())
            // comprobarActividad()

            // var precio = $('#field-precio').val()
            // precio = precio.replace(",", ".")
            // $('#field-precio').val(precio)

            // comprobarActividad()


            //eliminamos errores marcados
            $('input[id^=field]').each(function(index, value) {
                $(this).css('border-bottom', '1px solid #ced4da')
            });
            $('div[id^=field_]').each(function(index, value) {
                $(this).children('a').css('border', '1px solid #ced4da')
            });

            var camposObligatorios = [
                'dni_tutor',
                'nombre_tutor',
                'apellido1_tutor',
                'apellido2_tutor',
                'direccion_tutor',
                'provincia_tutor',
                'poblacion_tutor',
                'codigo_postal_tutor',
                'telefono1_tutor',
                'dni_alumno',
                'nombre_alumno',
                'apellido1_alumno',
                'apellido2_alumno',
                'direccion_alumno',
                'provincia_alumno',
                'poblacion_alumno',
                'codigo_postal_alumno',
                'fecha_nacimiento'

            ]
            var camposAdicionales = ['hermanos_actividad', 'hermano_num', 'respiratoria', 'asistencia_atencion',  'alergia', 'alergia_medicacion', 'insuficiencia', 'insuficiencia_medicacion', 'vascular', 'cronica', 'hemorragia', 'medicacion', 'nadar', 'nee']

            $.each(camposObligatorios, function(i, v) {
                marcarErrorCampoObligatorio(v)
            })
            $.each(camposAdicionales, function(i, v) {
                marcarError(v)
            })

            //verifica se se ha añadido errores de validaciones de grocery
            $("#report-error").bind("DOMSubtreeModified", function() {
                $($(this).children('p')).each(function(index, value) {

                    if ($(this).html().includes("una activitat")) {
                        marcarErrorSiNo('id_actividad')
                        return
                    }
                    if ($(this).html().includes("parentiu tutor")) {
                        marcarErrorNoValidado('parentesco_tutor')
                        return
                    }
                    if ($(this).html().includes("un període")) {
                        marcarErrorSiNo('id_trimestre')
                        return
                    }
                    if ($(this).html().includes("Presenta DNI tutor")) {
                        marcarErrorSiNo('id_presenta_dni_tutor')
                        return
                    }
                    if ($(this).html().includes("Presenta targeta sanitària")) {
                        marcarErrorSiNo('id_presenta_tarjeta_sanitaria')
                        return
                    }
                    if ($(this).html().includes("Presenta DNI infant")) {
                        marcarErrorSiNo('id_presenta_dni_alumni')
                        return
                    }
                    if ($(this).html().includes("Presenta llibre vacunes")) {
                        marcarErrorSiNo('id_presenta_libro_vacunas')
                        return
                    }
                    if ($(this).html().includes("Presenta altres documentacions")) {
                        marcarErrorSiNo('id_presenta_otras')
                        return
                    }
                    if ($(this).html().includes("Rebre Comunicacions Casal")) {
                        marcarErrorSiNo('id_comunicaciones')
                        return
                    }
                    if ($(this).html().includes("Altres Comunicacions Casal")) {
                        marcarErrorSiNo('id_otras_comunicaciones')
                        return
                    }
                    if ($(this).html().includes("Compromís acompanyar")) {
                        marcarErrorSiNo('id_aut_acompanar')
                        return
                    }
                    if ($(this).html().includes("Autorització recollida")) {
                        marcarErrorSiNo('id_aut_recogida')
                        return
                    }
                    if ($(this).html().includes("Autoritzo a marxar sol del casal")) {
                        marcarErrorSiNo('id_aut_ir_solo')
                        return
                    }
                    if ($(this).html().includes("Autoritzar decisions urgents")) {
                        marcarErrorSiNo('id_decisiones_urgentes')
                        return
                    }
                    if ($(this).html().includes("Autoritzar decisions medicas")) {
                        marcarErrorSiNo('id_decisiones_urgentes_2')
                        return
                    }
                    if ($(this).html().includes("Autoritzar imatge en activitats")) {
                        marcarErrorSiNo('id_imagen_en_actividades')
                        return
                    }
                    if ($(this).html().includes("Autoritzar divulgació imatges")) {
                        marcarErrorSiNo('id_imagen_divulgacion')
                        return
                    }
                    if ($(this).html().includes("Informació bàsica")) {
                        marcarErrorSiNo('id_lectura_informacion')
                        return
                    }

                    if ($(this).html().includes("DNI tutor")) {
                        marcarErrorNoValidado('dni_tutor')
                        return
                    }
                    if ($(this).html().includes("DNI infant")) {
                        marcarErrorNoValidado('dni_alumno')
                        return
                    }
                    if ($(this).html().includes("Código Postal tutor")) {
                        marcarErrorNoValidado('codigo_postal_tutor')
                        return
                    }
                    if ($(this).html().includes("Código Postal infant")) {
                        marcarErrorNoValidado('codigo_postal_alumno')
                        return
                    }
                    if ($(this).html().includes("Data naixement")) {
                        marcarErrorNoValidado('fecha_nacimiento')
                        return
                    }
                    if ($(this).html().includes("email tutor")) {
                        marcarErrorNoValidado('email_tutor')
                        return
                    }
                    if ($(this).html().includes("DNI autorització")) {
                        marcarErrorNoValidado('aut_dni')
                        return
                    }
                    if ($(this).html().includes("Activitat germans")) {
                        marcarErrorSiNo('id_hermanos_actividad')
                        return
                    }
                    if ($(this).html().includes("Suport monitora")) {
                        marcarErrorSiNo('id_monitora')
                        return
                    }
                    if ($(this).html().includes("Participació anterior")) {
                        marcarErrorSiNo('id_participacion_anterior')
                        return
                    }
                    if ($(this).html().includes("Servei atenció")) {
                        marcarErrorSiNo('id_asistencia_atencion')
                        return
                    }
                    
                    if ($(this).html().includes("Al.lergia")) {
                        marcarErrorSiNo('id_alergia')
                        return
                    }
                    if ($(this).html().includes("Intol·lerància")) {
                        marcarErrorSiNo('id_insuficiencia')
                        return
                    }
                    if ($(this).html().includes("Respiratoria")) {
                        marcarErrorSiNo('id_respiratoria')
                        return
                    }
                    if ($(this).html().includes("Varcular")) {
                        marcarErrorSiNo('id_vascular')
                        return
                    }
                    if ($(this).html().includes("Cronica")) {
                        marcarErrorSiNo('id_cronica')
                        return
                    }
                    if ($(this).html().includes("Hemorragia")) {
                        marcarErrorSiNo('id_hemorragia')
                        return
                    }

                    if ($(this).html().includes("Medicació al·lèrgia")) {
                        marcarErrorSiNo('id_alergia_administracion_medicacion')
                        return
                    }
                    if ($(this).html().includes("Medicació intol·lerància")) {
                        marcarErrorSiNo('id_insuficiencia_administracion_medicacion')
                        return
                    }
                    if ($(this).html().includes("Medicació")) {
                        marcarErrorSiNo('id_medicacion')
                        return
                    }
                    if ($(this).html().includes("Sap nedar")) {
                        marcarErrorSiNo('id_nadar')
                        return
                    }
                    if ($(this).html().includes("Presenta alguna NEE")) {
                        marcarErrorSiNo('id_nee')
                        return
                    }
                    if ($(this).html().includes("El campo Sexe")) {
                        marcarErrorSiNo('id_sexo')
                        return
                    }
                    if ($(this).html().includes("districte")) {
                        marcarErrorSiNo('id_es_del_districto')
                        return
                    }
                });
            });

            if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_nombre').val() == 0) {
                $('input#field-aut_nombre').css('border-bottom', '3px solid red')
            }
            if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido1').val() == 0) {
                $('input#field-aut_apellido1').css('border-bottom', '3px solid red')
            }
            if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido2').val() == 0) {
                $('input#field-aut_apellido2').css('border-bottom', '3px solid red')
            }
            if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_dni').val() == 0) {
                $('input#field-aut_dni').css('border-bottom', '3px solid red')
            }
            if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_parentesco').val() == 0) {
                $('input#field-aut_parentesco').css('border-bottom', '3px solid red')
            }

            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_nombre_2').val() == 0) {
            //     $('input#field-aut_nombre_2').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido1_2').val() == 0) {
            //     $('input#field-aut_apellido1_2').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido2_2').val() == 0) {
            //     $('input#field-aut_apellido2_2').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_dni_2').val() == 0) {
            //     $('input#field-aut_dni_2').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_parentesco_2').val() == 0) {
            //     $('input#field-aut_parentesco_2').css('border-bottom', '3px solid red')
            // }

            

            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_nombre_3').val() == 0) {
            //     $('input#field-aut_nombre_3').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido1_3').val() == 0) {
            //     $('input#field-aut_apellido1_3').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido2_3').val() == 0) {
            //     $('input#field-aut_apellido2_3').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_dni_3').val() == 0) {
            //     $('input#field-aut_dni_3').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_parentesco_3').val() == 0) {
            //     $('input#field-aut_parentesco_3').css('border-bottom', '3px solid red')
            // }

            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_nombre_4').val() == 0) {
            //     $('input#field-aut_nombre_4').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido1_4').val() == 0) {
            //     $('input#field-aut_apellido1_4').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_apellido2_4').val() == 0) {
            //     $('input#field-aut_apellido2_4').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_dni_4').val() == 0) {
            //     $('input#field-aut_dni_4').css('border-bottom', '3px solid red')
            // }
            // if ($('#field-id_aut_recogida').val() == 1 && $('input#field-aut_parentesco_4').val() == 0) {
            //     $('input#field-aut_parentesco_4').css('border-bottom', '3px solid red')
            // }

        })





        if ($('#field-id_aut_recogida').val() == 1) {
            $('.aut_nombre_form_group').removeClass('d-none')
            $('.aut_nombre_form_group').addClass('d-block')
            $('.aut_apellido1_form_group').removeClass('d-none')
            $('.aut_apellido1_form_group').addClass('d-block')
            $('.aut_apellido2_form_group').removeClass('d-none')
            $('.aut_apellido2_form_group').addClass('d-block')
            $('.aut_dni_form_group').removeClass('d-none')
            $('.aut_dni_form_group').addClass('d-block')
            $('.aut_parentesco_form_group').removeClass('d-none')
            $('.aut_parentesco_form_group').addClass('d-block')

            $('.aut_nombre_2_form_group').removeClass('d-none')
            $('.aut_nombre_2_form_group').addClass('d-block')
            $('.aut_apellido1_2_form_group').removeClass('d-none')
            $('.aut_apellido1_2_form_group').addClass('d-block')
            $('.aut_apellido2_2_form_group').removeClass('d-none')
            $('.aut_apellido2_2_form_group').addClass('d-block')
            $('.aut_dni_2_form_group').removeClass('d-none')
            $('.aut_dni_2_form_group').addClass('d-block')
            $('.aut_parentesco_2_form_group').removeClass('d-none')
            $('.aut_parentesco_2_form_group').addClass('d-block')

            $('.aut_nombre_3_form_group').removeClass('d-none')
            $('.aut_nombre_3_form_group').addClass('d-block')
            $('.aut_apellido1_3_form_group').removeClass('d-none')
            $('.aut_apellido1_3_form_group').addClass('d-block')
            $('.aut_apellido2_3_form_group').removeClass('d-none')
            $('.aut_apellido2_3_form_group').addClass('d-block')
            $('.aut_dni_3_form_group').removeClass('d-none')
            $('.aut_dni_3_form_group').addClass('d-block')
            $('.aut_parentesco_3_form_group').removeClass('d-none')
            $('.aut_parentesco_3_form_group').addClass('d-block')

            $('.aut_nombre_4_form_group').removeClass('d-none')
            $('.aut_nombre_4_form_group').addClass('d-block')
            $('.aut_apellido1_4_form_group').removeClass('d-none')
            $('.aut_apellido1_4_form_group').addClass('d-block')
            $('.aut_apellido2_4_form_group').removeClass('d-none')
            $('.aut_apellido2_4_form_group').addClass('d-block')
            $('.aut_dni_4_form_group').removeClass('d-none')
            $('.aut_dni_4_form_group').addClass('d-block')
            $('.aut_parentesco_4_form_group').removeClass('d-none')
            $('.aut_parentesco_4_form_group').addClass('d-block')

        } else {
            $('.aut_nombre_form_group').removeClass('d-block')
            $('.aut_nombre_form_group').addClass('d-none')
            $('.aut_apellido1_form_group').removeClass('d-block')
            $('.aut_apellido1_form_group').addClass('d-none')
            $('.aut_apellido2_form_group').removeClass('d-block')
            $('.aut_apellido2_form_group').addClass('d-none')
            $('.aut_dni_form_group').removeClass('d-block')
            $('.aut_dni_form_group').addClass('d-none')
            $('.aut_parentesco_form_group').removeClass('d-block')
            $('.aut_parentesco_form_group').addClass('d-none')

            $('.aut_nombre_2_form_group').removeClass('d-block')
            $('.aut_nombre_2_form_group').addClass('d-none')
            $('.aut_apellido1_2_form_group').removeClass('d-block')
            $('.aut_apellido1_2_form_group').addClass('d-none')
            $('.aut_apellido2_2_form_group').removeClass('d-block')
            $('.aut_apellido2_2_form_group').addClass('d-none')
            $('.aut_dni_2_form_group').removeClass('d-block')
            $('.aut_dni_2_form_group').addClass('d-none')
            $('.aut_parentesco_2_form_group').removeClass('d-block')
            $('.aut_parentesco_2_form_group').addClass('d-none')

            $('.aut_nombre_3_form_group').removeClass('d-block')
            $('.aut_nombre_3_form_group').addClass('d-none')
            $('.aut_apellido1_3_form_group').removeClass('d-block')
            $('.aut_apellido1_3_form_group').addClass('d-none')
            $('.aut_apellido2_3_form_group').removeClass('d-block')
            $('.aut_apellido2_3_form_group').addClass('d-none')
            $('.aut_dni_3_form_group').removeClass('d-block')
            $('.aut_dni_3_form_group').addClass('d-none')
            $('.aut_parentesco_3_form_group').removeClass('d-block')
            $('.aut_parentesco_3_form_group').addClass('d-none')

            $('.aut_nombre_4_form_group').removeClass('d-block')
            $('.aut_nombre_4_form_group').addClass('d-none')
            $('.aut_apellido1_4_form_group').removeClass('d-block')
            $('.aut_apellido1_4_form_group').addClass('d-none')
            $('.aut_apellido2_4_form_group').removeClass('d-block')
            $('.aut_apellido2_4_form_group').addClass('d-none')
            $('.aut_dni_4_form_group').removeClass('d-block')
            $('.aut_dni_4_form_group').addClass('d-none')
            $('.aut_parentesco_4_form_group').removeClass('d-block')
            $('.aut_parentesco_4_form_group').addClass('d-none')
        }

        $('#field-id_aut_recogida').change(function() {
            $('.aut_nombre_form_group').removeClass('d-block')
            $('.aut_nombre_form_group').removeClass('d-none')
            $('.aut_apellido1_form_group').removeClass('d-block')
            $('.aut_apellido1_form_group').removeClass('d-none')
            $('.aut_apellido2_form_group').removeClass('d-block')
            $('.aut_apellido2_form_group').removeClass('d-none')
            $('.aut_dni_form_group').removeClass('d-block')
            $('.aut_dni_form_group').removeClass('d-none')
            $('.aut_parentesco_form_group').removeClass('d-block')
            $('.aut_parentesco_form_group').removeClass('d-none')

            $('.aut_nombre_2_form_group').removeClass('d-block')
            $('.aut_nombre_2_form_group').removeClass('d-none')
            $('.aut_apellido1_2_form_group').removeClass('d-block')
            $('.aut_apellido1_2_form_group').removeClass('d-none')
            $('.aut_apellido2_2_form_group').removeClass('d-block')
            $('.aut_apellido2_2_form_group').removeClass('d-none')
            $('.aut_dni_2_form_group').removeClass('d-block')
            $('.aut_dni_2_form_group').removeClass('d-none')
            $('.aut_parentesco_2_form_group').removeClass('d-block')
            $('.aut_parentesco_2_form_group').removeClass('d-none')

            $('.aut_nombre_3_form_group').removeClass('d-block')
            $('.aut_nombre_3_form_group').removeClass('d-none')
            $('.aut_apellido1_3_form_group').removeClass('d-block')
            $('.aut_apellido1_3_form_group').removeClass('d-none')
            $('.aut_apellido2_3_form_group').removeClass('d-block')
            $('.aut_apellido2_3_form_group').removeClass('d-none')
            $('.aut_dni_3_form_group').removeClass('d-block')
            $('.aut_dni_3_form_group').removeClass('d-none')
            $('.aut_parentesco_3_form_group').removeClass('d-block')
            $('.aut_parentesco_3_form_group').removeClass('d-none')

            $('.aut_nombre_4_form_group').removeClass('d-block')
            $('.aut_nombre_4_form_group').removeClass('d-none')
            $('.aut_apellido1_4_form_group').removeClass('d-block')
            $('.aut_apellido1_4_form_group').removeClass('d-none')
            $('.aut_apellido2_4_form_group').removeClass('d-block')
            $('.aut_apellido2_4_form_group').removeClass('d-none')
            $('.aut_dni_4_form_group').removeClass('d-block')
            $('.aut_dni_4_form_group').removeClass('d-none')
            $('.aut_parentesco_4_form_group').removeClass('d-block')
            $('.aut_parentesco_4_form_group').removeClass('d-none')

            if ($(this).val() != 1) {
                $('.aut_nombre_form_group').addClass('d-none')
                $('.aut_apellido1_form_group').addClass('d-none')
                $('.aut_apellido2_form_group').addClass('d-none')
                $('.aut_dni_form_group').addClass('d-none')
                $('.aut_parentesco_form_group').addClass('d-none')

                $('.aut_nombre_2_form_group').addClass('d-none')
                $('.aut_apellido1_2_form_group').addClass('d-none')
                $('.aut_apellido2_2_form_group').addClass('d-none')
                $('.aut_dni_2_form_group').addClass('d-none')
                $('.aut_parentesco_2_form_group').addClass('d-none')

                $('.aut_nombre_3_form_group').addClass('d-none')
                $('.aut_apellido1_3_form_group').addClass('d-none')
                $('.aut_apellido2_3_form_group').addClass('d-none')
                $('.aut_dni_3_form_group').addClass('d-none')
                $('.aut_parentesco_3_form_group').addClass('d-none')

                $('.aut_nombre_4_form_group').addClass('d-none')
                $('.aut_apellido1_4_form_group').addClass('d-none')
                $('.aut_apellido2_4_form_group').addClass('d-none')
                $('.aut_dni_4_form_group').addClass('d-none')
                $('.aut_parentesco_4_form_group').addClass('d-none')
            } else {
                $('.aut_nombre_form_group').removeClass('d-block')
                $('.aut_apellido1_form_group').removeClass('d-block')
                $('.aut_apellido2_form_group').removeClass('d-block')
                $('.aut_dni_form_group').removeClass('d-block')
                $('.aut_parentesci_form_group').removeClass('d-block')

                $('.aut_nombre_2_form_group').removeClass('d-block')
                $('.aut_apellido1_2_form_group').removeClass('d-block')
                $('.aut_apellido2_2_form_group').removeClass('d-block')
                $('.aut_dni_2_form_group').removeClass('d-block')
                $('.aut_parentesci_2_form_group').removeClass('d-block')

                $('.aut_nombre_3_form_group').removeClass('d-block')
                $('.aut_apellido1_3_form_group').removeClass('d-block')
                $('.aut_apellido2_3_form_group').removeClass('d-block')
                $('.aut_dni_3_form_group').removeClass('d-block')
                $('.aut_parentesci_3_form_group').removeClass('d-block')

                $('.aut_nombre_4_form_group').removeClass('d-block')
                $('.aut_apellido1_4_form_group').removeClass('d-block')
                $('.aut_apellido2_4_form_group').removeClass('d-block')
                $('.aut_dni_4_form_group').removeClass('d-block')
                $('.aut_parentesci_4_form_group').removeClass('d-block')
            }
        })



        
        
        <?php if($this->session->categoria==100 ){ ?>
            $('#field-dni_tutor').addClass('disabled')
            $('#field-dni_tutor').parent().children().addClass('disabled')
            $('#field-dni_tutor').css('border-bottom','0px solid white')

            // console.log('soy 100')
       <?php } ?>





        $("#field-num_usuario").addClass('col-2')

        //    $("#field-nombre_tutor").addClass('col-2')
        //    $("#field-apellido1_tutor").addClass('col-2')

        //    $(".crud-form >div >div >div").css("background-color","blue")
        $(".crud-form >div >div >div").removeClass()
        $(".crud-form >div >div >div").addClass("col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-10 offset-lg-1 col-xl-10 offset-xl-1")
    })
</script>


<body>
    <!--Main Navigation-->
    <header>

        <!--Navbar-->


        <!--Navbar-->

        <!-- Intro Section -->
        <div style="background-image: url(https://mdbootstrap.com/img/Photos/Others/images/76.jpg);">
            <div class="container-fluid" style="min-height:1000px">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="intro-info-content">
                            <?php echo $output; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </header>
    <!--Main Navigation-->
</body>

</html>