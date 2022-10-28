<?php
session_start();
 if(isset($_SESSION['email']))
 {
     echo "<script>window.open('./home.php','_self')</script>";
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    <style>
    body {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .logo-brand .brand-logo {
        width: 140px;
        margin-top: 40px;
    }

    .logo-brand {
        text-align: center;
    }

    .logo-brand .brand-name {
        position: absolute;
        top: 20%;
        width: 30%;
        height: auto;
        filter: brightness(0);
    }

    .form {
        background-image: linear-gradient(325deg, #d11e7a, #5059a8);
        border-radius: 0px;
        height: 60vh;
        padding: 20px;
        width: 100%;
        border-radius: 39% 79% 100% 0% / 8% 42% 0% 85%;
    }

    .title {
        color: #eee;
        font-family: sans-serif;
        font-size: 24px;
        font-weight: 400;
        margin-top: 30px;
        margin-left: 20px;
    }

    .subtitle {
        color: #eee;
        font-family: sans-serif;
        font-size: 16px;
        font-weight: 600;
        margin-top: 10px;
    }

    .input-container {
        height: 35px;
        position: relative;
        width: 100%;
        margin: 10px 0;
    }

    .btn {
        border-radius: 25px;
        padding: 10px 40px;
        font-weight: 800;
    }

    .input,
    .form-select {
        background-color: #ffffff;
        border-radius: 25px;
        border: 0;
        box-sizing: border-box;
        color: #5d6570;
        font-size: 18px;
        height: 100%;
        outline: 0;
        padding: 0px 20px 0;
        width: 90%;
        height: 40px;
        margin-left: 15px;
    }

    .cut {
        background-color: #15172b;
        border-radius: 10px;
        height: 20px;
        left: 20px;
        position: absolute;
        top: -20px;
        transform: translateY(0);
        transition: transform 200ms;
        width: 76px;
    }

    .cut-short {
        width: 50px;
    }

    .input:focus~.cut,
    .input:not(:placeholder-shown)~.cut {
        transform: translateY(8px);
    }

    .placeholder {
        color: #65657b;
        font-family: sans-serif;
        left: 20px;
        line-height: 14px;
        pointer-events: none;
        position: absolute;
        transform-origin: 0 50%;
        transition: transform 200ms, color 200ms;
        top: 20px;
    }

    .input:focus~.placeholder,
    .input:not(:placeholder-shown)~.placeholder {
        transform: translateY(-30px) translateX(10px) scale(0.75);
    }

    .input:not(:placeholder-shown)~.placeholder {
        color: #808097;
    }

    .input:focus~.placeholder {
        color: #dc2f55;
    }

    .submit {
        background-color: #fff;
        border-radius: 25px;
        border: 0;
        box-sizing: border-box;
        color: #095f89;
        cursor: pointer;
        font-size: 18px;
        height: 35px;
        font-weight: 700;
        margin-top: 38px;
        outline: 0;
        text-align: center;
        width: 90%;
    }

    .submit:active {
        background-color: #06b;
    }

    .other-links {
        /* text-align: center; */
        text-align: center;
    margin-top: 30px;
    }

    .other-links a {
        color: #fff;
        text-align: center;
        font-size: 12px;
        text-decoration: none;
        /* text-transform: uppercase; */
        font-weight: 400;
    }

    #switch-links {
        margin-top: 30px;
    }

    .posigraph_back {
        position: absolute !important;
        bottom: 0px !important;
        width: 100% !important;
    }

    .lgn_btn {
        margin-left: 16px;
        width: 90%;
        margin-top: 18px;
    }
    </style>
</head>

<body>
    <div class="logo-brand">
        <img class="brand-logo" src="posigraph_logo.png" alt="" />
        <!-- <img class="brand-name" src="brand name png.png" alt="" /> -->
    </div>


    <div class="posigraph_back">
        <form class="form form-group box" method="post">
            <div class="title">Login <?php 
            
           
            ?></div>
            <div class="input-container ic1">
                <input class="input" type="text" placeholder="username" id="mail" name="email" required="required" />
                <!-- <span id="nameerr" style="font-size:15; color:red; text-align:center;"></span> -->
            </div>

            <div class="input-container ic4">
                <input type="password" id="pass" name="pass" placeholder="password" class="input" required />
                <!-- <span id="conpasserr" style="font-size:15; color:red; text-align:center;"></span> -->
            </div>

            <input type="button" value="Login" class="btn btn-primary btn-block btn-md lgn_btn" id="btn" required
                name="submit" />
            <span class="msg"></span>

            <div class="other-links">
                <span class="text-white"><a href="forget.php" title="">Forget Password ?</a> 
                    <a href="signup.php">Signup</a>
                    <!-- <a href="signup.php">New User</a> -->
                </span>
            </div>
        </form>
    </div>

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