<?php



function search_data($table_name, $edit_url = '', $delete_url = '', $show_url = '', $condition = 1)
{
    global $conn;
    global $database;
    $search_string = '';
    $key = array();

    if (isset($_GET['q'])) {
        $search_string = $_GET['q'];
    }
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);
    $sno = 1;
    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];
    foreach ($th_result as $th_row) {
        array_push($key, $th_row['COLUMN_NAME'] . ' LIKE ' . "'%" . $search_string . "%'");
    }
    $td_query = "SELECT * FROM `$table_name` WHERE " . implode("||", $key) . " && $condition ";
    $td_result = mysqli_query($conn, $td_query);

    while ($td_row = mysqli_fetch_array($td_result)) {

        echo "<tr>";
        echo "<td>" . $sno++ . "</td>";
        foreach ($th_result as $th_row) {
            if ($th_row['COLUMN_NAME'] != $id)
                echo "<td>" . $td_row[$th_row['COLUMN_NAME']] . "</td>";
        }
        echo '<td>';
        if ($show_url != '') {
            echo ' <a href="' . $show_url . '?show=' . $td_row[$id] . '"  class="btn btn-primary">show</a>';
        }
        if ($edit_url != '') {
            echo ' <a href="' . $edit_url . '?edit=' . $td_row[$id] . '"  class="btn btn-warning">edit</a>';
        }
        if ($delete_url != '') {
            echo ' <a href="' . $delete_url . '?delete=' . $td_row[$id] . '"  class="btn btn-danger">delete</a>';
        }
        echo '</td>';

        echo "</tr>";
    }
}

function searchWithPaginationAll($table_name, $perPageRecord, $url, $action = '', $edit_url = '', $delete_url = '', $show_url = '', $condition = 1)
{
    global $conn;
    global $database;
    $search_string = '';
    $key = array();
    if (isset($_GET['q'])) {
        $_SESSION['q'] = $_GET['q'];
        $search_string = $_SESSION['q'];
    }
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);
    $sno = 1;
    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];
    foreach ($th_result as $th_row) {
        array_push($key, $th_row['COLUMN_NAME'] . ' LIKE ' . "'%" . $search_string . "%'");
    }
    $_SESSION['condition'] = implode("||", $key);

    $td_query = "SELECT * FROM `$table_name` WHERE  " . implode("||", $key) . " && $condition ";
    $td_result = mysqli_query($conn, $td_query);
    // print_r($td_result);
    echo '<div class="table-responsive">';
    echo '<table class="table table-hover table-border">';
    echo '<tr>';
    echo "<th> S.NO </th>";
    foreach ($th_result as $th_row1) {
        if ($th_row1['COLUMN_NAME'] !== $id)
            echo "<th >" . $th_row1['COLUMN_NAME'] . "</th>";
    }
    if ($action != '') {
        echo "<th class='text-center'> Action </th>";
    }
    echo '<tr>';
    while ($td_row = mysqli_fetch_array($td_result)) {
        echo "<tr>";
        echo "<td>" . $sno++ . "</td>";
        foreach ($th_result as $th_row) {
            if ($th_row['COLUMN_NAME'] != $id)
                echo "<td>" . $td_row[$th_row['COLUMN_NAME']] . "</td>";
        }
        echo '<td>';
        if ($show_url != '') {
            echo '<button type="button" class="btn btn-primary btn-sm  fas fa-eye " data-bs-toggle="modal" data-bs-target="#staticBackdrop' . $td_row[$id] . '">
              show
        </button>';
            data_show($table_name, $show_url, $id . '=' . $td_row[$id]);
        }
        if ($edit_url != '') {
            echo ' <a href="' . $edit_url . '?edit=' . $td_row[$id] . '"  class="btn btn-warning">edit</a>';
        }
        if ($delete_url != '') {
            echo ' <a href="' . $delete_url . '?delete=' . $td_row[$id] . '"  class="btn btn-danger">delete</a>';
        }
        echo '</td>';
        echo "</tr>";
    }
    echo "</table>";
    echo '</div>';

    $condition = implode("||", $key) . " && " . $condition;
    paginate($table_name, $perPageRecord, $url, $condition);
}
// for aashapress special



function searchForSelect($table_name, $column1, $column2, $column3, $condition = 1)
{
    global $conn;
    global $database;
    $search_string = '';
    $key = array();

    if (isset($_GET['q'])) {
        $search_string = $_GET['q'];
    }
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);

    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];
    foreach ($th_result as $th_row) {
        array_push($key, $th_row['COLUMN_NAME'] . ' LIKE ' . "'%" . $search_string . "%'");
    }
    $td_query = "SELECT * FROM `$table_name` WHERE " . implode("||", $key) . " && $condition ";
    $td_result = mysqli_query($conn, $td_query);

    while ($td_row = mysqli_fetch_array($td_result)) {
        echo "<option value = '"  . $td_row[$column1] . " - " . $td_row[$column2] . " | " . $td_row[$column3] .  " | " . $td_row['id'] . "'></option>";
    }
}

function searchForCliet($table_name, $column1, $condition = 1)
{
    global $conn;
    global $database;
    $search_string = '';
    $key = array();

    if (isset($_GET['q'])) {
        $search_string = $_GET['q'];
    }
    $th_query = "SELECT `COLUMN_NAME` FROM information_schema.columns WHERE `table_name`='$table_name' && `table_schema`='$database' ORDER BY 'id' DESC ";
    $th_result = mysqli_query($conn, $th_query);

    // this is the id of the table for goes into the next page
    $id = mysqli_fetch_array($th_result)[0];
    foreach ($th_result as $th_row) {
        array_push($key, $th_row['COLUMN_NAME'] . ' LIKE ' . "'%" . $search_string . "%'");
    }
    $td_query = "SELECT * FROM `$table_name` WHERE " . implode("||", $key) . " && $condition ";
    $td_result = mysqli_query($conn, $td_query);

    while ($td_row = mysqli_fetch_array($td_result)) {
        echo "<option value = '"  . $td_row[$column1] . "'></option>";
    }
}
