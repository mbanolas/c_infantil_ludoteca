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
<link href="<?php echo base_url() ?>css/cssTables/inscripciones.css" rel="stylesheet">

<style>

#gcrud-search-form > table > tbody > tr > td:nth-child(10) > div.d-none.d-lg-block.d-xl-block.d-md-block > div > a{
    font-size: 0.8rem;
}

#gcrud-search-form > table > tbody > tr > td:nth-child(13) > div.d-none.d-lg-block.d-xl-block.d-md-block > div > a:nth-child(1){
    background-color: white !important;
    color: blue !important;
    width:100px;
    font-weight: bold;
    font-size:0.8rem;
}
#gcrud-search-form > table > tbody > tr > td:nth-child(13) > div.d-none.d-lg-block.d-xl-block.d-md-block > div > a:nth-child(2){
    background-color: white !important;
    color: red !important;
    width:100px;
    font-weight: bold;
    font-size:0.8rem;
}

/* margen superior tabla */
.card-body > .row {
    height: 60px;
}
    /* .grocery-crud-table{
               margin-top: 20px;
           } */
    /* subrayado titulos */
    /* thead >tr {
        border-bottom: 2px solid black;
    } */
    #gcrud-search-form > table > tbody > tr > td:nth-child(13){
        display:none;
    }  

/* formateeo pie  */
    tr#pie{
        border-top:5px solid grey;
            border-bottom:5px solid grey;
    }

    #pie:first-child{
        border-left:9px solid grey;
    }
    #pie > th:nth-last-child(1){
        border-right:9px solid grey;
    }

    #pie > tr{
        text-align: left
    }
    #pie.color{
        background-color: lightblue;
    }

    #precio_a_pagar,#pagado,#pendiente_pago{
        text-align: right;
        font-weight: bold;
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

