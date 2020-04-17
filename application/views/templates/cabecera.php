<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $casal; ?></title>
    <!-- favicon -->
    <link rel="icon" href="https://incoop.cat/wp-content/uploads/2018/08/cropped-FAV-ICON-INCOOP-32x32.png" sizes="32x32"> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url() ?>css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">


<style>
.pendiente{
    text-decoration:line-through;
    color: red !important;;
}
/* aumento tamañp barras mení */
a.button-collapse{
    font-size: 20px !important;
}

    /*styles side nav and doble nav */
.side-nav .collapsible a {
    font-weight: 300;
    font-size: 1.1rem !important;
    height: 30px !important;
    line-height: 30px !important;
}
body{
    font-size: 1.1rem !important;
}
.double-nav a {
    font-size: 13.2px !important;
}
#slide-out > ul > li:nth-child(1) > div > a > img{
    height: 80px !important;
}
img.img-fluid.flex-center{
    padding-top:0px !important;
    padding-bottom: 0px !important;
    padding-right: 0px !important;
    padding-left: 94px !important;
    margin-right: 0px !important;
}
.side-nav {
    width: 20rem !important;
}


</style>
</head>
<!-- <body class="hidden-sn mdb-skin" > -->
<body class="hidden-sn mdb-skin" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/images/76.jpg);">>
<!--Double navigation-->
<header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4">
            <ul class="custom-scrollbar">
                <!-- Logo -->
                <li>
                    <div class="logo-wrapper waves-light">
                        <a href="#">
                        <!-- imagen logo --> 
                        <!-- <img class="mx-auto d-block" style="width:16vw; height:10vh" src="<?php echo base_url() ?>img/casal_estiu.jpeg " class="img-fluid flex-center"> -->

                       <!-- <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center"> -->
                       <!-- <img src="<?php echo base_url() ?>img/casal_estiu.jpeg " class="img-fluid flex-center"> -->
                       <img src="<?php echo base_url() ?>img/CI_LOGO.jpg " class="img-fluid flex-center">
                        </a>
                    </div>
                </li>
                <!--/. Logo -->
                
                <!--Search Form-->
                <!-- <li>
                    <form class="search-form" role="search">
                        <div class="form-group md-form mt-0 pt-1 waves-light">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </form>
                </li> -->
                <!--/.Search Form-->
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a href="<?php echo base_url()?>index.php/inicio" class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-home mr-3"></i>Inici
                              <!--  <i class="fa fa-angle-down rotate-icon"></i> -->
                            </a>
                           
                        </li>
                        
                        <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                        <a href="<?php echo base_url()?>index.php/usuarios2/usuarios" class="waves-effect">
                                <i class="fa fa-users mr-3"></i>Usuaris/usuàries
                              <!--  <i class="fa fa-angle-down rotate-icon"></i> -->
                            </a>
                        </li>
                        <li>
                        <a href="<?php echo base_url()?>index.php/contrataciones/contrataciones" class="waves-effect">
                                <i class="fa fa-file-o mr-3"></i>Contratació espai ludoteca
                              <!--  <i class="fa fa-angle-down rotate-icon"></i> -->
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($this->session->categoria==100 ) { ?>
                        <li>
                        <a href="<?php echo base_url()?>index.php/usuarios2/usuariosTutores" class="waves-effect">
                                <i class="fa fa-users mr-3"></i>Usuaris/usuàries
                              <!--  <i class="fa fa-angle-down rotate-icon"></i> -->
                            </a>
                        </li>
                        <?php } ?>
                        <!-- <li>
                        <a href="<?php echo base_url()?>index.php/usuariosLudoteca/usuarios" class="waves-effect">
                                <i class="fa fa-chevron-right"></i> Inscripcions a Ludoteca
                                <i class="fa fa-angle-down rotate-icon"></i> 
                            </a>
                        </li> -->


                        <!-- <li>
                        <a href="<?php echo base_url()?>index.php/usuariosLudoteca2/usuarios" class="waves-effect">
                                <i class="fa fa-chevron-right"></i> Inscripcions Ludoteca 2
                               <i class="fa fa-angle-down rotate-icon"></i> 
                            </a>
                        </li> -->

                       
                        <!-- <li>
                            <a class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-book"></i> Llistats inscripcions
                                <i class="fa fa-angle-down rotate-icon"></i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/listados/todas" class="waves-effect">Todas las actividades</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/listados/una" class="waves-effect">Una actividad</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        
                        <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                            <a class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-database mr-3"></i>Base Dades Varios
                                <i class="fa fa-angle-down rotate-icon"></i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                    <a href="<?php echo base_url()?>index.php/contrasenyas/contrasenyas" class="waves-effect">Contrasenyes usuaris/usuàries</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/cursos/cursos" class="waves-effect">Cursos</a>
                                    </li>
                                    <li>
                                    <a href="<?php echo base_url()?>index.php/grupos/grupos" class="waves-effect">Grups</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>

                        <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                            <a class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-comments-o mr-3"></i>Activitats
                                <i class="fa fa-angle-down rotate-icon"></i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/actividades/actividades" class="waves-effect">Activitats</a>
                                    </li>
                                    <li>
                                    <a href="<?php echo base_url()?>index.php/basesdatos/ponerdatos" class="waves-effect">Posar dades comunes activitats</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                        <?php } ?>

                        <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                            <a class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-th-large mr-3"></i>Inscripcions
                                <i class="fa fa-angle-down rotate-icon"></i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/inscripciones/inscripciones" class="waves-effect">Inscripcions</a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/inscripciones/inscripciones_relacionales" class="waves-effect ">Inscripcions activitats relacionals</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/inscripciones/inscripciones_navidad" class="waves-effect ">Inscripcions activitats Nadal</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/inscripciones/inscripciones_verano" class="waves-effect ">Inscripcions activitats estiu</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/inscripciones/inscripciones_ludoteca" class="waves-effect ">Inscripcions activitats ludoteca</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/inscripciones/inscripcionesEntreFechas" class="waves-effect">Inscripcions entre dates</a>
                                    </li>
                                    <li>
                                    <!-- <a href="<?php echo base_url()?>index.php/inscripciones/alta" class="waves-effect">Altes inscripcions</a> -->
                                    </li>
                                    <li>
                                    <a href="<?php echo base_url()?>index.php/asistentes/asistentes" class="waves-effect">Llista asistents activitats</a>
                                    </li>
                                    <li>
                                    <a href="<?php echo base_url()?>index.php/asistentes/lista_esperas" class="waves-effect">Llista d'espera</a>
                                    </li>
                                    <!-- <li>
                                    <a href="<?php echo base_url()?>index.php/listados/una" class="waves-effect">Llista una activitat</a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                        

                        <!-- <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                        <a href="<?php echo base_url()?>index.php/actividades/actividades" class="waves-effect">
                                <i class="fa fa-chevron-right"></i> Activitats
                               <i class="fa fa-angle-down rotate-icon"></i>
                            </a>      
                        </li>
                        <?php } ?> -->

                        <!-- <li>
                        <a href="<?php echo base_url()?>index.php/ludotecas/ludotecas" class="waves-effect">
                                <i class="fa fa-chevron-right"></i> Contratació Ludotecas
                                <i class="fa fa-angle-down rotate-icon"></i> 
                            </a>      
                        </li> -->
                        <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                            <a class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-ticket mr-3"></i>Cobraments
                                <i class="fa fa-angle-down rotate-icon"></i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/recibos/caja" class="waves-effect">Arqueig caixa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/recibos/cobros" class="waves-effect">Rebuts cobrats</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/recibos/devoluciones" class="waves-effect">Rebuts devolucions</a>
                                    </li>
                                    <!-- <li>
                                        <a href="<?php echo base_url()?>index.php/recibos/cero" class="waves-effect">Rebuts import 0</a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                        <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                        <li>
                        <a href="<?php echo base_url()?>index.php/recibos/informeAyuntamiento" class="waves-effect">
                                <i class="fa fa-book mr-3"></i>Informe Ajuntament
                              <!--  <i class="fa fa-angle-down rotate-icon"></i> -->
                            </a>      
                        </li>
                        <?php } ?> 
                        <li>
                        <a  href="<?php echo base_url()?>index.php/inicio">
                        <i class="fa fa-sign-out mr-3"></i>Sortir
                        <!-- <span class="clearfix d-none d-sm-inline-block">Sortir</span> -->
                    </a>
                        </li>
                        


                        <!-- <li>
                            <a class="collapsible-header waves-effect arrow-r">
                                <i class="fa fa-book"></i> Activitats
                                <i class="fa fa-angle-down rotate-icon"></i>
                                <div class="collapsible-body">
                            </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/actividades" class="waves-effect">Actividades gestió</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>index.php/actividades/bajas" class="waves-effect rojo">Baixes</a>
                                    </li>
                                    <li>
                                        <a href="#" class="waves-effect">Clientes</a>
                                    </li> 
                                </ul>
                            </div>
                        </li> -->
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Programa Gestió <?php echo getNombreCasal() ?><span id="screenSize_"></span></p> 
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                <li class="nav-item">
                    <a href="<?php echo base_url()?>index.php/usuarios2/usuarios" class="nav-link ">
                        <i class="fa fa-users"></i>
                        <span class="clearfix d-none d-sm-inline-block">Usuaris</span>
                    </a>
                </li>
            <?php } ?>
            <?php if($this->session->categoria==100) { ?>
                <li class="nav-item">
                    <a href="<?php echo base_url()?>index.php/usuarios2/usuariosTutores" class="nav-link ">
                        <i class="fa fa-users"></i>
                        <span class="clearfix d-none d-sm-inline-block">Usuaris</span>
                    </a>
                </li>
            <?php } ?>
            
            <?php if($this->session->categoria!=5 && $this->session->categoria!=100) { ?>
                <li class="nav-item">
                    <a href="<?php echo base_url()?>index.php/inscripciones/inscripciones" class="nav-link ">
                        <i class="fa fa-th-large"></i>
                        <span class="clearfix d-none d-sm-inline-block">Inscripcions</span>
                    </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo base_url()?>index.php/actividades/actividades" class="nav-link ">
                        <i class="fa fa-comments-o"></i>
                        <span class="clearfix d-none d-sm-inline-block">Activitats</span>
                </a>
                </li>
            <?php } ?>
                <!-- <li class="nav-item">
                    <a class="nav-link">
                        <i class="fa fa-user"></i>
                        <span class="clearfix d-none d-sm-inline-block">Principal 3</span>
                    </a>
                </li> -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Varios
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Varios 1</a>
                        <a class="dropdown-item" href="#">Varios 2</a>
                        <a class="dropdown-item" href="#">Varios 3</a>
                    </div>
                </li> -->

                <?php if($this->session->userdata('categoria')==1) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/desarrollo/inicializarArchivos">
                        <i class="fa fa-connectdevelop"></i>
                        <span class="clearfix d-none d-sm-inline-block">Inicializar Archivos</span>
                    </a>
                </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/inicio">
                        <i class="fa fa-sign-out"></i>
                        <span class="clearfix d-none d-sm-inline-block">Sortir</span>
                    </a>
                </li>
               
            </ul>
        </nav>
        <!-- /.Navbar -->

        <!-- https://github.com/zzarcon/default-passive-events 
        para evitar violation info en la console -->
        <!-- <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script> -->


    </header>
    <!--/.Double navigation-->

    