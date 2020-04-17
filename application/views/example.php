<?php
	if(uri_string() == '')
		{
			header("Location: " . site_url('prueba/employees_management'));
		}
?>
<!-- <!DOCTYPE html>
<html lang="en" class="full-height">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 --><?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<!-- <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> 
 -->
</head>
<style>
    /* color fondo barra navegacion*/
	.navbar:not(.top-nav-collapse), .navbar.top-nav-collapse {
		background-color:#233A50 !important;
	}

 /* table proveedores */
    /* color texto tablas */
    table.table  td {
		padding:5px ;
		color:blue;
	}
	table.table  td:nth-last-child(1) {
        padding: 0px ;
    }
    /* prmera columna oculta */
    table.table  thead tr th:nth-child(1) {
        display:none;
    }
    table.table  thead tr td:nth-child(1) {
        display:none;
    }
    table.table  tbody tr td:nth-child(1) {
        display:none;
    }


    table.table  thead tr th:nth-last-child(1) {
/*         background-color: red;
 */        width:1%;
           visibility: hidden;
    }
  

	table.table .btn.btn-sm {
		padding: .5rem 0.6rem;
    }
    
    div.card-footer > div > div:nth-child(3){
        margin-top:-10px;
    }
    div.card-footer > div > div:nth-child(2){
        margin-top:-20px;
    }


	.searchable-input {
		margin:0;
		padding:0;
	}
	table.table thead tr th {
        font-weight: bold;
		padding-top: .2rem;
		padding-bottom: .2rem;
		border:1px solid #e9ecef;
	}
	
tr.gc-search-row td:nth-child(1){
	display:inline-flex;
	margin-top:5px;
	border:0px;
}
.gc-refresh{
	display:inline-flex;
	width: 30px;
	
}
.select-all-none{
	margin-left: 10px;
	margin-right: 10px;
}
.fa-search:before {
    font-size: 2rem;
    content: "\f002";
    font-size: 1rem;
}
.card{
    margin-top:60px;
}


.card-footer .row{
    /*height: 500px;*/
    
}
.clear-all-search{
    color:red;
}


.card-body > .row{
    height: auto;
 }

.card-body > .row div:nth-child(2){
    /* background-color: yellow; */
    display:grid;
    grid-template-columns: 2fr 1fr;

}
.card-body > .row div:nth-child(2) div:nth-child(1){
    min-width:300px;
    margin:0px;
}
.card-body > .row div:nth-child(2) div:nth-child(2){
    /* background-color: yellow; */
    display:grid;
    grid-template-columns: 1fr;
    margin:0px;
    margin-top:10px;
    
}
a.search-button{
    min-width:120px;
    padding:0px;
}
.gc-container .clear-all-search {
    cursor: pointer;
    margin-left: 20px;
    margin-top: -30px;
    position: absolute;
}


/* fin style tabla ---------------------------------------------------*/

#crudForm{
  /* background: yellow; */
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  /* grid-template-rows: auto; */
  /* grid-template-areas: 
    "id_proveedor nombre_proveedor nombre_proveedor nombre_proveedor nombre_proveedor"
    "domicilio domicilio cp poblacion poblacion"; */
  grid-column-gap: 2%; 
  grid-row-gap: 0%; 
} 



#crudForm div {
    /* background: gold; */
    /* margin-top:0px;
    width:100%; */
    
 }

 /* #crudForm div:nth-child(2) {
    grid-column: 2 / span 4;
    grid-row: 1 / 1;
 }
 #crudForm div:nth-child(2) label {
    grid-column: 2 / span 4;
    grid-row: 1 / 1;
    font-weight: bold;
 }
#crudForm div:nth-child(4) {
    grid-column: 3 / 5;
    grid-row: 3 / 4;
}
#crudForm div:nth-child(5) {
    grid-column: 1 / span 2;
    grid-row: 2 / 2;
 }
 #crudForm div:nth-child(6) {
    grid-column: 3 / span 1;
    grid-row: 2 / 2;
    width:50%
 }#crudForm div:nth-child(7) {
    grid-column: 4 / span 1;
    grid-row: 2 / 2;
 }#crudForm div:nth-child(8) {
    grid-column: 5 / span 1;
    grid-row: 2 / 2;
 } */
 
  /* #crudForm div:nth-child(1) {
    grid-area: id_proveedor;
 }
 #crudForm div:nth-child(2) {
    grid-area: nombre_proveedor;
 }
 
 #crudForm div:nth-child(3) {
    grid-area: nombre_id_contable;
 }
 #crudForm div:nth-child(4) {
    grid-area: id_forma_de_pago;
 }
 #crudForm div:nth-child(5) {
    grid-area: domicilio;
 }#crudForm div:nth-child(6) {
    grid-area: cp;
 }#crudForm div:nth-child(7) {
    grid-area: poblacion;
 }#crudForm div:nth-child(8) {
    grid-area: provincia;
 } */
 /* #crudForm div:nth-child(9) {
    grid-area: pais;
 }

 #crudForm div:nth-child(10) {
    grid-area: telefono;
 }
 #crudForm div:nth-child(11) {
    grid-area: cif;
 }
 #crudForm div:nth-child(12) {
    grid-area: pais;
 }
 #crudForm div:nth-child(13) {
    grid-area: fax;
 }
 #crudForm div:nth-child(14) {
    grid-area: email1;
 }
 #crudForm div:nth-child(15) {
    grid-area: email2;
 }
 #crudForm div:nth-child(16) {
    grid-area: contacto;
 }
 #crudForm div:nth-child(17) {
    grid-area: web;
 }
 #crudForm div:nth-child(18) {
    grid-area: telefono2;
 }
 #crudForm div:nth-child(19) {
    grid-area: movil;
 }
 #crudForm div:nth-child(20) {
    grid-area: otros;
 }
 #crudForm div:nth-child(21) {
    grid-area: fechaAlta;
 }
 #crudForm div:nth-child(22) {
    grid-area: fechaModificacion;
 }
 #crudForm div:nth-child(23) {
    grid-area: status_proveedor;
 }  */
 