<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
<script>

    $(document).ready(function() {

        // // boton Nova Inscripció
        // $('body > header:nth-child(24) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div.col-md-4.col-sm-6.col-xs-12 > a').before('<a class="float-left btn btn-primary btn-sm waves-effect waves-light" id="nuevaInscripcion"  href="<?php echo base_url() ?>index.php/inscripciones/alta"><i class="fa fa-plus"></i><span class="hidden-xs floatR l5"> &nbsp;Nova inscripció</span></a>')

        // ????
        $('#gcrud-search-form > table > tbody > tr > td > div.d-none.d-lg-block.d-xl-block.d-md-block > div > a:nth-child(1)').css('color','red !important')

        // se oculta Buscar general porque no procede
        // $('body > header:nth-child(24) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div:nth-child(2)').html("")
        // $('body > header:nth-child(24) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div:nth-child(2)').addClass('d-none')
        $('body > header:nth-child(24) > div > div > div > div > div > div.gc-container.container-fluid > div.card > div.card-body > div.row > div:nth-child(2)').addClass('invisible')
       
        //eliminar última columna 
        $('#gcrud-search-form > table > thead > tr:nth-child(1) > th:nth-child(13)').addClass('d-none')
        $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > th').addClass('d-none')
        $('#gcrud-search-form > table > tbody > tr > td:nth-child(13)').addClass('d-none')
        $('#pie > th:nth-child(11)').addClass('d-none')

        //pie con totales rango seleccionado
        $('<tfoot ><tr id="pie"><th  >Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th id="precio_a_pagar"></th><th id="pagado"></th><th id="pendiente_pago" ></th><th ></th></tr></tfoot>').insertAfter('tbody')
  

         // calcular totales en pie cuando se hace alguna búsqueda
         // se introduce algún dato
         $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td > input').keyup(function(){
             totalesPie()
        })
        // se quita la búsqueda
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
         var sql="SELECT sum(precio_a_pagar) as precio_a_pagar,  sum(pago) as pagado, sum(pendiente_pago) as pendiente_pago FROM c_inscripciones "
         var where=" WHERE fecha_alta>='<?php echo $desde ?>' AND fecha_alta <='<?php echo $hasta ?>'" 
         $('#pie').removeClass('color')  
         $('#gcrud-search-form > table > thead > tr.filter-row.gc-search-row > td > input').each(function(){
                 var valor=buscar($(this).val());
                 if(valor){
                     var campo=$(this).attr('name')
                     $('#pie').addClass('color')
                     console.log(campo)
                     switch(campo){
                         case 'texto_curco':
                             where+=" AND texto_curco LIKE '%"+valor+"%'"
                         break 
                         case 'num_inscripcion':
                             where+=" AND num_inscripcion LIKE '%"+valor+"%'"
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
                         case 'actividades':
                             where+=" AND actividades LIKE '%"+valor+"%'"
                         break 
                         case 'trimestres':
                             where+=" AND trimestres LIKE '%"+valor+"%'"
                         break 
                         case 'precio_a_pagar':
                             where+=" AND precio_a_pagar LIKE '%"+valor+"%'"
                         break 
                         case 'pago':
                             where+=" AND pago LIKE '%"+valor+"%'"
                         break 
                         case 'pendiente_pago':
                             where+=" AND pendiente_pago LIKE '%"+valor+"%'"
                         break 
                         case 'fecha_modificacion':
                             where+=" AND fecha_modificacion LIKE '%"+valor+"%'"
                         break 
                     }
                 }
                 })
             sql+=where
            //  alert(sql)
             console.log(sql)         
             $.ajax({
                 type:'POST',
                 url: "<?php echo base_url() ?>"+"index.php/inscripciones/totales", 
                 data:{sql:sql},
                 success:function(datos){
                    //  alert(datos)          
                     var datos=$.parseJSON(datos);
                    //  alert(datos) 
                     if(!datos) datos=0
                     

                     $('#precio_a_pagar').text(datos['precio_a_pagar'])
                     $('#pagado').text(datos['pagado'])
                     $('#pendiente_pago').text(datos['pendiente_pago'])
                    
                   
 
                 },
                 error: function(){
                         alert("Error en el proceso cálculo totalesPie. Informar");
                 }
                 })    
             
 
 
                 
         
     }

        // $('.searchable-input').keyup(function(){
        //     console.log($(this).attr('name'))
        //     $(this).css('border', '2px solid red !important')
        // })

        // búsqueda para campos calculados
        // $('.searchable-input').keyup(function(){

        // buscar($(this).attr('name'),'id_actividades')
        // buscar($(this).attr('name'),'id_trimestres')
        // buscar($(this).attr('name'),'nombre')
        // buscar($(this).attr('name'),'apellido1')
        // buscar($(this).attr('name'),'apellido2')
        // buscar($(this).attr('name'),'id_curso')
        // })


        // $('[name="id_actividades"').attr('id', 'id_actividades');
        // $('[name="id_actividades"').attr('name', '');
        // $('[id="id_actividades"').keyup(function(e){
        //     var buscar=$(this).val().toLowerCase()
        //     var row=$('td').index($(this).parent())+1
        //     $('tbody > tr > td:nth-child('+row+')').parent().removeClass('d-none')
        //     var t=$('tbody > tr > td:nth-child('+row+')').html().toLowerCase()
        //     if (t.indexOf(buscar) < 0) 
        //         $('tbody > tr > td:nth-child('+row+')').parent().addClass('d-none')
        // })



        // $('#nuevaInscripcion').click(function(){
        //     alert('hola')
        // })

        // #field_id_trimestres_chosen > ul
        // $("<li class='search-choice'><span>Gener</span><a class='search-choice-close' data-option-array-index='0'></a></li>").insertBefore('#field_id_trimestres_chosen > ul > li.search-field');
        // $('#field-id_trimestres > option:nth-child(4)').attr('selected','selected')
        // console.log($('#field-id_trimestres').children(4).html())
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