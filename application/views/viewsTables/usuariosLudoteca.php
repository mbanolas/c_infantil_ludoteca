<?php
// mensaje('$ultimoCurso desde página '.$data['ultimoCurso']);
// echo $data['ultimoCurso'];
foreach ($css_files as $k => $file) : ?>
    <link type="text/css" <?php echo $k; ?> rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach ($js_files as $k => $file) : ?>
    <script <?php echo $k; ?> src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<!-- css especifico para la tabla c_usuarios_ludoteca -->
<!-- <link href="<?php echo base_url() ?>css/usuariosEdit.css" rel="stylesheet" id="usuariosEdit"> --> -->
<link href="<?php echo base_url() ?>css/tablasGrocery.css" rel="stylesheet" id="tablasGrocery">
<link href="<?php echo base_url() ?>css/cssTables/usuarios.css" rel="stylesheet">

</head>


<!-- <script src="<?php echo base_url() ?>js/tablasGrocery2.js" ?>></script> -->
<script src="<?php echo base_url() ?>js/tablasGrocery.js" ?>></script>
<script src="<?php echo base_url() ?>js/maba.js"></script>

<script>
    $(document).ready(function() {

    var ejecutarAjax=false

    // se ha eliminado el datapicker en grocery crud mdb porque no funciona
    // ver assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js    
    $('a.datepicker-input-clear').remove()
    var nodes=$(".becas_desde_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            if(i==5) $(this).remove()
        })
    }
    nodes=$(".becas_hasta_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            if(i==5) $(this).remove()
        })
    } 
    nodes=$(".monitora_desde_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            if(i==5) $(this).remove()
        })
    }  
    nodes=$(".monitora_hasta_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            if(i==5) $(this).remove()
        })
    }
    nodes=$(".fecha_nacimiento_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            console.log(i)
            console.log(e)
            if(i==5) $(this).remove()
        })
    }     




        if(!$('#field-id_actividad').val()){
            $('#save-and-go-back-button').attr('disabled','disabled')
            $('#report-error').css('display','block')
            $('#report-error').html("<p>L'activitat no és correcta</p>")
        }else{
            $('#save-and-go-back-button').removeAttr('disabled')
            $('#report-error').css('display','none')
            $('#report-error').html('')
        }


        $('button.dropdown-toggle').next('div').each(function(){  
            var href= $(this).children('a.dropdown-item').attr('href') 
            var href2= $(this).children('a.dropdown-item').next().attr('href') 
            var href3= $(this).children('a.dropdown-item').next().next().attr('data-target') 
            // alert(href) 
            // alert(href2) 
            // alert(href3)  
            $(this).parent().parent().append('<a class="delete-row btn btn-danger btn-sm waves-effect waves-light" data-target="'+href3+'" href="javascript:void(0)" title="Esborrar"><i class="fa fa-trash-o"></i></a>')  
            $(this).parent().parent().append('<a class="btn default-color-ficha btn-sm edit-button waves-effect waves-light" href="'+href+'">Fitxa</a>')  
            $(this).parent().parent().append('<a class="btn default-color-ficha btn-sm edit-button waves-effect waves-light" href="'+href2+'">Pagament</a>')  
        })
        $('button.dropdown-toggle').parent().addClass('d-none')

    //proceso borrado 
    var numUsuario=0
    $(document).on('click','a.delete-row', function(e){
        // alert('a.delete-row click')
    var stringDato=$(this).attr('data-target')   
    // alert('stringDato '+stringDato)
    var splittedDato= stringDato.split("/")
    numUsuario=splittedDato[splittedDato.length-1]
    // alert('numUsuario '+numUsuario)
    if(ejecutarAjax){
    $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + "index.php/usuarios/getDatosActividad/" + numUsuario,
            data: "",
            success: function(datos) {
                 console.log(datos)
                var datos = $.parseJSON(datos)
                console.log(datos)
                console.log("datos['numInscipciones'] "+datos)
                if(datos>0){
                     //no se puede eliminar
                    $('#modalInfoLabel').text("Esborrar Usuari/Usuària")
                    $('.modal-body').html("Este usuario no se puede borrar porque tiene "+datos+" recibos pagados o devueltos")
                    $('#modalInfo').modal('show')
                }else{
                    $('#modalSiNoLabel').text("Esborrar Usuari/Usuària")
                    $('.modal-body').html("Segur que vols esborrar aquesta activitat?")
                    $('#modalSiNo').modal('show')
                }

            },
            error: function() {
                alert('Error en getDatosActividad. Informar administrador')
            }
        })
    }
    });


        //preguntar si se puede eliminar
        $(document).on('click','button.delete-confirmation-button', function(e){
    // alert('clickad esborrar '+numUsuario)
    if(ejecutarAjax){
    $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + "index.php/usuarios/eliminarUsuario/" + numUsuario,
            data: "",
            success: function(datos) {
                console.log(datos)
                window.location.replace("<?php echo base_url() ?>index.php/usuariosLudoteca2/usuarios");
            },
            error: function() {
                alert('Error en eliminarUsuario. Informar administrador')
            }

            })
    }
})  
        
        $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child( 8)').css('width', '150px')
        $('#gcrud-search-form > table > tbody > tr > td:nth-child(8)').css('width', '100px')

        //establecer width columna acciones
        $('#gcrud-search-form > table > tbody > tr > td:nth-child(11) > div.d-none.d-lg-block.d-xl-block.d-md-block > div').css('width', '200px')

        var usuario = $('#field-num_usuario').val()
        if(ejecutarAjax){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + "index.php/usuarios/comprobarPagado/" + usuario,
            data: "",
            success: function(datos) {
                var datos = $.parseJSON(datos)
                if (datos == 1) {
                    // alert('si ya pagado')  
                    $('select[name="id_actividad"]').attr('disabled', 'disabled')
                }
            },
            error: function() {
                alert('Error en comprobarPagado. Informar administrador')
            }
            })
        }   

        //comprueba si la actividad es OK y si sí poner precio
        function comprobarActividad() {
            var actividad = $('#field-id_actividad').val()
            // alert('num_ludoteca '+actividad);
        
            if (actividad) {
                // if(ejecutarAjax){
                if(true){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + "index.php/ludotecas/comprobarInscripcionLudoteca",
                    data: {actividad:actividad},
                    success: function(datos) {
                        // alert('success '+datos)
                        var datos = $.parseJSON(datos)
                        if (!datos) {
                            calcularPrecio()
                            $('#save-and-go-back-button').removeAttr('disabled')
                            $('#report-error').css('display','none')
                            $('#report-error').html('')

                            $('#modalInfoLabel').text("Informació")
                            $('.modal-body').html("Preu recalculat")
                            $('#modalInfo').modal('show')
                            return true;
                        }
                        $('#modalInfoLabel').text("Informació")
                        $('.modal-body').html(datos)
                        $('#modalInfo').modal('show')
                        $('#save-and-go-back-button').attr('disabled','disabled')
                        $('#report-error').css('display','block')
                        $('#report-error').html("<p>L'activitat no és correcta</p>")
                        return false;
                    },
                    error: function() {
                        alert('Error en comprobarActividad. Informar administrador')
                    }
                })
                }
            }
        }

        function yearsOld(fechaNacimiento){
            if(!fechaNacimiento) return -1;
            var fechaNacimiento = new Date(fechaNacimiento);
            var today = new Date();
            var age = Math.floor((today-fechaNacimiento) / (365.25 * 24 * 60 * 60 * 1000));
            return age;
        }

        var precio
        //function para calcularPrecio
        function calcularPrecio() {
            precio = $('#field-precio').val()
            var fechaNacimiento=getFechaAnoMesDia($('#field-fecha_nacimiento').val())
            // alert(fechaNacimiento)


            var edad=yearsOld(fechaNacimiento)
            // console.log('edad '+edad)
            if(edad==-1){
                return
            }
            // si es menor de 3 años, se debe apuntar a todo el curso
            if(edad>=0 && edad<=3) { 
                $('#field-id_trimestre > option').removeAttr('selected') 
                $('#field-id_trimestre').val(1)
                $('#field_id_trimestre_chosen >a>span').text('Tot el curs')
            }
            
            var actividad = $('#field-id_actividad').val()
            var trimestre = $('#field-id_trimestre').val()
            var hermanosActividad = $('#field-hermanos_actividad').val()
            var hermanosNum = $('#field-hermano_num').val()

            // console.log('actividad ' + actividad)
            if (!trimestre) trimestre = 1
            if (!hermanosActividad) hermanosActividad = 0
            if (!hermanosNum) hermanosNum = 0
            // console.log('trimestre ' + trimestre)
            // console.log('hermanosActividad ' + hermanosActividad)
            // console.log('hermanosNum ' + hermanosNum)
            // if(ejecutarAjax){
            if(true){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/ludotecas/calcularPrecio",
                data: {
                    actividad: actividad,
                    trimestre: trimestre,
                    hermanosActividad: hermanosActividad,
                    hermanosNum: hermanosNum,
                    edad:edad
                },
                success: function(datos) {
                    // alert('success datos')
                    var datos = $.parseJSON(datos)
                    // alert('success datos'+datos)
                    $('.precio_form_group label').addClass('active')
                    $('#field-precio').val(datos)
                    return datos
                },
                error: function() {
                    alert('Error en calculoPrecio. Informar administrador')
                }
            })
        }
        return precio
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
            comprobarActividad()
        })
        $('#field-id_actividad').change(function() {
            comprobarActividad()
        })

        $('#field-id_trimestre').change(function() {
            comprobarActividad()
        })
        $('#field-hermanos_actividad').change(function() {
            // comprobarActividad()
        })
        $('#field-hermano_num').change(function() {
            if($(this).val()!=0)
                comprobarActividad()
        })


        $('#form-button-save').click(function(e) {
            return;
            e.preventDefault()
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
                if(efecularAjax){
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
            }
            }
        })

        //cuando se ha introducido el dni_alumno y si ya existe y es añadir copia valoes del tutor
        $('#field-dni_alumno').blur(function() {
            var dni_alumno = $(this).val().trim()
            if (dni_alumno == "") dni_alumno = "1"

            if ($('#crudForm > div > div.card-header.red.white-text').text().includes('Afegir')) {
                //ver si existe en la BD este alumno
                if(ejecutarAjax){
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
            }
            }
        })

        //click para ocultar mensaje de error
        if ($('#report-error').length) {
            if($('#report-error >p').html()!="L'activitat no és correcta")
            $('#report-error').click(function() {
                $(this).css('display', 'none')
            })
        }


        $("<p class='subtitulo subtitulo1'><strong>DADES PERSONALS RESPONSABLE</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo2'><strong>DADES PERSONALS INFANT/ JOVE</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo3'><strong>GRUP ON REALITZA LA INSCRIPCIÓ</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo4'><strong>MÉS DADES</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo5'><strong>FITXA DE SALUT</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo6'><strong>DOCUMENTACIÓ A ADJUNTAR</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo6'><strong>DOCUMENTACIÓ A ADJUNTAR</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo7'><strong>COMUNICACIONS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo8'><strong>AUTORITZACIONS ENTRADES I SORTIDES</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo9'><strong>AUTORITZACIONS LEGALS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");
        $("<p class='subtitulo subtitulo10'><strong>SIGNATURA PARE/ AMRE/ TUTOR/A</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_tutor_form_group");

        /*control tamaño pantalla*/
        var texto = $('#crudForm > div > div.card-header.red.white-text').text()
        $('#crudForm > div > div.card-header.red.white-text').text(texto)

        //num_usuario disabled y quita linea
        $('#field-num_usuario').addClass('disabled')
        $('#field-num_usuario').css('border-bottom', '0px')


        //inicializar mostrar .becas_desde_form_group
        if ($('#field-id_becas').val() == 1) {
            $('.becas_desde_form_group').removeClass('d-none')
            $('.becas_desde_form_group').addClass('d-block')
            $('.becas_hasta_form_group').removeClass('d-none')
            $('.becas_hasta_form_group').addClass('d-block')
        } else {
            $('.becas_desde_form_group').removeClass('d-block')
            $('.becas_desde_form_group').addClass('d-none')
            $('.becas_hasta_form_group').removeClass('d-block')
            $('.becas_hasta_form_group').addClass('d-none')
        }

        $('#field-id_becas').change(function() {
            console.log('#field-id_becas')
            $('.becas_desde_form_group').removeClass('d-block')
            $('.becas_desde_form_group').removeClass('d-none')
            $('.becas_hasta_form_group').removeClass('d-block')
            $('.becas_hasta_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.becas_desde_form_group').addClass('d-none')
                $('.becas_hasta_form_group').addClass('d-none')
            } else {
                $('.becas_desde_form_group').removeClass('d-block')
                $('.becas_hasta_form_group').removeClass('d-block')
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
        if ($('#field-id_derivado').val() == 1) {
            $('.derivado_form_group').removeClass('d-none')
            $('.derivado_form_group').addClass('d-block')
        } else {
            $('.derivado_form_group').removeClass('d-block')
            $('.derivado_form_group').addClass('d-none')
        }

        $('#field-id_derivado').change(function() {
            $('.derivado_form_group').removeClass('d-block')
            $('.derivado_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.derivado_form_group').addClass('d-none')
            } else {
                $('.derivado_form_group').removeClass('d-block')
            }
        })
        if ($('#field-id_alergia').val() == 1) {
            $('.alergia_form_group').removeClass('d-none')
            $('.alergia_form_group').addClass('d-block')
        } else {
            $('.alergia_form_group').removeClass('d-block')
            $('.alergia_form_group').addClass('d-none')
        }

        $('#field-id_alergia').change(function() {
            $('.alergia_form_group').removeClass('d-block')
            $('.alergia_form_group').removeClass('d-none')
            if ($(this).val() != 1) {
                $('.alergia_form_group').addClass('d-none')
            } else {
                $('.alergia_form_group').removeClass('d-block')
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
         $('.add-edit-modal').on('shown.bs.modal', function() {
            // alert('blur editar')
            if ($('.card-header').text().includes('Editar')) {
                // alert('blur editar')
            }
        })
        

        // console.log('#field-id_actividad '+$('#field-id_actividad').val())

        function marcarError(campo) {
            if ($('#field-id_' + campo).val() == 1 && $('input#field-' + campo).val() == 0) {
                $('input#field-' + campo).css('border-bottom', '3px solid red')
            }
        }

        $('#save-and-go-back-button, #form-button-save').click(function(e) {
            // alert('#save-and-go-back-button click')
            return
            // alert('#save-and-go-back-button click2')
            comprobarActividad()
            // alert('#save-and-go-back-button click3')
            var camposAdicionales = ['hermanos_actividad', 'hermano_num', 'respiratoria', 'asistencia_atencion', 'derivado', 'alergia', 'vascular', 'cronica', 'hemorragia', 'medicacion', 'nadar', 'nee']
            $.each(camposAdicionales, function(i, v) {
                marcarError(v)
            })
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
            if ($(this).val() != 1) {
                $('.aut_nombre_form_group').addClass('d-none')
                $('.aut_apellido1_form_group').addClass('d-none')
                $('.aut_apellido2_form_group').addClass('d-none')
                $('.aut_dni_form_group').addClass('d-none')
                $('.aut_parentesco_form_group').addClass('d-none')
            } else {
                $('.aut_nombre_form_group').removeClass('d-block')
                $('.aut_apellido1_form_group').removeClass('d-block')
                $('.aut_apellido2_form_group').removeClass('d-block')
                $('.aut_dni_form_group').removeClass('d-block')
                $('.aut_parentesci_form_group').removeClass('d-block')
            }
        })


        $("#field-num_usuario").addClass('col-2')
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