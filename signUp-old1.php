<?php
session_start();
 if(isset($_SESSION['email']))
 {
     echo "<script>window.open('./home.php','_self')</script>";
 }else{


// if(isset($_POST['submit'])){
// $fname = $_POST['fname'];
// $lname = $_POST['lname'];
// $mail = $_POST['mail'];
// $password = $_POST['password'];
// $gender = $_POST['gender'];
// $phone = $_POST['phone'];
// $conPassword = $_POST['conPassword'];
// $regDate = date('dd-mm-yy');

// $verStatus="unverified";
// $post="no";

// $verCode=mt_rand();

// $dp="default_male.png";
// $DOB=date('DD/MM/YYYY');
// $status="";

// if($password != $conPassword){
//     echo "<script>alert('password & conform Password missmatch')</script>";
// }else{

// $query = "INSERT INTO `user`(`firstName`, `lastName`, `email`, `password`, `gender`, `regDate`, `verStatus`, `verCode`, `post`, `phone`, `lastLogIn`, `DOB`, `dp`, `status`, `logInStatus`) 
//  VALUES('$fname','$lname','$mail','$password','$gender','','')";
// }
// }
// }



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

    <title>Hello, world!</title>
    <style>
    body {
        /* align-items: center;
        background-color: #fff;
        display: flex;
        justify-content: center;
        height: 100%; */
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .logo-brand {
        /* margin: 0 auto; */
        text-align: center;
        /* width: 100%;
        margin-left: -50px; */
    }

    .logo-brand .brand-logo {
        /* position: absolute;
        top: 3%;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        box-shadow: rgb(0 0 0 / 35%) 3px 3px 8px 3px; */
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


        padding: 20px;
        width: 100%;

        border-radius: 39% 79% 100% 0% / 8% 42% 0% 85%;
    }

    .title {
        color: #eee;
        font-family: sans-serif;
        font-size: 36px;
        font-weight: 400;
        margin-top: 30px;
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
        text-align: center;
    }

    .other-links a {
        color: #fff;
        text-align: center;
        font-size: 14px;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 800;
    }

    #switch-links {
        margin-top: 30px;
    }
    </style>
</head>

<body>
    <div class="logo-brand">
        <img class="brand-logo" src="posigraph_logo.png" alt="" />
        <!-- <img class="brand-name" src="brand name png.png" alt="" /> -->
    </div>
    <div>
        <form class="form form-group" name="form" method="post" action="">
        
            <div class="title">Sign up</div>
            <div class="input-container ic1">
                <input class="input" type="text" placeholder="First Name" name="fname" placeholder="First Name"
                    required="required" id="fnamebox" />
                <span id="nameerr" style="font-size:15; color:red; text-align:center;"></span>
            </div>
            <div class="input-container ic3">
                <input class="input" type="text" name="lname" placeholder="Last Name" id="lnamebox" />
            </div>
            <div class="input-container ic2">
                <input type="email" name="mail" class="input" placeholder="email@example.com" required="required"
                    id="mailbox" />
                <span id="mailerr" style="font-size:15; color:red; text-align:center;"></span>
            </div>
            <div class="input-container ic4">
                <input type="password" name="password" placeholder="password" class="input" required="required"
                    id="passbox" />
                <!-- <span id="passerr" style="font-size:15; color:red; text-align:center;"><b>one 0-9, one
                    A-Z,@/_</b></span> -->
            </div>

            <div class="input-container ic4">
                <input type="password" name="conPassword" placeholder="confirm password" class="input" required
                    id="conpassbox" />
                <span id="conpasserr" style="font-size:15; color:red; text-align:center;"></span>
            </div>

            <div class="input-container ic4">
                <select class="form-select" name="gender" required id="genderbox">
                    <option>choose Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="input-container ic4">
                <input type="text" name="phone" placeholder="phone" class="input" id="phonebox" />
                <span id="phoneerr" style="font-size:15; color:red; text-align:center;"></span>
            </div>

            <div class="form-check">
                <input type="checkbox" class="checkbox" required="required" />
                <label class="form-check-label text-white" for="exampleCheck1">Agree</label>
            </div>

            <input type="submit" value="Sign Up" name="submit" class="btn btn-primary btn-block btn-md" id="btn1" />
            <span class="msg"></span>

            <div class="other-links text-center">
                <span class="text-white">Already have an account? <a href="index.php" title="">login</a></span>
            </div>
        </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

 <script>
    $(document).ready(function() {
        $("#btn1").click(function() {

            var fname = $("#fnamebox").val();
            var lname = $("#lnamebox").val();
            var gender = $("#genderbox").val();
            var email = $("#mailbox").val();
            var pass = $("#passbox").val();
            var conpass = $("#conpassbox").val();
            var phone = $("#phonebox").val();
            if (fname !== '' && email !== '' && pass !== '' && conpass !== '' && phone !== '') {
                $('#conpassbox').css('border-color', '');
                $('#passbox').css('border-color', '');
                $("#nameerr, #phoneerr, #mailerr, #passerr,#conpasserr").html("");
                // validate password/phone regex
                if (pass.length < 8) {
                    $('#passbox').css('border-color', 'red');
                    $('#passerr').html('al least 8 characters !');

                } else if (pass != conpass) {
                    $('#conpassbox').css('border-color', 'red');
                    $('#conpasserr').html('din\'t match ! ');

                } else {
                    var validatePass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@_!&])[A-Za-z0-9@!_&]*$/
                    var validatePhone = /^[0-9]{10}$/
                    if (!validatePass.test(pass)) 
                    // password validatrot
                    {
                        $('#passbox').css('border-color', 'red');
                        $('#passerr').html(
                            'at Least 1 upper case, 1 lower case ,and 1 (@,!,_&) no other special character'
                        );
                    } else if (!validatePhone.test(phone)) {
                        $('#phoneerr').css('border-color', 'red');
                        $('#phoneerr').html('invalid phone number! ');
                    } else {
                        $("#nameerr, #phoneerr, #mailerr, #passerr , #conpasserr").html("");
                        // $(".msg").html("wait a moment verification link is being sent...")
                        alert("Verification link is sent to your mail id please verify it");
                        location.replace("index.php");

                        $(".msg").load("database/insertUser.php", {
                            fname: fname,
                            lname: lname,
                            gender: gender,
                            password: pass,
                            conPassword: conpass,
                            phone: phone,
                            mail: email
                        }, function() {
                            $("#fnamebox").val("");
                            $("#lnamebox").val("");
                            $("#genderbox").val("");
                            $("#mailbox").val("");
                            $("#passbox").val("");
                            $("#conpassbox").val("");
                            $("#phonebox").val("");
                        });
                    }
                }
            } else {
                $(".msg").html("")
                $("#nameerr, #phoneerr, #mailerr, #passerr,#conpasserr").html("required !");
            }
        });
    });
    </script> 
</body>
</html>

<?php } ?>