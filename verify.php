<?php

function redirect()
{
    header("location:index.php");
    exit();
}

if(!isset($_GET['email']) || !isset($_GET['code']))
{
     redirect();
}
else
{
    include("database/connection.php");
    mysqli_select_db($conn,"posigraph_socialplexus");
    $email=mysqli_real_escape_string($conn,$_GET['email']);
    $code=mysqli_real_escape_string($conn,$_GET['code']);
    $query="select userId from user where email='$email' AND verCode='$code' AND verStatus='unverified'";
    $result=mysqli_query($conn,$query);
    $total= mysqli_num_rows($result);

    if($total > 0)
    {
        $query="update user set verStatus='verified' where email='$email'";
        $result=mysqli_query($conn,$query);
        echo "<script>alert('Your Posigraph Account Has Been Activated')</script>";
        echo "<script>window.location.replace('index.php')</script>";
        // redirect();
    }
    else
    {
//      may be mail is already verified or not such email in database
        redirect();
    }
}


?>