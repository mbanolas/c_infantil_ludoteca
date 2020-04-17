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
<!-- <link href="<?php echo base_url() ?>css/cssTables/usuarios_.css" rel="stylesheet"> -->

<script src="<?php echo base_url() ?>js/tablasGrocery.js" ?>
</script>
<style>
    .texto_curso_form_group > label{
        margin-top:-12px;
    }
    .texto_curso_form_group > label.active{
        margin-top: 12px;
    }
    .texto_curso_form_group>label.active+input#field-texto_curso {
        padding-top:12px; 
        padding-bottom:0px;
    }
    /*num_curso es disabled y se quita linea edicion */
    #field-num_curso{
        border-bottom: 0px;
    }

</style>
</head>

<script>
    $(document).ready(function() {
        
    // num_curso NO es editable    
    $('#field-num_curso, #field-num_curso > label').addClass("disabled");

    //si se muestra la ventana modal modalInfo se anula la modal delete-confirmation
    $("#modalInfo").on("shown.bs.modal", function () {
        $('.modal.delete-confirmation').removeClass('show')
        $('.modal.delete-confirmation').click()
    });
    //si se muestra la ventana modal modalSiNo se anula la modal delete-confirmation
    $("#modalSiNo").on("shown.bs.modal", function () {
        $('.modal.delete-confirmation').removeClass('show')
        $('.modal.delete-confirmation').click()
    });
    //si se muestra la ventana modal modalListaEspera se anula la modal delete-confirmation
    $("#modalListaEspera").on("shown.bs.modal", function () {
        $('.modal.delete-confirmation').removeClass('show')
        $('.modal.delete-confirmation').click()
    });

    //proceso borrado 
    var numCurso=0
    $(document).on('click','a.delete-row', function(e){
        var stringDato=$(this).attr('data-target')   
        var splittedDato= stringDato.split("/")
        numCurso=splittedDato[splittedDato.length-1]
        $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/cursos/getDatosActividad/" + numCurso,
                data: "",
                success: function(datos) {
                    console.log(datos)
                    var datos = $.parseJSON(datos)
                    console.log(datos)
                    if(datos>0){
                        $('#modalInfoLabel').text("Esborrar Curs")
                        $('.modal-body').html("Aquet curs no es pot esborrar perque té "+datos+" activitats")
                        $('#modalInfo').modal('show')
                    }else{
                        $('#modalSiNoLabel').text("Esborrar Curs")
                        $('.modal-body').html("Segur que vols esborrar aquest curs?")
                        $('#modalSiNo').modal('show')
                    }
    
                },
                error: function() {
                    alert('Error en getDatosActividad. Informar administrador')
                }
            })
        });  

        //preguntar si se puede eliminar
        $(document).on('click','button.delete-confirmation-button', function(e){
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + "index.php/cursos/eliminarCurso/" + numCurso,
                    data: "",
                    success: function(datos) {
                        console.log(datos)
                        window.location.replace("<?php echo base_url() ?>index.php/cursos/cursos");
                    },
                    error: function() {
                        alert('Error en eliminarCurso. Informar administrador')
                    }
            })
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

        </div>

    </header>
    <!--Main Navigation-->
</body>


</html>