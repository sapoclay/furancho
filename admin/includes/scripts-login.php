<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<script type="text/javascript">
    $('#loginform').submit(function() {
        $.ajax({
            type: "POST",
            url: 'process.php',
            data: {
                username: $("#inputUsername").val(),
                password: $("#inputPassword").val()
            },
            success: function(data) {
                if (data === 'correct') {
                    window.location.replace('index.php');
                } else {
                    $("#warningbox").html("<div class='alert alert-danger' role='alert'>" + data + "!</div>");
                }
            }
        });
        return false;
    });
</script>