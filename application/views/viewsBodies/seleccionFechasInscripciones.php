<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .jumbotron {
        margin-top: 100px;
        margin-left: 80px;
        margin-right: 80px;
    }

    /* aumento tamañp barras mení */
    a.button-collapse {
        font-size: 20px !important;
    }

    .picker__nav--next:before {
        content: "\003E" !important;
        font-size: 1rem;

    }

    .picker__nav--prev:before {
        content: "\003C" !important;
        font-size: 1rem;
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






    <div class="jumbotron">
        <h2 class="display-5">Inscripcions</h2>
        <h3 class="display-8">Seleccionar dates</h3>
        <?php echo form_open('inscripciones/inscripciones_fechas', array('class' => "form-horizontal", 'role' => "form")); ?>

        <div class="md-form">
            <input placeholder="Seleccionar data" type="text" id="desde" name="desde" class="form-control datepicker">
            <label for="desde">Des del</label>
        </div>

        <div class="md-form">
            <input placeholder="Seleccionar data" type="text" id="hasta" name="hasta" class="form-control datepicker">
            <label for="hasta">Fins al</label>
        </div>
        <button type="submit" id="arqueoCaja" class="btn btn-primary">Inscripcions</button>
        <?php echo form_close(); ?>

    </div>

</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> -->

<!-- <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/mdb.min.js"></script> -->

<!-- <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script> -->

<script>
    $(document).ready(function() {

        $('#arqueoCaja').click(function(){
            var desde = $('#desde').val()
            var hasta = $('#hasta').val()
            if (hasta < desde) {
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("La data fins ha de ser posterior a la data des de.")
                $('#modalInfo').modal('show')
                e.preventDefault()
            }
        })

       

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        
        // Strings and translations
        //Ps.initialize(sideNavScrollbar);

        //  $('.datepicker').datepicker();
        $('.datepicker').pickadate({
                monthsFull: ['Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre',
                    'Novembre', 'Desembre'
                ],
                monthsShort: ['Gen', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Des'],
                showMonthsShort: true,
                weekdaysFull: ["Diumenge", "Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte"],
                weekdaysShort: ['diu', 'dil', 'dim', 'dmc', 'dij', 'div', 'dis'],
                today: 'Avui',
                clear: 'esborrar',
                close: 'Tancar',
                firstDay: 1,
                // format: 'dddd, d !de mmmm !de yyyy',
                format: 'dd/mm/yyyy',
                formatSubmit: 'yyyy-mm-dd',
                labelMonthNext: 'Seguent mes',
                labelMonthPrev: 'Mes anterior',
                labelMonthSelect: 'Seleccionar un mes',
                labelYearSelect: 'Selecciona un any',
                selectMonths: true,
                selectYears: true,
                navPrev: 'picker__nav--prev',
                navNext: 'picker__nav--next',
                //editable: true,

            }



        );
    });
    // Data Picker Initialization
</script>