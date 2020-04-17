</body>

<!-- SCRIPTS -->

    

    <!-- JQuery -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script> -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/mdb.js"></script>

    <script>
        $( document ).ready(function() {
        // SideNav Button Initialization
        $(".button-collapse").sideNav();
        // SideNav Scrollbar Initialization
        var sideNavScrollbar = document.querySelector('.custom-scrollbar');
        //Ps.initialize(sideNavScrollbar);

        

        $('.chosen-container.chosen-container-single').css('width','80px')  
         $('.chosen-container.chosen-container-single').css('margin-top','0px')  
         $('.chosen-container.chosen-container-single').css('margin-left','10px')  
         $('.chosen-container.chosen-container-single').css('margin-right','10px')  
         $('.pagination.pagination-circle.pg-blue.mb-0').parent().css('padding-top','0px') 
         $('.pagination.pagination-circle.pg-blue.mb-0').css('margin-top','-10px') 
         $('.page-number-input').css('margin','0px')
         $('.page-number-input').css('padding','0px')
         /* $('select.chosen-select.per_page').addClass('mdb-select')
          $('.mdb-select').material_select();   */

    });

        //$('select.per_page').parent().children().text('')
    </script>
</html>