<div class="col-lg-4">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-chart-bar""></i>
                  Disponibilidad del Personal</div>
                <div class=" card-body">
                <table table class="table table-bordered text-center" width="100%" cellspacing="0">
                    <tr>
                        <td><b>Personal</b></td>
                        <td><b>Estado</b></td>
                    </tr>

                    <?php
                    $displayStaffQuery = "SELECT username,status FROM tbl_staff";

                    if ($result = $sqlconnection->query($displayStaffQuery)) {
                        while ($staff = $result->fetch_array(MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<td>{$staff['username']}</td>";

                            if ($staff['status'] == "Online") {
                                echo "<td><span class=\"badge badge-success\">Activo</span></td>";
                            }

                            if ($staff['status'] == "Offline") {
                                echo "<td><span class=\"badge badge-secondary\">Inactivo</span></td>";
                            }

                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
        </div>
    </div>
</div>