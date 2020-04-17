<style>
.container{
    margin-top:90px;
    width:30%;
}
</style>

<div class="container">
    <!-- Material form subscription -->
    <div class="card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Tickets entre fechas</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5">

            <!-- Form -->
            <?php echo form_open('ventas/tienda',array('class' => 'text-center', 'style' => 'color: #757575;')); ?>

                <p>Seleccione fechas para filtrar tickets.</p>

                <p>
                    <a href="" target="_blank">Tickets tienda</a>
                </p>
                
                <!-- Fecha inicio -->
                <div class="md-form">
                    <input placeholder="Seleccionar fecha inicio" type="text" id="fecha-inicio"  name="fecha-inicio" class="form-control datepicker">
                    <label for="fecha-inicio">Fecha inicio</label>
                </div>

                <!-- Fecha final -->
                <div class="md-form">
                    <input placeholder="Seleccionar fecha final" type="text" id="fecha-final" name="fecha-final" class="form-control datepicker">
                    <label for="fecha-inicio">Fecha final</label>
                </div>
                <!-- Material unchecked -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="fechas_todas" checked name="fechas_todas">
                    <label class="form-check-label" for="fechas_todas">Todos los tickets</label>
                </div>
                <!-- Sign in button -->
                <button class="btn btn-rounded aqua-gradient waves-effect waves-light" type="submit">Ir a tabla tickets</button>
            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form subscription -->
</div>


    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/mdb.js"></script>
    <!-- maba JavaScript -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/maba.js"></script>


<script>
$(document).ready(function(){

    // Data Picker Initialization
    // es esta definido en maba.js
    $('.datepicker').pickadate(es)

    $('#fecha-inicio, #fecha-final').change(function(){
        $('#fechas_todas').removeAttr('checked')
    })
       
   })
</script>