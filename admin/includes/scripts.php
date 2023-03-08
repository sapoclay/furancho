<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        refreshTableOrder();
    });

    function refreshTableOrder() {
        $("#tblBodyCurrentOrder").load("displayorder.php?cmd=display");
    }

    //refresh order current list every 3 secs
    setInterval(function() {
        refreshTableOrder();
    }, 3000);
</script>