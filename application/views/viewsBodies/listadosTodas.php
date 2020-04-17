<style>
    /* aumento tamañp barras mení */
a.button-collapse{
    font-size: 20px !important;
}
    
    
    .jumbotron {
        margin-top: 100px;
        margin-left: 80px;
        margin-right: 80px;
    }

    #cursos {
        width: 0px;
    }

    .numero {
        text-align: right;
    }

    td {
        padding-top: 6px !important;
        padding-bottom: 8px !important;
    }
    #exportar{
        margin-top:30px;
    }
</style>

<div class="jumbotron">
    <h2 class="display-5">Llistat inscripcions totes les activitats</h2>
    <h3 class="display-8">Seleccionar un curs:</h3>
    <div class="container">
    <?php echo form_open('listados/exportarTodas', array('class' => "form-horizontal", 'role' => "form")); ?>
        <div class="row">
            <select class="mdb-select md-form col-3" id="cursos" name="id_curso">
                <option value=0>Seleccionar un curs</option>
                <?php echo $options; ?>
            </select> 
            <div class="col-1">

            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-indigo btn-sm gc-export waves-effect waves-light d-none" id="exportar" >
                           <i class="fa fa-cloud-download"></i>
                           <span class="invisible-xs">
                               Exportar
                            </span>
                           <div class="clear"></div>
                </button>            
            </div>
        </div>
        <div class="row" >
            <h2>Pendiente de implementar</h2>
        </div>
        <div class="row" id="tabla">
        </div>
        <?php echo form_close(); ?>
    </div>



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>

<!-- <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url() ?>js/mdb.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url() ?>js/popper.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function() {
        // alert('jQuery version '+jQuery.fn.jquery);
        $('.mdb-select').materialSelect();
    

    $('#cursos').change(function() {
        // alert($(this).val())
        var curso = $(this).val()
        if(curso) {$('#exportar').removeClass('d-none')}

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + "index.php/inscripciones/getTablaInscripcionesPagadas/" + curso,
            data: "",
            success: function(datos) {
                // console.log(datos)
                var datos = $.parseJSON(datos)
                console.log(datos)
                
                
                $('#tabla').html("")
                $('#tabla').append(datos)

            },
            error: function() {
                alert('Error en inscripciones/getTablaInscripcionesPagadas. Informar administrador')
            }
        })
    })


    // $('#exportar').click(function(){
    //     $('#modalInfoLabel').text("Informació")
    //     $('.modal-body').html("Pendent d'implementar")
    //     $('#modalInfo').modal('show')
    // })
        
    })
</script>