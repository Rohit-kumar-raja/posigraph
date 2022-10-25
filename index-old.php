<?php
session_start();
 if(isset($_SESSION['email']))
 {
     echo "<script>window.open('./home.php','_self')</script>";
 }
?>

<!DOCTYPE>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background-image: url(proImg/an.jpg);
        /*background-position: center;*/
        background-size: auto;
        background-repeat: no-repeat;
    }

    .box {
        width: 400px;
        padding: 40px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #191919;
        text-align: center;
        box-shadow: 5px 10px 5px;
        opacity: 0.7;
        border-radius: 8px;
    }

    .box h1 {
        color: white;
        text-transform: uppercase;
        font-weight: 500;
    }

    .box input[type="text"],
    .box input[type="password"] {
        border: 0;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 2px solid #3498db;
        padding: 14px 10px;
        width: 200px;
        outline: none;
        color: white;
        border-radius: 24px;
        transition: 0.25s;
    }

    .box input[type="text"]:focus,
    .box input[type="password"]:focus {
        width: 280px;
        border-color: #2ecc71;
    }

    .box input[type="button"] {
        border: 0;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 2px solid #2ecc71;
        padding: 14px 40px;
        outline: none;
        color: white;
        border-radius: 24px;
        transition: 0.25s;
        cursor: pointer;
    }

    .box input[type="button"]:hover {
        background: #2ecc71;
    }

    a {
        text-decoration: none;
        color: white;
        ;
    }
    </style>
</head>

<body>

    <form class="box" method="post">
        <h1>Login</h1>
        <input type="text" id="mail" name="email" placeholder="Username">

        <span id="mailerr" style="font-size:15; color:red; text-align:center;"></span>

        <input type="password" id="pass" name="pass" placeholder="Password">

        <span id="passerr" style="font-size:15; color:red; text-align:center;"></span>

        <input type="button" id="btn" required name="submit" value="log in">
        <a href="forget.php" style="float:left">forget password?</a><br>
        <p class="msg" style="font-size:20; color:red; text-align:center;"></p>
        <a href="signUp.php" style="font-size:20;color:yellow">New User ?</a>
    </form>


</body>


<script>
$(document).ready(function() {
    $("#btn").click(function() {

        var mail = $("#mail").val();
        var pass = $("#pass").val();
        if (mail == '' && pass == '') {

            $("#mail").css("border-color", "red");
            $("#mailerr").html("Enter a valid email");
            $("#pass").css("border-color", "red");
            $("#passerr").html("Enter password ");

        } else if (mail == '') {
            $("#mail").css("border-color", "red");
            $("#mailerr").html("Enter a valid email");
            $("#pass").css("border-color", "white");
            $("#passerr").html("");

        } else if (pass == '') {
            $("#pass").css("border-color", "red");
            $("#passerr").html("Enter password ");
            $("#mail").css("border-color", "white");
            $("#mailerr").html("");

        } else {
            $("#mail,#pass").css("border-color", "red");
            $("#mailerr,#passerr").html("");
            $(".msg").load("database/checkLogIn.php", {
                mail: mail,
                pass: pass
            });
        }

    });

});
</script>

</html>