<?php


// for generating the table row
function thGen($table_name, $action = 'false')
{
    global $conn;
    global $database;
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ";
    $th_result = mysqli_query($conn, $th_query);
    echo "<th>S.NO</th>";
    while ($th_row = mysqli_fetch_array($th_result)) {
        if ($th_row['COLUMN_NAME'] != 'id')
            echo "<th >" .  $th_row['COLUMN_NAME'] . "</th>";
    }
    if ($action == 'true') {
        echo "<th class='text-center'> Action  </th>";
    }
}


// it is used for generating the column name
function tdGen($table_name,  $edit_url = '', $delete_url = '', $show_url = '', $condition = 1, $limit = 10)
{
    global $conn;
    global $database;
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);

    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $sno = $start_from + 1;
    $td_query = "SELECT * FROM `$table_name` WHERE $condition ";
    $td_result = mysqli_query($conn, $td_query);
    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];

    while ($td_row = mysqli_fetch_array($td_result)) {

        echo "<tr>";
        echo "<td>" . $sno++ . "</td>";
        foreach ($th_result as $th_row) {
            if ($th_row['COLUMN_NAME'] != $id)
                echo "<td>" . $td_row[$th_row['COLUMN_NAME']] . "</td>";
        }
        echo '<td class="text-center" >';
        if ($show_url != '') {
            echo '<button type="button" class="btn btn-primary btn-sm  fas fa-eye " data-bs-toggle="modal" data-bs-target="#staticBackdrop' . $td_row[$id] . '">
              show
        </button>';
            data_show($table_name, $show_url, $id . '=' . $td_row[$id]);
        }
        if ($edit_url != '') {
            echo ' <a href="' . $edit_url . '?edit=' . $td_row[$id] . '"  class="btn btn-warning btn-sm fas fa-edit "> edit</a>';
        }
        if ($delete_url != '') {
            echo ' <a href="' . $delete_url . '?delete=' . $td_row[$id] . '"  class="btn btn-danger btn-sm fas fa-trash "> delete</a>';
        }
        echo '</td>';
        echo "</tr>";
    }
}

// for special function for ashapress
function tdGenPrint($table_name,  $edit_url = '', $delete_url = '', $show_url = '', $condition = 1, $limit = 10)
{

    global $conn;
    global $database;
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);

    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $sno = $start_from + 1;
    $td_query = "SELECT * FROM `$table_name` WHERE $condition ";
    $td_result = mysqli_query($conn, $td_query);
    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];

    while ($td_row = mysqli_fetch_array($td_result)) {

        echo "<tr>";
        echo "<td>" . $sno++ . "</td>";
        foreach ($th_result as $th_row) {
            if ($th_row['COLUMN_NAME'] != $id)
                echo "<td>" . $td_row[$th_row['COLUMN_NAME']] . "</td>";
        }
        echo '<td class="text-center" >';
        if ($show_url != '') {
            echo ' <a target="blank" href="paymentDetails?b_id=' . $td_row[$id] . '&c_id=' . $td_row['clients_id'] . '&reg=' . $td_row['regular'] . '"  class="btn btn-secondary btn-sm fas fa-rupee-sign "> Pay</a>';
        }
        if ($show_url != '') {
            echo ' <a target="blank" href="printBillTelco?id=' . $td_row[$id] . '&cid=' . $td_row['clients_id'] . '&reg=' . $td_row['regular'] . '"  class="btn btn-warning btn-sm fas fa-print "> Telco </a>';
        }
        if ($edit_url != '') {
            echo ' <a target="blank" href="printbll_new?duplicateBill=Y&id=' . $td_row[$id] . '&cid=' . $td_row['clients_id'] . '&reg=' . $td_row['regular'] . '"  class="btn btn-primary btn-sm fas fa-print "> Duplicate </a>';
        }
        if ($delete_url != '') {
            echo ' <a target="blank" href="printbll_new?id=' . $td_row[$id] . '&cid=' . $td_row['clients_id'] . '&reg=' . $td_row['regular'] . '"  class="btn btn-success btn-sm fas fa-print "> Bill </a>';
        }
        echo '</td>';
        echo "</tr>";
    }
}



