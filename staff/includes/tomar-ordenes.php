<div class="row">
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-utensils"></i>
                Tomar Ordenes
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                    <tr>
                        <?php
                        $menuQuery = "SELECT * FROM tbl_menu";

                        if ($menuResult = $sqlconnection->query($menuQuery)) {
                            $counter = 0;
                            while ($menuRow = $menuResult->fetch_array(MYSQLI_ASSOC)) {
                                if ($counter >= 3) {
                                    echo "</tr>";
                                    $counter = 0;
                                }

                                if ($counter == 0) {
                                    echo "<tr>";
                                }
                        ?>
                                <td><button style="margin-bottom:4px;white-space: normal;" class="btn btn-primary" onclick="displayItem(<?php echo $menuRow['menuID'] ?>)"><?php echo $menuRow['menuName'] ?></button></td>
                        <?php

                                $counter++;
                            }
                        }
                        ?>
                    </tr>
                </table>
                <table id="tblItem" class="table table-bordered text-center" width="100%" cellspacing="0"></table>

                <div id="qtypanel" hidden="">
                    <p>Cantidad : <input id="qty" required type="number" min="1" max="50" name="qty" value="1" /><br/></p>
                    <p>Mesa: <input type='number' id="mesa" required min='1' max='50' name='mesa' width='5px' value='' /><br/></p>
                    <p>Observaciones: <input type='text' id="observaciones" name='observaciones' width='5px' value='' /><br/></p>
                    <p><button class="btn btn-info" onclick="insertItem()">Enviar</button></p>
                    <br/><br/>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i>
                Configuración de la orden
            </div>
            <div class="card-body">
                <form action="insertorder.php" method="POST">
                    <table id="tblOrderList" class="table table-bordered text-center" width="100%" cellspacing="0">
                        <tr>
                            <th>Mesa</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cant</th>
                            <th>Obser.</th>
                            <th>Total</th>
                            
                        </tr>
                    </table>
                    <input class="btn btn-success" type="submit" name="sentorder" value="Enviar">
                </form>
            </div>
        </div>
        <div class="card-footer small text-muted"><i>No mezcles mesas!!</i></div>
    </div>
</div>