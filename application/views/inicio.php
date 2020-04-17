<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <title><?php echo $_SERVER['HTTP_HOST'] == 'gestiociludo.com' ? $casal : 'Casals Infantils Local' ?></title> -->
    <title><?php echo $_SERVER['HTTP_HOST'] == 'gestiociludo.com' ? $casal : $casal.' Local' ?></title>
    <!-- favicon -->
    <link rel="icon" href="https://incoop.cat/wp-content/uploads/2018/08/cropped-FAV-ICON-INCOOP-32x32.png" sizes="32x32">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url() ?>css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">
</head>

<style>
    * {
        font-size: 1rem;
    }

    .text-first {
        text-transform: capitalize;
    }

    .form-simple .font-small {
        font-size: 0.8rem;
    }

    .form-simple .header {
        border-top-left-radius: .3rem;
        border-top-right-radius: .3rem;
    }

    .form-simple input[type=text]:focus:not([readonly]) {
        border-bottom: 1px solid #ff3547;
        -webkit-box-shadow: 0 1px 0 0 #ff3547;
        box-shadow: 0 1px 0 0 #ff3547;
    }

    .form-simple input[type=text]:focus:not([readonly])+label {
        color: #4f4f4f;
    }

    .form-simple input[type=password]:focus:not([readonly]) {
        border-bottom: 1px solid #ff3547;
        -webkit-box-shadow: 0 1px 0 0 #ff3547;
        box-shadow: 0 1px 0 0 #ff3547;
    }

    .form-simple input[type=password]:focus:not([readonly])+label {
        color: #4f4f4f;
    }

    .card {
        width: 25%;
        margin: auto;
        margin-top: 3rem;
        min-width: 300px;
    }



    #usuario_form_group {
        margin-top: 2px;
        grid-column: 4 / span 4;
        grid-row: 3/3;
        display: block;
    }

    /* #field-usuario {
    padding-bottom: 20px;
}

label.active{
    margin-top: 10px;
}

#usuario_form_group>label {
    padding-bottom: 22px;
}

/* CON VALOR */
    #usuario_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #usuario_form_group>label.active+input#field-usuario {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #password_form_group {
        margin-top: 2px;
        grid-column: 4 / span 4;
        grid-row: 3/3;
        display: block;
    }

    #field-password {
        padding-bottom: 20px;
    }

    #password_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #password_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #password_form_group>label.active+input#field-password {
        padding-bottom: 0px;
        margin-top: 20px;
    }
    .narrower{
        padding-top:10px;
    }
    
</style>

<body class="hidden-sn mdb-skin">


    <!-- Card Narrower -->
    <div class="card card-cascade narrower">
        <!-- Card image -->
        <div class="view view-cascade overlay w-50 mx-auto">
            <img class="card-img-top .img-fluid " src="<?php echo base_url() ?>img/CI_LOGO.jpg " alt="Card image casal">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!-- Card content -->
        <div class="card-body card-body-cascade">
            <!-- inputs -->
            <div class="md-form input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Usuari/usuària</span>
                </div>
                <input type="text" class="form-control" id="usuario" name="usuario" tabindex="1" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default">
            </div>

            <div class="md-form input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Contrasenya</span>
                </div>
                <input type="password" id="password" name="password" tabindex="2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default">
            </div>

            <div class="text-center mb-4 ">
                <button type="button" tabindex="3" class="text-first entrar btn btn-default btn-block z-depth-2">Entrar</button>
            </div>
            <!-- mensaje error -->
            <div class="text-center mb-4">
                <button type="button" class="resultado btn btn-danger btn-block z-depth-2 invisible"></button>
            </div>
            <!-- leyenda -->
            <div>
                <p class="card-text">Utilitza, preferiblement, el navegador Chrome amb pantalla completa(Windows F11 - Mac ctr+cmd+f)</p>
            </div>
           
        </div>
    </div>
    <!-- Card Narrower -->










</body>

<!-- SCRIPTS -->

<!-- JQuery -->
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url() ?>js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url() ?>js/mdb.js"></script>

<script>
    $(document).ready(function() {


        $('.md-form label').addClass('active')
        $('body').keyup(function(e) {
            e.preventDefault()
            if (e.which == 13) $('button.entrar').click()
        })

        $('button.resultado').click(function(e) {
            $('button.resultado').addClass('invisible')
            $('button.resultado').removeClass('visible')
            $('#usuario').val('')
            $('#password').val('')
            $('.md-form label').addClass('active')
        })

        $('button.entrar').click(function(e) {
            console.log('hola')

            var usuario = $('#usuario').val()
            var password = $('#password').val()
            if ($('#usuario').val() == "" || $('#password').val() == "") {
                $('button.resultado').html("Introducir usuario y contraseña")
                $('button.resultado').addClass('visible')
                $('button.resultado').removeClass('invisible')

            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + "index.php/inicio/validarUsuario",
                data: {
                    usuario: usuario,
                    password: password
                },
                success: function(datos) {
                    if (datos == 0) {
                        $('button.resultado').html("No se corresponden Usuario y Contraseña")
                        $('button.resultado').addClass('visible')
                        $('button.resultado').removeClass('invisible')
                        return false
                    }
                    var datos = $.parseJSON(datos)
                    window.location.href = "<?php echo base_url() ?>index.php/bienvenida";
                },
                error: function() {
                    $('button.resultado').html("Error en la consulta")


                }
            })

            $('#usuario, #password').focus(function() {
                $('button.resultado').addClass('invisible')
                $('button.resultado').removeClass('visible')
            })
        })


       
    })
</script>

</html>