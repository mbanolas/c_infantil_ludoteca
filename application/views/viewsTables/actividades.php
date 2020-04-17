<?php
foreach ($css_files as $k => $file) : ?>
    <link type="text/css" <?php echo $k; ?> rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach ($js_files as $k => $file) : ?>
    <script <?php echo $k; ?> src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<!-- css especifico para la tabla c_usuarios -->
<!-- <link href="<?php echo base_url() ?>css/usuariosEdit.css" rel="stylesheet" id="usuariosEdit"> --> -->
<link href="<?php echo base_url() ?>css/tablasGrocery.css" rel="stylesheet" id="tablasGrocery">
<link href="<?php echo base_url() ?>css/cssTables/actividades.css" rel="stylesheet">

<style>






</style>
</head>

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
<!-- <script src="<?php echo base_url() ?>js/tablasGrocery2.js" ?>></script> -->
<script src="<?php echo base_url() ?>js/tablasGrocery.js" ?></script>
<script>
    $(document).ready(function() {


        

        // #field_id_trimestres_chosen > ul
        // $("<li class='search-choice'><span>Gener</span><a class='search-choice-close' data-option-array-index='0'></a></li>").insertBefore('#field_id_trimestres_chosen > ul > li.search-field');
        // $('#field-id_trimestres > option:nth-child(4)').attr('selected','selected')
        console.log($('#field-id_trimestres').children(4).html())
        $('#field_id_trimestres_chosen > div > ul > li:nth-child(5)').click();


        // $('#field_id_curso_chosen').removeAttr('style')
        // $( '<div class="md-form" ><label>HA PARTICIPAT ANTERIORMENT DE L´ACTIVITAT?</label></div>' ).insertBefore( '#field_id_curso_chosen' );
        $('#field-num_actividad').addClass('disabled')
        $('#field-num_actividad').css('border-bottom', '0px')


        //proceso borrado 
        var numActividad = 0
        $(document).on('click', 'a.delete-row', function(e) {

            var stringDato = $(this).attr('data-target')
            // alert('stringDato '+stringDato)
            var splittedDato = stringDato.split("/")
            // alert('stringDato '+stringDato)
            numActividad = splittedDato[splittedDato.length - 1]
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/actividades/getDatosActividad/" + numActividad,
                data: "",
                success: function(datos) {
                    // console.log(datos)
                    var datos = $.parseJSON(datos)
                    // console.log('-----------------------------')
                    // console.log(datos['inscripciones'])
                    $('.delete-confirmation-button').removeClass('d-none')
                    $('.delete-confirmation > div >div >div.modal-body >p').html('Segur que vols esborrar aquesta activitat?')

                    if (datos['inscripciones'] > 0) {
                        $('.delete-confirmation-button').addClass('d-none')
                        $('.delete-confirmation > div >div >div.modal-body >p').html('Aquesta activitat no es pot esborrar perquè té ' + datos['inscripciones'] + ' inscripcions')
                    } else {}
                },
                error: function() {
                    alert('Error en getDatosActividad. Informar administrador')
                }
            })
        });

        $(document).on('click', 'button.delete-confirmation-button', function(e) {
            // alert('clickad esborrar '+numActividad)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/actividades/eliminarActividad/" + numActividad,
                data: "",
                success: function(datos) {
                    //  console.log(datos)
                    // var datos = $.parseJSON(datos)
                    //  console.log('-----------------------------')
                    //  console.log(datos['salida'])
                },
                error: function() {
                    alert('Error en eliminarActividad. Informar administrador')
                }

            })
        })

        $('#save-and-go-back-button, #form-button-save').click(function(e) {
            // sustituye , por . en cantidades
            var precio = $('#field-precio_general_anual').val()
            precio = precio.replace(",", ".")
            $('#field-precio_general_anual').val(precio)

            var precio = $('#field-precio_general_trimestre').val()
            precio = precio.replace(",", ".")
            $('#field-precio_general_trimestre').val(precio)

            var precio = $('#field-precio_general_mes').val()
            precio = precio.replace(",", ".")
            $('#field-precio_general_mes').val(precio)

        })


    })
</script>

</html>