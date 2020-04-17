<style>
    .jumbotron {
        margin-top: 100px;
        margin-left: 80px;
        margin-right: 80px;
    }
</style>



<div class="jumbotron">
    <h2 class="display-5">Seleccionar datos para exportar (documento Excel)</h2>
    <div class="container-fluid">
        <?php echo form_open('exportExcel/excelInscripciones'); ?>
        <div class="row">
            <!-- Content here -->
            <?php $medio = count($campos) / 2;
            $campos1 = array();
            $campos2 = array();
            foreach ($campos as $k => $v) {
                if ($k < $medio) $campos1[] = $v;
                else $campos2[] = $v;
            }
            ?>
            <div class="col-sm">
                <!-- Material checked -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="todos" checked>
                    <label class="form-check-label" for="todos"><b>Seleccionar/Deseleccionar Tots</b></label>
                </div>

                <?php foreach ($campos1 as $k => $v) { ?>
                    <!-- Material checked -->
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input campo" id="<?php echo $v ?>" name="<?php echo $v ?>" checked>

                        <label class="form-check-label" for="<?php echo $v ?>"><?php echo isset($display[$v]) ? $display[$v] : $v ?></label>
                    </div>

                <?php } ?>
            </div>
            <div class="col-sm">
                <div class="form-check">
                    <!-- <input type="checkbox" class="form-check-input" id="<?php echo $v ?>" checked> -->
                    <label class="form-check-label" for="materialChecked2"></label>
                </div>
                <?php foreach ($campos2 as $k => $v) { ?>
                    <!-- Material checked -->
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input campo" id="<?php echo $v ?>" name="<?php echo $v ?>" checked>
                        <label class="form-check-label" for="<?php echo $v ?>"><?php echo isset($display[$v]) ? $display[$v] : $v ?></label>
                    </div>

                <?php } ?>
            </div>
        </div>
        <br>
        <div class="row">
            <button id="exportarExcel" type="submit" class="btn btn-primary waves-effect waves-light">Exportar Excel</button>
            <a class="btn btn-warning cancel-button waves-effect waves-light" type="button" id="cancel-button" href="<?php echo base_url() ?>index.php/inscripciones/inscripciones">
                <i class="fa fa-warning"></i>
                Cancel·lar </a>
        </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('#todos').click(function() {
            if ($(this).is(':checked')) {
                console.log('checked')
                $('.campo').prop('checked', true)
            } else {
                console.log('NO checked')
                $('.campo').prop('checked', false)
            }
        })
    })
</script>