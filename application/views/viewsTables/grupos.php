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
<link href="<?php echo base_url() ?>css/cssTables/usuarios_.css" rel="stylesheet">

<script src="<?php echo base_url() ?>js/tablasGrocery.js" ?>>
</script>

<style>
    .texto_grupo_form_group > label{
        margin-top:-12px;
    }
    .texto_grupo_form_group > label.active{
        margin-top: 12px;
    }
    .texto_grupo_form_group>label.active+input#field-texto_grupo {
        padding-top:12px; 
        padding-bottom:0px;
    }

</style>


</head>

<script>
    $(document).ready(function() {
        $('#field-num_grupo, #field-num_grupo > label').addClass("disabled");
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