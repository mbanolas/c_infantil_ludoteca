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
<link href="<?php echo base_url() ?>css/cssTables/ludotecas.css" rel="stylesheet">

</head>


<!-- <script src="<?php echo base_url() ?>js/tablasGrocery2.js" ?>></script> -->
<script src="<?php echo base_url() ?>js/tablasGrocery.js" ></script>
<script src="<?php echo base_url() ?>js/maba.js"></script>

<script>
    $(document).ready(function() {

     // al cambiar id_precio_global, se ajustan los valores de precios
     $('#field-id_pago_global').change(function(){
         var valor=$(this).val()
         if(!valor) return
         // si se selecciona Sí, los precios anual, trimestre se ponen a 0
         if(valor==1){
            $('.precio_general_anual_form_group > label').addClass('active') 
            $('#field-precio_general_anual').val(0)
            $('.precio_infancia_anual_form_group > label').addClass('active') 
            $('#field-precio_infancia_anual').val(0)
            $('.precio_general_trimestre_form_group > label').addClass('active') 
            $('#field-precio_general_trimestre').val(0)
            $('.precio_form_group > label').removeClass('active') 
            $('#field-precio').val("")
        }
        if(valor==2){
            $('.precio_form_group > label').addClass('active') 
            $('#field-precio').val(0)
            $('.precio_general_anual_form_group > label').removeClass('active') 
            $('#field-precio_general_anual').val("")
            $('.precio_infancia_anual_form_group > label').removeClass('active') 
            $('#field-precio_infancia_anual').val("")
            $('.precio_general_trimestre_form_group > label').removeClass('active') 
            $('#field-precio_general_trimestre').val("")
        }
         console.log('#field-id_pago_global'+valor)
     })   


    // se ha eliminado el datapicker en grocery crud mdb porque no funciona
    // ver assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js    
    $('a.datepicker-input-clear').remove()
    var nodes=$(".fecha_desde_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            if(i==5) $(this).remove()
        })
    }
    nodes=$(".fecha_hasta_form_group")[0];
    if(nodes!=null) {
        nodes=nodes.childNodes;
        $.each(nodes, function(i,e){
            if(i==5) $(this).remove()
        })
    }
    


        //click para ocultar mensaje de error
        if ($('#report-error').length) {
            $('#report-error').click(function() {
                $(this).css('display', 'none')
            })
        }

        //pone cursor en dni_contratante
        if ($('#crudForm > div > div.card-header.red.white-text').text().includes('Afegir')) {
            $('#field-dni_contratante').val(" ");
            $('#field-dni_contratante').focus();
        }

        $('#field-num_usuario').addClass('disabled')
        $('#field-num_ludoteca').css('border-bottom','0px')

        $("#field-num_ludoteca").addClass('col-2')

        $('#field-id_curso').attr('disabled','disabled')
        $('#field-id_curso').css('border-bottom','0px')

        // pone botones en linea en lugar de dropdown
        $('button.dropdown-toggle').next('div').each(function(){  
            var href= $(this).children('a.dropdown-item').attr('href') 
            var href2= $(this).children('a.dropdown-item').next().attr('href') 
            var href3= $(this).children('a.dropdown-item').next().next().attr('data-target') 
            // alert(href) 
            // alert(href2) 
            // alert(href3)             
            $(this).parent().parent().append('<a class="delete-row btn btn-danger btn-sm waves-effect waves-light" data-target="'+href3+'" href="javascript:void(0)" title="Esborrar"><i class="fa fa-trash-o"></i></a>')  
            $(this).parent().parent().append('<a class="btn default-color-ficha btn-sm edit-button waves-effect waves-light" href="'+href+'">Fitxa</a>')  
            $(this).parent().parent().append('<a class="btn default-color-ficha btn-sm edit-button waves-effect waves-light" href="'+href2+'">Contratació</a>')  
        })
        $('button.dropdown-toggle').parent().addClass('d-none')



        $("<p class='subtitulo subtitulo0'><strong>LUDOTECA</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_ludoteca_form_group");
        $("<p class='subtitulo subtitulo1'><strong>DADES CONTRATADOR</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_ludoteca_form_group");
        $("<p class='subtitulo subtitulo2'><strong>COMUNICACIONS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_ludoteca_form_group");
        $("<p class='subtitulo subtitulo3'><strong>AUTORITZACIONS LEGALS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_ludoteca_form_group");
        $("<p class='subtitulo subtitulo4'><strong>PREUS I CONDICIONS</strong></p>").insertBefore("#crudForm > div > div.card-body > div.md-form.nombre_ludoteca_form_group");
        
        // $('<!-- Material unchecked --><div class="form-check form-control dias_semana dl"><input type="checkbox" class="form-check-input" name="dl" id="dll" checked><label class="form-check-label" for="materialUnchecked">Dl</label></div>').insertBefore("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
        // $('<!-- Default unchecked --><div class="custom-control custom-checkbox dias_semana dl"><input type="checkbox" class="custom-control-input" id="dl"><label class="custom-control-label" for="defaultUnchecked">Dl</label></div>').insertBefore("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
        // $('<div><input type="checkbox" name="dl" value="1"></div>').insertBefore(".horario_hasta_form_group");
        

         //cuando se ha introducido el dni_contratante y si ya existe y es añadir copia valoes del contractante
         $('#field-dni_contratante').blur(function() {
            var dni_contratante = $(this).val().trim()
            if (dni_contratante == "") dni_contratante = "1"
            if ($('#crudForm > div > div.card-header.red.white-text').text().includes('Afegir')) {
                //ver si existe en la BD este tutor
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + "index.php/ludotecas/getDatosContratante/" + dni_contratante,
                    //data: {dni_contratante:dni_contratante},
                    success: function(datos) {
                        // alert(datos)
                        // alert(datos.length)
                        if (datos.length !== 4) {
                            var datos = $.parseJSON(datos)
                            $('#field-nombre_contratante').val(datos.nombre_contratante)
                            $('#field-nombre_contratante').focus()
                            $('#field-apellido1_contratante').val(datos.apellido1_contratante)
                            $('#field-apellido2_contratante').focus()
                            $('#field-apellido2_contratante').val(datos.apellido2_contratante)
                            $('#field-apellido1_contratante').focus()
                            $('#field-direccion_contratante').val(datos.direccion_contratante)
                            $('#field-direccion_contratante').focus()
                            $('#field-poblacion_contratante').val(datos.poblacion_contratante)
                            $('#field-poblacion_contratante').focus()
                            $('#field-provincia_contratante').val(datos.provincia_contratante)
                            $('#field-provincia_contratante').focus()
                            $('#field-email_contratante').val(datos.email_contratante)
                            $('#field-email_contratante').focus()
                            $('#field-codigo_postal_contratante').val(datos.codigo_postal_contratante)
                            $('#field-codigo_postal_contratante').focus()
                            $('#field-telefono1_contratante').val(datos.telefono1_contratante)
                            $('#field-telefono1_contratante').focus()
                            $('#field-telefono2_contratante').val(datos.telefono2_contratante)
                            $('#field-telefono2_contratante').focus()
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
        })

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

            <!-- Material unchecked -->
        </div>
        

    </header>
    <!--Main Navigation-->
</body>

</html>
