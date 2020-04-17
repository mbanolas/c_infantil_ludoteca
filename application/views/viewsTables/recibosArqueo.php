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
<link href="<?php echo base_url() ?>css/cssTables/recibos.css" rel="stylesheet">

</head>
<style>
td a{
    color:blue !important;
    text-decoration: underline;
}
#gcrud-search-form > table > thead > tr > th:nth-child(8){
    text-align: right;
}
#gcrud-search-form > table > tbody > tr > td:nth-child(9){
    text-align: right;
}
#gcrud-search-form > table > tbody > tr > td:nth-child(10){
    text-align: right;
}
#gcrud-search-form > table > tbody > tr > td:nth-child(11){
    text-align: right;
}


body > header:nth-child(29) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-header.red.white-text{
    background-color: #45526e !important;
}

/* margen superior tabla */
       .grocery-crud-table{
           margin-top: 20px;
       }
thead{
    border-bottom: 2px solid black;
}

/* formateeo pie  */
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
    #total,#metalico,#tarjeta,#transferencia{
        text-align: right;
    }


</style>

<!-- <script src="<?php echo base_url() ?>js/tablasGrocery2.js" ?>></script> -->
<script src="<?php echo base_url() ?>js/tablasGrocery.js" ></script>

<script>
    $(document).ready(function() {

        // boton exportacion para generar Excel maba
        $('<a class="btn btn-indigo btn-sm  waves-effect waves-light" href="<?php echo base_url() ?>index.php/recibos/excel_arqueo/<?php echo $desde ?>/<?php echo $hasta ?>"><i class="fa fa-cloud-download"></i><span class="invisible-xs">Exportar</span><div class="clear"></div></a>').insertBefore('.gc-export')
        $('.gc-export').addClass('d-none')
        $('.gc-print').addClass('d-none')

        // ocultar ultima columna tabla (pendiente)
        $('#gcrud-search-form > table > thead > tr:nth-child(1) > th.invisible.text-center').addClass('d-none')
        $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(12)').addClass('d-none')
        $('#gcrud-search-form > table > tbody > tr > td.invisible').addClass('d-none')

        // eliminan busquedas por metalico, tarjetas y transferencias (campos calculados)
        $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td:nth-child(9) > input').addClass('d-none')
        $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td:nth-child(10) > input').addClass('d-none')
        $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td:nth-child(11) > input').addClass('d-none')

        //pie con totales rango seleccionado
        $('<tfoot ><tr id="pie"><th  >Total caixa</th><th></th><th></th><th></th><th></th><th></th><th id="total"></th><th id="metalico"></th><th id="tarjeta"></th><th id="transferencia"></th></tr></tfoot>').insertAfter('tbody')
  
        // calcular totales en pie cuando se hace alguna búsqueda
        $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td > input').keyup(function(){
             totalesPie()
        })

        $('#search-input').blur(function(e){
            totalesPie()
        })

        $('#search-input').change(function(){
            if($(this).val().includes("/")){
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Des d'aquí no es poden buscar per dates. Realitzar la recerca des de la columna corresponent")
                $('#modalInfo').modal('show')
                totalesPie()
                return
            }
            if($(this).val()!=""){
                $('#modalInfoLabel').text("Informació")
                $('.modal-body').html("Des 'Cerca tots' no es mostren els totals i no és possible exportar la taula")
                $('#modalInfo').modal('show')
            }
            totalesPie()
        })

        
 
        $('body > header:nth-child(24) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div.col-md-4.col-sm-6.col-xs-12 > a.float-left.btn.btn-sm.btn-info.clear-filtering.waves-effect.waves-light').click(function(){
            totalesPie()
        }) 

        totalesPie()

        function buscar(dato){
             
             if(!isNaN(dato) || dato.indexOf('/')==-1) return dato
            //  console.log('dato inicial '+dato)
             var n = dato.indexOf(" ");
            //  console.log('n '+n)
             var hora=""
             var d=dato.trim()
             if(n>0){
                hora= dato.substring(n)
                d=d.substring(0,n)
             }
            //  console.log('hora '+hora)
             
            //  console.log(d)
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
            //  console.log(fecha)
             fecha=fecha.substring(0,fecha.length-1)+hora
            //  console.log(fecha)
             return fecha
        }  
        
        function totalesPie(){
            // verificamos si hay algo en la búsqueda global
            console.log('Búsqueda global = '+$('#search-input').val())
            if($('#search-input').val()!=""){
                    $('#pie').addClass('d-none')
                    $('body > header:nth-child(29) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div.col-md-4.col-xs-12.text-right > a:nth-child(1)').addClass('d-none')
                }
                else {
                    $('#pie').removeClass('d-none')
                    $('body > header:nth-child(29) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div.col-md-4.col-xs-12.text-right > a:nth-child(1)').removeClass('d-none')
            }
         var sql="SELECT sum(importe_total) as total FROM c_recibos "
         var where=" WHERE fecha_recibo>='<?php echo $desde ?>' AND fecha_recibo <='<?php echo $hasta ?>'" 
         $('#pie').removeClass('color')  
         $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td > input').each(function(){
                 var valor=buscar($(this).val());
                 if(valor){
                     var campo=$(this).attr('name')
                     $('#pie').addClass('color')
                    //  console.log(campo)
                     switch(campo){
                         case 'fecha_recibo':
                             where+=" AND fecha_recibo LIKE '%"+valor+"%'"
                         break 
                         case 'num_registro_ingreso':
                             where+=" AND num_registro_ingreso LIKE '%"+valor+"%'"
                         break 
                         case 'id_inscripcion':
                             where+=" AND id_inscripcion LIKE '%"+valor+"%'"
                         break 
                         case 'nombre_alumno':
                             where+=" AND nombre_alumno LIKE '%"+valor+"%'"
                         break 
                         case 'apellido1_alumno':
                             where+=" AND apellido1_alumno LIKE '%"+valor+"%'"
                         break 
                         case 'apellido2_alumno':
                             where+=" AND apellido2_alumno LIKE '%"+valor+"%'"
                         break 
                         case 'importe_total':
                             where+=" AND importe_total LIKE '%"+valor+"%'"
                         break 
                         case 'metalico':
                             where+=" AND metalico LIKE '%"+valor+"%'"
                         break 
                         
                     }
                 }
                 })
             sql+=where
             console.log(sql)
             
            //  console.log(sql)         
             $.ajax({
                 type:'POST',
                 url: "<?php echo base_url() ?>"+"index.php/recibos/totales", 
                 data:{sql:sql},
                 success:function(datos){
                    //  alert(datos)          
                     var datos=$.parseJSON(datos);
                    //  alert(datos) 
                     if(!datos) datos=0
                    
                     $('#total').text(datos['importe_total'])
                     $('#metalico').text(datos['metalico'])
                     $('#tarjeta').text(datos['tarjeta'])
                     $('#transferencia').text(datos['transferencia'])
                   
 
                 },
                 error: function(){
                         alert("Error en el proceso cálculo totalesPie. Informar");
                 }
                 })    
             
 
 
                 
         
     }
 
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