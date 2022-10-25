<?php
session_start();
include("./database/connection.php");
include("./database/getMsgNotif.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
$me=$_SESSION['id'];
$user=mysqli_query($conn,"select * from user where userId='$me'");
$user=mysqli_fetch_array($user);
 
include "posi_header.php";
?>

<div class="container" style="margin-top: 75px;">
<h3 class="text-center">Search Here</h3>
    <hr>
    <div class="row">
        <div class="col-md-10">
        <input type="text" placeholder="Search Here" id="srch_input" class="form-control">
        </div>
        <div class="col-md-2">
        <button id="srch" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>
            Search </button>
        </div>
    </div>
</div>

<script>
$("#srch").click(function() {

    v = $("#srch_input").val();
    if (v == "")
        window.alert("please enter name or email")
    else
        window.open('https://posigraph.com/app/posigraph/search.php?a=' + v, '_self')

});
</script>
            