/*largo y posición media query add edit modal */ 
.modal > .modal-dialog > .modal-content{
    background-color: blue;
    width:228%;
    margin-left: -63%;
} 

@media screen and (max-width: 1900px) {
    .modal > .modal-dialog > .modal-content{
    background-color: tomato;
    width:116%;
    margin-left: -8%;
} 
.card-body{
    background-color: tomato;
}
}


@media screen and (max-width: 1200px) {
    .modal > .modal-dialog > .modal-content{
    background-color: green;
    width:116%;
    margin-left: -8%;
} .card-body{
    background-color: green;
}
.card-body > .row div:nth-child(2){
    background-color: yellow;
    display:grid;
    grid-template-columns: 1fr;

}

}

 On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
    .modal > .modal-dialog > .modal-content{
    background-color: pink;
    width:140%;
    margin-left: -20%;
} .card-body{
    background-color: pink;
}
}

/* On screens that are 600px or less, set the background color to olive */
@media screen and (max-width: 768px) {
    .modal > .modal-dialog > .modal-content{
    background-color: red;
    width:100%;
    margin-left: -0%;
} .card-body{
    background-color: red;
}
}

@media screen and (max-width: 576px) {
    .modal > .modal-dialog > .modal-content{
    background-color: yellow;
    width:100%;
    margin-left: -0%;
} .card-body{
    background-color: yellow;
}
}






</style>

<script>
$(document).ready(function(){
   
$('table.table  thead tr th:nth-last-child(1)').text("")
$('.card-footer div div:nth-child(3)').css('padding-top','0px;')
    
})
 </script>


<body>
<!--Main Navigation-->
<header>

    <!--Navbar-->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <strong>MDB</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                <ul class="navbar-nav mr-auto">
                <?php
                $menu_items = array('Home / Employees'=>site_url('prueba/employees_management'),
                				'Customers'=>site_url('prueba/customers_management'),
                				'Orders'=>site_url('prueba/orders_management'),
                				'Products'=>site_url('prueba/products_management'),
                				'Offices'=>site_url('prueba/offices_management'),
                				'Films'=>site_url('prueba/film_management'),
                				'Multigrid [BETA]'=>site_url('prueba/multigrids') );

                 foreach($menu_items as $menu => $links){
                 	if($links == site_url(uri_string())){
                 		echo '<li class="nav-item active"><a class="nav-link black-text" href="'.$links.'"><b>'.$menu.'</b></a></li>';
                 	} else {
                 		echo '<li class="nav-item"><a class="nav-link black-text" href="'.$links.'">'.$menu.'</a></li>';
                 	}
                 }

                ?>
                </ul>
												  <a class="btn btn-blue float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
												    Sample Codes
												  </a>
            </div>
        </div>
    </nav> -->

    <!-- Intro Section -->
    <div style="background-image: url(https://mdbootstrap.com/img/Photos/Others/images/76.jpg);">
            <div class="container-fluid" style="min-height:1000px">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="intro-info-content">

								<?php
								                if($codes){

								                ?>
								                <div class="text-center mb-1 pt-5 mt-5">
												<div class="collapse" id="collapseExample">
												  <div class="card card-body text-left">
												    	<?php  echo $codes; ?>
												  </div>
												</div>
												</div><br>
								                <?php

								                }
								?>
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

