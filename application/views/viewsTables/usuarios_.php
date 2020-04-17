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
<!-- <link href="<?php echo base_url() ?>css/cssTables/usuarios_.css" rel="stylesheet"> -->

</head>
<style>
    /* poner color a boton Fitxa */
    #gcrud-search-form>table>tbody>tr>td:nth-child(10)>div.d-none.d-lg-block.d-xl-block.d-md-block>div>a:nth-child(2) {
        color: black !important;
        background-color: yellow !important;
    }


    .subtitulo {
        color: blue;
        font-size: 20px;
        font-weight: bold;
        margin-top: 25px;
    }

    #crudForm>div>div.card-body {
        display: grid;
        grid-template-rows: 60px auto repeat(3, 80px) auto repeat(2, 80px) auto auto auto 80px repeat(6,48px) auto repeat(8,48px) auto repeat(5,48px) auto repeat(2,48px) auto repeat(3,48px) auto auto repeat(4,30px);
        grid-template-columns: repeat(20, 1fr);
        grid-column-gap: 1%;
        grid-row-gap: 0%;
        /* height: 4000px; */
    }

    /*elimina casilla búsqueda en dropdowns */
    div.chosen-search {
        display: none;
    }

    div.chosen-drop {
        margin-top: -13px !important;
    }

    #crudForm>div>div.card-body>p.subtitulo {
        display: none;
    }

    #crudForm>div>div.card-body>div.md-form {
        margin-top: 12px;
        display: none;
    }

    #report-error {
        display: none;
    }

    /* num_usuario */
    #crudForm>div>div.card-body>div.num_usuario_form_group {
        margin-top: 20px;
        grid-column: 1 / span 15;
        grid-row: 1/1;
        display: block;
    }

    /* DADES PERSONALS RESPONSABLE */
    #crudForm>div>div.card-body>p.subtitulo1 {
        grid-column: 1 / span 20;
        grid-row: 2/2;
        display: block;
    }

    #crudForm>div>div.card-body>div.dni_tutor_form_group {
        margin-top: 2px;
        grid-column: 1 / span 3;
        grid-row: 3/3;
        display: block;
    }

    #field-dni_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.dni_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.dni_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.dni_tutor_form_group>label.active+input#field-dni_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }


    #crudForm>div>div.card-body>div.nombre_tutor_form_group {
        margin-top: 2px;
        grid-column: 4 / span 4;
        grid-row: 3/3;
        display: block;
    }

    #field-nombre_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.nombre_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.nombre_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.nombre_tutor_form_group>label.active+input#field-nombre_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.apellido1_tutor_form_group {
        margin-top: 2px;
        grid-column: 8 / span 4;
        grid-row: 3/3;
        display: block;
    }

    #field-apellido1_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido1_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.apellido1_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido1_tutor_form_group>label.active+input#field-apellido1_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }


    #crudForm>div>div.card-body>div.apellido2_tutor_form_group {
        margin-top: 2px;
        grid-column: 12 / span 4;
        grid-row: 3/3;
        display: block;
    }

    #field-apellido2_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido2_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.apellido2_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido2_tutor_form_group>label.active+input#field-apellido2_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }


    #crudForm>div>div.card-body>div.email_tutor_form_group {
        margin-top: 2px;
        grid-column: 16 / span 6;
        grid-row: 3/3;
        display: block;
    }

    #field-email_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.email_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.email_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.email_tutor_form_group>label.active+input#field-email_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.direccion_tutor_form_group {
        margin-top: 2px;
        grid-column: 1 / span 4;
        grid-row: 4/4;
        display: block;
    }

    #field-direccion_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.direccion_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.direccion_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.direccion_tutor_form_group>label.active+input#field-direccion_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.poblacion_tutor_form_group {
        margin-top: 2px;
        grid-column: 5 / span 4;
        grid-row: 4/4;
        display: block;
    }

    #field-poblacion_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.poblacion_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.poblacion_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.poblacion_tutor_form_group>label.active+input#field-poblacion_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.provincia_tutor_form_group {
        margin-top: 2px;
        grid-column: 9 / span 4;
        grid-row: 4/4;
        display: block;
    }

    #field-provincia_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.provincia_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.provincia_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.provincia_tutor_form_group>label.active+input#field-provincia_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.codigo_postal_tutor_form_group {
        margin-top: 2px;
        grid-column: 13 / span 2;
        grid-row: 4/4;
        display: block;
    }

    #field-codigo_postal_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.codigo_postal_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.codigo_postal_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.codigo_postal_tutor_form_group>label.active+input#field-codigo_postal_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.telefono1_tutor_form_group {
        margin-top: 2px;
        grid-column: 15 / span 3;
        grid-row: 4/4;
        display: block;
    }

    #field-telefono1_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.telefono1_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.telefono1_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.telefono1_tutor_form_group>label.active+input#field-telefono1_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.telefono2_tutor_form_group {
        margin-top: 2px;
        grid-column: 18 / span 4;
        grid-row: 4/4;
        display: block;
    }

    #field-telefono2_tutor {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.telefono2_tutor_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.telefono2_tutor_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.telefono2_tutor_form_group>label.active+input#field-telefono2_tutor {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.profesion_padre_form_group {
        margin-top: 2px;
        grid-column: 1 / span 6;
        grid-row: 5/5;
        display: block;
    }

    #field-profesion_padre {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.profesion_padre_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.profesion_padre_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.profesion_padre_form_group>label.active+input#field-profesion_padre {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.profesion_madre_form_group {
        margin-top: 2px;
        grid-column: 7 / span 6;
        grid-row: 5/5;
        display: block;
    }

    #field-profesion_madre {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.profesion_madre_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.profesion_madre_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.profesion_madre_form_group>label.active+input#field-profesion_madre {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    /* DADES PERSONALS INFANT/ JOVE */
    #crudForm>div>div.card-body>p.subtitulo2 {
        grid-column: 1 / span 20;
        grid-row: 6/6;
        display: block;
    }

    #crudForm>div>div.card-body>div.dni_alumno_form_group {
        margin-top: 2px;
        grid-column: 1/ span 3;
        grid-row: 7/7;
        display: block;
    }

    #field-dni_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.dni_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.dni_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.dni_alumno_form_group>label.active+input#field-dni_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.nombre_alumno_form_group {
        margin-top: 2px;
        grid-column: 4 / span 4;
        grid-row: 7/7;
        display: block;
    }

    #field-nombre_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.nombre_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.nombre_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.nombre_alumno_form_group>label.active+input#field-nombre_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.apellido1_alumno_form_group {
        margin-top: 2px;
        grid-column: 8 / span 4;
        grid-row: 7/7;
        display: block;
    }

    #field-apellido1_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido1_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.apellido1_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido1_alumno_form_group>label.active+input#field-apellido1_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.apellido2_alumno_form_group {
        margin-top: 2px;
        grid-column: 12 / span 4;
        grid-row: 7/7;
        display: block;
    }

    #field-apellido2_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido2_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.apellido2_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.apellido2_alumno_form_group>label.active+input#field-apellido2_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }


    #crudForm>div>div.card-body>div.fecha_nacimiento_form_group {
        margin-top: 2px;
        grid-column: 16 / span 4;
        grid-row: 7/7;
        display: block;
    }

    #field-fecha_nacimiento {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.fecha_nacimiento_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.fecha_nacimiento_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.fecha_nacimiento_form_group>label.active+input#field-fecha_nacimiento {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.direccion_alumno_form_group {
        margin-top: 2px;
        grid-column: 1 / span 4;
        grid-row: 8/8;
        display: block;
    }

    #field-direccion_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.direccion_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.direccion_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.direccion_alumno_form_group>label.active+input#field-direccion_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.poblacion_alumno_form_group {
        margin-top: 2px;
        grid-column: 5 / span 4;
        grid-row: 8/8;
        display: block;
    }

    #field-poblacion_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.poblacion_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.poblacion_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.poblacion_alumno_form_group>label.active+input#field-poblacion_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.provincia_alumno_form_group {
        margin-top: 2px;
        grid-column: 9 / span 4;
        grid-row: 8/8;
        display: block;
    }

    #field-provincia_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.provincia_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.provincia_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.provincia_alumno_form_group>label.active+input#field-provincia_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.codigo_postal_alumno_form_group {
        margin-top: 2px;
        grid-column: 13 / span 2;
        grid-row: 8/8;
        display: block;
    }

    #field-codigo_postal_alumno {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.codigo_postal_alumno_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.codigo_postal_alumno_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.codigo_postal_alumno_form_group>label.active+input#field-codigo_postal_alumno {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.curso_escolar_form_group {
        margin-top: 2px;
        grid-column: 15 / span 2;
        grid-row: 8/8;
        display: block;
    }

    #field-curso_escolar {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.curso_escolar_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.curso_escolar_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.curso_escolar_form_group>label.active+input#field-curso_escolar {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.escuela_form_group {
        margin-top: 2px;
        grid-column: 17 / span 5;
        grid-row: 8/8;
        display: block;
    }

    #field-escuela {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.escuela_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.escuela_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;
    }

    #crudForm>div>div.card-body>div.md-form.escuela_form_group>label.active+input#field-escuela {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    /*GRUP ON REALITZA LA INSCRIPCIÓ */
    #crudForm>div>div.card-body>p.subtitulo3 {
        grid-column: 1 / span 20;
        grid-row: 9/9;
        display: block;
    }

    /* #crudForm>div>div.card-body>div.ultimo_curso_form_group {
        margin-top:-1px;
        grid-column: 1 / span 1;
        grid-row: 10/10;
        display: block;
    } */
    #crudForm>div>div.card-body>div.texto_ultimo_curso_form_group {
        margin-top: 2px;
        grid-column: 1 / span 3;
        grid-row: 10/10;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_titulo_curso_form_group {
        margin-top: -2px;
        grid-column: 1 / span 3;
        grid-row: 10/10;
        display: block;
    }

    #crudForm>div>div.card-body>div.md-form.texto_titulo_curso_form_group>label {
        margin-top: -17px;
        /* margin-left:10px; */
        font-size: 12.8px;
    }

    /* #crudForm>div>div.card-body>div.id_curso_form_group {
        grid-column: 2 / span 2;
        grid-row: 10/10;
        display: block;
    } */

    #field_id_curso_chosen {
        width: 120px !important;
    }

    /* #crudForm > div > div.card-body > div.md-form.id_curso_form_group > label{
        margin-top:-38px;
        margin-left:10px;
        font-size: 12.8px;
    } */

    /* #crudForm>div>div.card-body>div.texto_id_actividad_form_group {
        margin-top:-1px;
        left: .9rem;
        grid-column: 5 / span 1;
        grid-row: 10/10;
        display: block;
    } */
    #crudForm>div>div.card-body>div.id_actividad_form_group {
        margin-top:50px;
        grid-column: 5 / span 8;
        grid-row: 10/10;
        display: block;
    }

    #field_id_actividad_chosen {
        width: 200px !important;
    }

    #field_id_actividad_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.md-form.id_actividad_form_group>label {
        margin-top: -68px;
        margin-left: 10px;
        font-size: 12.8px;
    }

    /* #crudForm>div>div.card-body>div.texto_id_trimestre_form_group {
        margin-top:-1px;
        left: .5rem;
        grid-column: 12 / span 1;
        grid-row: 10/10;
        display: block;
    } */
    #crudForm>div>div.card-body>div.id_trimestre_form_group {
        margin-top:50px;
        grid-column: 10 / span 8;
        grid-row: 10/10;
        display: block;
    }

    #field_id_trimestre_chosen {
        width: 140px !important;
    }

    #field_id_trimestre_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.md-form.id_trimestre_form_group>label {
        margin-top: -68px;
        margin-left: 10px;
        font-size: 12.8px;
    }



    /* precio */
    /* Sin valor */

   

    #crudForm>div>div.card-body>div.precio_form_group {
        margin-top: 2px;
        grid-column: 15 / span 2;
        grid-row: 10/10;
        display: block;
    }

    #field-precio {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.precio_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.precio_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.precio_form_group>label.active+input#field-precio {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    /* fin precio */




    #crudForm>div>div.card-body>div.texto_status_pagado_form_group {
        margin-top: 2px;
        grid-column: 18 / span 1;
        grid-row: 10/10;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_titulo_pagado_form_group {
        grid-column: 18 / span 1;
        grid-row: 10/10;
        display: block;
    }

    #crudForm>div>div.card-body>div.md-form.texto_titulo_pagado_form_group>label {
        margin-top: -30px;
        font-size: 12.8px;
    }


    #field_pagado_chosen {
        padding-top: 12px;
    }



    #crudForm>div>div.card-body>div.md-form.pagado_form_group>label {
        margin-top: -18px;
        font-size: 12.8px;
    }


    #crudForm>div>div.card-body>div.md-form.texto_pagado_form_group>label {
        margin-top: -26px;
        font-size: 12.8px;
    }

    #field_pagado_chosen {
        width: 100px !important;
    }

    #field_pagado_chosen>a {
        margin-top: 12px;
        margin-left: -10px
    }



    /* MÉS DADES */
    #crudForm>div>div.card-body>p.subtitulo4 {
        grid-column: 1 / span 6;
        grid-row: 11/11;
        display: block;
    }

    /* becas */
    #crudForm>div>div.card-body>div.id_becas_form_group {
        grid-column: 10 / span 12;
        grid-row: 12/12;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_becas_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 12/12;
        display: block;
    }

    #field_id_becas_chosen {
        width: 90px !important;
        margin-top: 50px !important;
    }

    #field_id_becas_chosen>a {
        margin-top: -38px;
    }


    /* becas_desde */
    #crudForm>div>div.card-body>div.becas_desde_form_group {
        margin-top: 2px;
        grid-column: 13 / span 4;
        grid-row: 12/12;
        display: block;
    }

    #field-becas_desde {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.becas_desde_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.becas_desde_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.becas_desde_form_group>label.active+input#field-becas_desde {
        padding-bottom: 0px;
        margin-top: 20px;
    }



    /* becas_hasta */
    #crudForm>div>div.card-body>div.becas_hasta_form_group {
        margin-top: 2px;
        grid-column: 18 / span 3;
        grid-row: 12/12;
        display: block;
    }

    #field-becas_hasta {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.becas_hasta_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.becas_hasta_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.becas_hasta_form_group>label.active+input#field-becas_hasta {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    /* monitora */
    #crudForm>div>div.card-body>div.id_monitora_form_group {
        grid-column: 10 / span 12;
        grid-row: 13/13;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_monitora_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 13/13;
        display: block;
    }

    #field_id_monitora_chosen {
        width: 90px !important;
        margin-top: 50px !important;
    }

    #field_id_monitora_chosen>a {
        margin-top: -38px;
    }




    /* monitora_desde */
    #crudForm>div>div.card-body>div.monitora_desde_form_group {
        margin-top: 2px;
        grid-column: 13 / span 4;
        grid-row: 13/13;
        display: block;
    }

    #field-monitora_desde {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.monitora_desde_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.monitora_desde_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.monitora_desde_form_group>label.active+input#field-monitora_desde {
        padding-bottom: 0px;
        margin-top: 20px;
    }


    /* monitora_hasta */
    #crudForm>div>div.card-body>div.monitora_hasta_form_group {
        margin-top: 2px;
        grid-column: 18 / span 3;
        grid-row: 13/13;
        display: block;
    }

    #field-monitora_hasta {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.monitora_hasta_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.monitora_hasta_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.monitora_hasta_form_group>label.active+input#field-monitora_hasta {
        padding-bottom: 0px;
        margin-top: 20px;
    }



    #crudForm>div>div.card-body>div.texto_id_participacion_anterior_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 14/14;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_participacion_anterior_form_group {
        grid-column: 10 / span 12;
        grid-row: 14/14;
        display: block;
    }

    #field_id_participacion_anterior_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_participacion_anterior_chosen>a {
        margin-top: -38px;
    }


    #crudForm>div>div.card-body>div.md-form.texto_id_hermanos_actividad_form_group {
        margin-top: 8px;
        grid-column: 1 /span 12;
        grid-row: 15/15;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_hermanos_actividad_form_group {
        grid-column: 10 / span 12;
        grid-row: 15/15;
        display: block;
    }

    #field_id_hermanos_actividad_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_hermanos_actividad_chosen>a {
        margin-top: -38px;
    }

    /* hermanos_actividad */
    #crudForm>div>div.card-body>div.hermanos_actividad_form_group {
        margin-top: 2px;
        grid-column: 13 / span 3;
        grid-row: 15/15;
        display: block;
    }

    #field-hermanos_actividad {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.hermanos_actividad_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.hermanos_actividad_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.hermanos_actividad_form_group>label.active+input#field-hermanos_actividad {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    /* hermanos_num */
    #crudForm>div>div.card-body>div.hermano_num_form_group {
        margin-top: 2px;
        grid-column: 16 / span 3;
        grid-row: 15/15;
        display: block;
    }

    #field-hermano_num {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.hermano_num_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.hermano_num_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.hermano_num_form_group>label.active+input#field-hermano_num {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.texto_id_tarjeta_t12_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 16/16;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_tarjeta_t12_form_group {
        grid-column: 10 / span 12;
        grid-row: 16/16;
        display: block;
    }

    #field_id_tarjeta_t12_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_tarjeta_t12_chosen>a {
        margin-top: -38px;
    }


    #crudForm>div>div.card-body>div.texto_id_asistencia_atencion_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 17/17;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_asistencia_atencion_form_group {
        grid-column: 10 / span 3;
        grid-row: 17/17;
        display: block;
    }

    #field_id_asistencia_atencion_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_asistencia_atencion_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.asistencia_atencion_form_group {
        margin-top: 2px;
        grid-column: 14 / span 12;
        grid-row: 17/17;
        display: block;
    }

    #field-asistencia_atencion {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.asistencia_atencion_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.asistencia_atencion_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.asistencia_atencion_form_group>label.active+input#field-asistencia_atencion {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.texto_id_derivado_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 18/18;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_derivado_form_group {
        grid-column: 10 / span 12;
        grid-row: 18/18;
        display: block;
    }

    #field_id_derivado_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_derivado_chosen>a {
        margin-top: -38px;
    }




    #crudForm>div>div.card-body>div.derivado_form_group {
        margin-top: 2px;
        grid-column: 14 / span 12;
        grid-row: 18/18;
        display: block;
    }

    #field-derivado {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.derivado_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.derivado_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.derivado_form_group>label.active+input#field-derivado {
        padding-bottom: 0px;
        margin-top: 20px;
    }





    /* FITXA DE SALUT */
    #crudForm>div>div.card-body>p.subtitulo5 {
        grid-column: 1 / span 20;
        grid-row: 19/19;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_alergia_form_group {
        grid-column: 10 / span 12;
        grid-row: 20/20;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_alergia_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 20/20;
        display: block;
    }

    #field_id_alergia_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_alergia_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.alergia_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 20/20;
        display: block;
    }

    #field-alergia {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.alergia_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.alergia_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.alergia_form_group>label.active+input#field-alergia {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.id_respiratoria_form_group {
        grid-column: 10 / span 12;
        grid-row: 21/21;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_respiratoria_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 21/21;
        display: block;
    }

    #field_id_respiratoria_chosen {
        width: 90px !important;   
         margin-top: 50px !important;

    }

    #field_id_respiratoria_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.respiratoria_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 21/21;
        display: block;
    }

    #field-respiratoria {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.respiratoria_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.respiratoria_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.respiratoria_form_group>label.active+input#field-respiratoria {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.id_vascular_form_group {
        grid-column: 10 / span 12;
        grid-row: 22/22;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_vascular_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 22/22;
        display: block;
    }

    #field_id_vascular_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_vascular_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.vascular_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 22/22;
        display: block;
    }

    #field-vascular {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.vascular_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.vascular_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.vascular_form_group>label.active+input#field-vascular {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.id_cronica_form_group {
        grid-column: 10 / span 12;
        grid-row: 23/23;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_cronica_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 23/23;
        display: block;
    }

    #field_id_cronica_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_cronica_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.cronica_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 23/23;
        display: block;
    }

    #field-cronica {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.cronica_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.cronica_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.cronica_form_group>label.active+input#field-cronica {
        padding-bottom: 0px;
        margin-top: 20px;
    }


    #crudForm>div>div.card-body>div.id_hemorragia_form_group {
        grid-column: 10 / span 12;
        grid-row: 24/24;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_hemorragia_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 24/24;
        display: block;
    }

    #field_id_hemorragia_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_hemorragia_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.hemorragia_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 24/24;
        display: block;
    }

    #field-hemorragia {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.hemorragia_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.hemorragia_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.hemorragia_form_group>label.active+input#field-hemorragia {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.id_medicacion_form_group {
        grid-column: 10 / span 12;
        grid-row: 25/25;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_medicacion_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 25/25;
        display: block;
    }

    #field_id_medicacion_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_medicacion_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.medicacion_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 25/25;
        display: block;
    }

    #field-medicacion {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.medicacion_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.medicacion_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.medicacion_form_group>label.active+input#field-medicacion {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.id_nadar_form_group {
        grid-column: 10 / span 12;
        grid-row: 26/26;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_nadar_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 26/26;
        display: block;
    }

    #field_id_nadar_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_nadar_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.nadar_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 26/26;
        display: block;
    }

    #field-nadar {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.nadar_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.nadar_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.nadar_form_group>label.active+input#field-nadar {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.id_nee_form_group {
        grid-column: 10 / span 12;
        grid-row: 27/27;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_nee_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 27/27;
        display: block;
    }

    #field_id_nee_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_nee_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.nee_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 27/27;
        display: block;
    }

    #field-nee {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.nee_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.nee_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.nee_form_group>label.active+input#field-nee {
        padding-bottom: 0px;
        margin-top: 20px;
    }






    /* DOCUMENTACIÓ A ADJUNTAR */
    #crudForm>div>div.card-body>p.subtitulo6 {
        grid-column: 1 / span 20;
        grid-row: 28/28;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_presenta_dni_tutor_form_group {
        grid-column: 10 / span 12;
        grid-row: 29/29;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_presenta_dni_tutor_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 29/29;
        display: block;
    }

    #field_id_presenta_dni_tutor_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_presenta_dni_tutor_chosen>a {
        margin-top: -38px;
    }



    #crudForm>div>div.card-body>div.id_presenta_dni_alumni_form_group {
        grid-column: 10 / span 12;
        grid-row: 30/30;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_presenta_dni_alumni_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 30/30;
        display: block;
    }

    #field_id_presenta_dni_alumni_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_presenta_dni_alumni_chosen>a {
        margin-top: -38px;
    }


    #crudForm>div>div.card-body>div.id_presenta_libro_vacunas_form_group {
        grid-column: 10 / span 12;
        grid-row: 31/31;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_presenta_libro_vacunas_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 31/31;
        display: block;
    }

    #field_id_presenta_libro_vacunas_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_presenta_libro_vacunas_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_presenta_tarjeta_sanitaria_form_group {
        grid-column: 10 / span 12;
        grid-row: 32/32;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_presenta_tarjeta_sanitaria_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 32/32;
        display: block;
    }

    #field_id_presenta_tarjeta_sanitaria_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_presenta_tarjeta_sanitaria_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_presenta_otras_form_group {
        grid-column: 10 / span 12;
        grid-row: 33/33;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_presenta_otras_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 33/33;
        display: block;
    }

    #field_id_presenta_otras_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_presenta_otras_chosen>a {
        margin-top: -38px;

    }

    #crudForm>div>div.card-body>div.presenta_otras_form_group {
        margin-top: 2px;
        grid-column: 13 / span 12;
        grid-row: 33/33;
        display: block;
    }

    #field-presenta_otras {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.presenta_otras_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.presenta_otras_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.presenta_otras_form_group>label.active+input#field-presenta_otras {
        padding-bottom: 0px;
        margin-top: 20px;
    }






    /* COMUNICACIONS */
    #crudForm>div>div.card-body>p.subtitulo7 {
        grid-column: 1 / span 20;
        grid-row: 35/35;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_comunicaciones_form_group {
        grid-column: 12 / span 12;
        grid-row: 36/36;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_comunicaciones_form_group {
        margin-top: 8px;
        grid-column: 1 / span 12;
        grid-row: 36/36;
        display: block;
    }

    #field_id_comunicaciones_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_comunicaciones_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_otras_comunicaciones_form_group {
        grid-column: 12 / span 12;
        grid-row: 37/37;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_otras_comunicaciones_form_group {
        margin-top: 8px;
        grid-column: 1 / span 15;
        grid-row: 37/37;
        display: block;
    }

    #field_id_otras_comunicaciones_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_otras_comunicaciones_chosen>a {
        margin-top: -38px;
    }




    /* AUTORITZACIONS ENTRADES I SORTIDES */
    #crudForm>div>div.card-body>p.subtitulo8 {
        grid-column: 1 / span 20;
        grid-row: 38/38;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_aut_acompanar_form_group {
        grid-column: 14 / span 11;
        grid-row: 39/39;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_aut_acompanar_form_group {
        margin-top: 8px;
        grid-column: 1 / span 18;
        grid-row: 39/39;
        display: block;
    }

    #field_id_aut_acompanar_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_aut_acompanar_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_aut_ir_solo_form_group {
        grid-column: 14 / span 12;
        grid-row: 40/40;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_aut_ir_solo_form_group {
        margin-top: 8px;
        grid-column: 1 / span 10;
        grid-row: 40/40;
        display: block;
    }

    #field_id_aut_ir_solo_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_aut_ir_solo_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_aut_recogida_form_group {
        grid-column: 14 / span 12;
        grid-row: 41/41;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_aut_recogida_form_group {
        margin-top: 8px;
        grid-column: 1 / span 18;
        grid-row: 41/41;
        display: block;
    }

    #field_id_aut_recogida_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_aut_recogida_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.aut_nombre_form_group {
        grid-column: 1 / span 4;
        grid-row: 42/42;
        display: block;
    }

    #field-aut_nombre {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.aut_nombre_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.aut_nombre_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.aut_nombre_form_group>label.active+input#field-aut_nombre {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.aut_apellido1_form_group {
        grid-column: 5 / span 4;
        grid-row: 42/42;
        display: block;
    }

    #field-aut_apellido1 {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.aut_apellido1_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.aut_apellido1_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.aut_apellido1_form_group>label.active+input#field-aut_apellido1 {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.aut_apellido2_form_group {
        grid-column: 9 / span 4;
        grid-row: 42/42;
        display: block;
    }

    #field-aut_apellido2 {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.aut_apellido2_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.aut_apellido2_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.aut_apellido2_form_group>label.active+input#field-aut_apellido2 {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.aut_dni_form_group {
        grid-column: 13 / span 2;
        grid-row: 42/42;
        display: block;
    }

    #field-aut_dni {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.aut_dni_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.aut_dni_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.aut_dni_form_group>label.active+input#field-aut_dni {
        padding-bottom: 0px;
        margin-top: 20px;
    }

    #crudForm>div>div.card-body>div.aut_parentesco_form_group {
        grid-column: 15 / span 6;
        grid-row: 42/42;
        display: block;
    }

    #field-aut_parentesco {
        padding-bottom: 20px;
    }

    #crudForm>div>div.card-body>div.md-form.aut_parentesco_form_group>label {
        padding-bottom: 22px;
    }

    /* CON VALOR */
    #crudForm>div>div.card-body>div.md-form.aut_parentesco_form_group>label.active {
        margin-bottom: 0px;
        margin-top: 20px;
        padding-bottom: 0px;

    }

    #crudForm>div>div.card-body>div.md-form.aut_parentesco_form_group>label.active+input#field-aut_parentesco {
        padding-bottom: 0px;
        margin-top: 20px;
    }




    /* AUTORITZACIONS LEGALS */
    #crudForm>div>div.card-body>p.subtitulo9 {
        grid-column: 1 / span 20;
        grid-row: 43/43;
        display: block;
    }

    #crudForm>div>div.card-body>div.id_decisiones_urgentes_form_group {
        grid-column: 19 / span 12;
        grid-row: 44/44;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_decisiones_urgentes_form_group {
        margin-top: 8px;
        grid-column: 1 / span 18;
        grid-row: 44/44;
        display: block;
    }

    #field_id_decisiones_urgentes_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_decisiones_urgentes_chosen>a {
        margin-top: -38px;
    }


    #crudForm>div>div.card-body>div.id_imagen_en_actividades_form_group {
        grid-column: 19 / span 12;
        grid-row: 49/49;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_imagen_en_actividades_form_group {
        margin-top: 8px;
        grid-column: 1 / span 18;
        grid-row: 49/49;
        display: block;
    }

    #field_id_imagen_en_actividades_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_imagen_en_actividades_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_imagen_divulgacion_form_group {
        grid-column: 19 / span 12;
        grid-row: 55/55;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_imagen_divulgacion_form_group {
        margin-top: 8px;
        grid-column: 1 / span 18;
        grid-row: 55/55;
        display: block;
    }

    #field_id_imagen_divulgacion_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_imagen_divulgacion_chosen>a {
        margin-top: -38px;
    }

    #crudForm>div>div.card-body>div.id_lectura_informacion_form_group {
        grid-column: 19 / span 12;
        grid-row: 61/61;
        display: block;
    }

    #crudForm>div>div.card-body>div.texto_id_lectura_informacion_form_group {
        margin-top: 8px;
        grid-column: 1 / span 18;
        grid-row: 61/61;
        display: block;
    }

    #field_id_lectura_informacion_chosen {
        width: 90px !important;
        margin-top: 50px !important;

    }

    #field_id_lectura_informacion_chosen>a {
        margin-top: -38px;
    }




    /* mensaje de error cuando se muestra */
    #crudForm div.form-group {
        grid-column: 1 / span 18;
        grid-row: 62 / 62;
    }
</style>

<!-- <script src="<?php echo base_url() ?>js/tablasGrocery2.js" ?>></script> -->
<script src="<?php echo base_url() ?>js/tablasGrocery.js" ?></script>
<script src="<?php echo base_url() ?>js/maba.js"></script>

<script>

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