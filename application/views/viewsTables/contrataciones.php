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
<link href="<?php echo base_url() ?>css/cssTables/contrataciones.css" rel="stylesheet">

<style>

/* cambia el color por defecto de  la barra */  
.red{
    background-color: #bf360c  !important;
}

/* ajusta campos imput mdb propio */*
.md-form > label{
        margin-top:-7px;
    }
    .md-form > label.active{
        margin-top:0px;
    }

    /* defimir anchuras columnas */
    #gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(4){
        max-width:90px;
    }
    #gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(5),
    #gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(6){
        min-width: 130px;
    }
    #gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(8){
        width:50px;
    }
    #gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(9){
        width:50px;
    }


    #pie > th{
        border-top:5px solid grey;
        border-bottom:5px solid grey;
    }
    #pie:first-child{
        border-left:9px solid grey;
    }
    #pie > th:nth-last-child(1){
        border-right:5px solid grey;
    }

    #pie > tr{
        text-align: left
    }
    #pie.color{
        background-color: lightblue;
    }
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
        // $('#field-desde').removeClass('datetime-input')
        // $('#field-hasta').removeClass('datetime-input')
        // $('#field-desde').removeClass('hasDatepicker')
        $('a.datepicker-input-clear').remove()
        var nodes = $(".fecha_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }
        $('a.datetime-input-clear').remove()
        var nodes = $(".desde_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }
        var nodes = $(".hasta_form_group")[0];
        if (nodes != null) {
            nodes = nodes.childNodes;
            $.each(nodes, function(i, e) {
                if (i == 5) $(this).remove()
            })
        }

 //pie con totales rango seleccionado
 $('<tfoot ><tr id="pie"><th  >Totals selecció</th><th></th><th></th><th></th><th></th><th></th><th id="total_alumnos"></th><th id="total_adultos"></th></tr></tfoot>').insertAfter('tbody')
  
 // calcular totales en pie cuando se hace alguna bisqueda
 $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td > input').keyup(function(){
        totalesPie()
    })

 $('body > header:nth-child(24) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div.col-md-4.col-sm-6.col-xs-12 > a.float-left.btn.btn-sm.btn-info.clear-filtering.waves-effect.waves-light').click(function(){
    totalesPie()
 })   
 totalesPie()
 function buscar(dato){
            
            if(!isNaN(dato) || dato.indexOf('/')==-1) return dato
            console.log('dato inicial '+dato)
            var n = dato.indexOf(" ");
            console.log('n '+n)
            var hora=""
            var d=dato.trim()
            if(n>0){
               hora= dato.substring(n)
               d=d.substring(0,n)
            }
            console.log('hora '+hora)
            
            //console.log(d)
            var partes=[]
            while(d.indexOf('/')>0){
                var p=d.indexOf('/')
                partes.push(d.substring(0, p))
                d=d.substring(p+1)
            }
            partes.push(d)
            var fecha="";
            for(var i=partes.length-1;i>=0;i--){
                fecha=fecha+partes[i]+'-'
            }
            console.log(fecha)
            fecha=fecha.substring(0,fecha.length-1)+hora
            console.log(fecha)
            return fecha
    }  
 function totalesPie(){
        var sql="SELECT sum(total_alumnos) as total_alumnos, sum(total_adultos) as total_adultos FROM c_contrataciones "
        var where=" WHERE 1 " 
        $('#pie').removeClass('color')  
        $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td > input').each(function(){
                var valor=buscar($(this).val());
                
                if(valor){
                    var campo=$(this).attr('name')
                    $('#pie').addClass('color')
                    console.log(campo)
                    switch(campo){
                        case 'nombre_contratacion':
                            where+=" AND nombre_contratacion LIKE '%"+valor+"%'"
                        break 
                        case 'contratante':
                            where+=" AND contratante LIKE '%"+valor+"%'"
                        break 
                        case 'fecha':
                            where+=" AND fecha LIKE '%"+valor+"%'"
                        break 
                        case 'desde':
                            where+=" AND desde LIKE '%"+valor+"%'"
                        break 
                        case 'hasta':
                            where+=" AND hasta LIKE '%"+valor+"%'"
                        break 
                        case 'curso':
                            where+=" AND curso LIKE '%"+valor+"%'"
                        break 
                        case 'total_alumnos':
                            where+=" AND total_alumnos LIKE '%"+valor+"%'"
                        break 
                        case 'total_adultos':
                            where+=" AND total_adultos LIKE '%"+valor+"%'"
                        break 
                    }
                }
                })
            sql+=where
            
            // console.log(sql)         
            $.ajax({
                type:'POST',
                url: "<?php echo base_url() ?>"+"index.php/contrataciones/totales", 
                data:{sql:sql},
                success:function(datos){
                    // alert(datos)          
                    var datos=$.parseJSON(datos);
                    // alert(datos['total_alumnos']) 
                    if(!datos['total_alumnos']) datos['total_alumnos']=0
                    if(!datos['total_adultos']) datos['total_adultos']=0

                    $('#total_alumnos').text(datos['total_alumnos'])
                    $('#total_adultos').text(datos['total_adultos'])

                },
                error: function(){
                        alert("Error en el proceso cálculo totalesPie. Informar");
                }
                })    
            


                
        
    }


    })   
</script>

</html>