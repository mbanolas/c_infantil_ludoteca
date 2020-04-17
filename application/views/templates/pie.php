</body>

<!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>
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
        // Ps.initialize(sideNavScrollbar);
    });
    </script>
    
</html>