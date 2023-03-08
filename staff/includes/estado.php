<div class="col-lg-3">
    <div class="card mb-3 text-center">
        <div class="card-header">
            <i class="fas fa-chart-bar""></i>
                  Estado</div>
                <div class=" card-body">
                Hola , <b><?php echo $_SESSION['username'] ?></b>
                <hr>
                Cargo : <b><?php echo ucfirst($_SESSION['user_role']) ?></b>
                <hr>
                <form action="statuschange.php" method="POST">
                    <input type="hidden" id="staffid" name="staffid" value=" <?php echo $_SESSION['uid']; ?>" />
                    <?php if (getStatus() == 'Online') echo "<input type='submit' class='btn btn-success myBtn' name='btnStatus' value='Online'>";
                    else echo "<input type='submit' class='btn btn-danger myBtn' name='btnStatus' value='Offline'>" ?>
                </form>
        </div>
    </div>
</div>