/* this function is used for generating the table row and column according to the requirement
    if you want to display one 1 or 4 or 10 and any more simply pass all the table row into the table 
    th_array and into the td_array simply pass the table column name
*/
function tableGen($table_name, $th_array, $td_array, $id = 'id', $action = 'false', $edit_url = '', $delete_url = '', $show_url = '', $condition = 1)
{
    global $conn;
    $sno = 1;
    $table_query = "SELECT  $id," . implode(',', $td_array) . " FROM `$table_name` WHERE $condition ";
    $table_result = mysqli_query($conn, $table_query);
    // this is the id of the table for goes into the next page
    $n = 0;
    // for table header generating
    echo "<thead> <tr>";
    echo "<th> S.NO</th>";
    foreach ($th_array as $th) {
        echo "<th>" . $th . "</th>";
    }
    if ($action == 'true') {
        echo "<th> Action </th>";
    }
    echo "</tr></thead>";
    // for table header generating end

    echo "<tbody>"; //for generating table body
    while ($table_row = mysqli_fetch_array($table_result)) {
        echo "<tr>";
        echo "<td>" . $sno++ . "</td>";
        foreach ($td_array as $td) {
            echo "<td>" . $table_row[$td] . "</td>";
        }
        echo "<td>";
        if ($show_url != '') {
            echo '<button type="button" class="btn btn-primary btn-sm  fas fa-eye " data-bs-toggle="modal" data-bs-target="#staticBackdrop' . $table_row[$id] . '">
              show
        </button>';
            data_show($table_name, $show_url, $id . '=' . $table_row[$id]);
        }
        if ($edit_url != '') {
            echo ' <a href="' . $edit_url . '?edit=' . $table_row[$id] . '"  class="btn btn-warning btn-sm fas fa-edit "> edit</a>';
        }
        if ($delete_url != '') {
            echo ' <a href="' . $delete_url . '?delete=' . $table_row[$id] . '"  class="btn btn-danger btn-sm fas fa-trash "> delete</a>';
        }
        echo '</td>';
        echo "</tr>";
    }
    echo "</tbody>"; //table body end

}




function data_show($table_name, $modal_title = 'modal', $condition = 1)
{

    global $conn;
    global $database;
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);
    $total_row = mysqli_num_rows($th_result);

    $td_query = "SELECT * FROM `$table_name` WHERE $condition ";
    $td_result = mysqli_query($conn, $td_query);
    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];
    while ($td_row = mysqli_fetch_array($td_result)) {

?>


        <div class="modal fade" id="staticBackdrop<?= $td_row[$id] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog <?= $total_row > 10 ? 'modal-lg' : '' ?> ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?= $modal_title ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            $sno = 0;
                            foreach ($th_result as $th_row) {
                                if ($th_row['COLUMN_NAME'] != $id) { ?>
                                    <div class="col-sm-4 mb-3 <?= 'id' . $sno ?>">
                                        <?php
                                        echo '<label class="text-capitalize label mb-1  " >' . $th_row['COLUMN_NAME'] . '</label> <br>';
                                        echo '<input readonly type="text" class="form-control" value="' . $td_row[$th_row['COLUMN_NAME']] . '" name="" id="">';

                                        ?>
                                    </div>
                            <?php      }
                                $sno++;
                            }
                            ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php

    }
}



function allData($table_name, $modal_title = 'modal', $condition = 1)
{

    global $conn;
    global $database;
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);
    $total_row = mysqli_num_rows($th_result);

       $td_query = "SELECT * FROM `$table_name` WHERE $condition ";
    $td_result = mysqli_query($conn, $td_query);
    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];
    while ($td_row = mysqli_fetch_array($td_result)) {

    ?>
        <div class="row">
            <?php
            $sno = 0;
            foreach ($th_result as $th_row) {
                if ($th_row['COLUMN_NAME'] != $id) { ?>
                    <div class="col-sm-4 mb-3 <?= 'id' . $sno ?>">
                        <?php
                        echo '<label class="text-capitalize label mb-1  " >' . $th_row['COLUMN_NAME'] . '</label> <br>';
                        echo '<input  type="text" class="form-control" value="' . $td_row[$th_row['COLUMN_NAME']] . '" name="" id="' . $th_row['COLUMN_NAME'] . '">';

                        ?>
                    </div>
            <?php      }
                $sno++;
            }
            ?>
        </div>
<?php

    }
}
?>