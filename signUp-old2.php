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
    #ui {

        padding: 30px;
        margin-top: 50px;
    }

    body {
        background-image: url(proImg/reg4.jpg);

        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;

    }

    .slider {
        width: 100%;
        height: 70vh;
        background-image: url(proImg/default.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        border-radius: 10px;
        margin-top: 50px;
        overflow: hidden;

        box-shadow: 2px 10px 10px 10px #888888;
        animation-name: aa;
        animation-iteration-count: infinite;
        animation-duration: 50s;
        transition-timing-function: linear;


    }

    @keyframes aa {

        0% {
            background-image: url(proImg/default.jpg);
        }

        10% {
            background-image: url(proImg/g.jpg);
        }

        20% {
            background-image: url(proImg/reg3.jpg);
        }

        30% {
            background-image: url(proImg/reg7.jpg);
        }

        40% {
            background-image: url(proImg/reg6.jpg);
        }

        50% {
            background-image: url(proImg/f.jpg);
        }

        60% {
            background-image: url(proImg/c.jpg);
        }

        70% {
            background-image: url(proImg/k.jpg);
        }

        80% {
            background-image: url(proImg/j.jpg);
        }

        90% {
            background-image: url(proImg/h.jpg);
        }

        100% {
            background-image: url(proImg/i.jpg);
        }
    }


    .redbox {
        border-color: red;
    }
    </style>
</head>


<body>



    <div class="container" id="reg">
        <div class="row">
            <div class="col-sm-7">
                <div class="slider visible-md visible-lg">
                </div>
            </div>
            <div class="col-sm-5">
                <div id="ui">
                    <form name="form" method="post" action="signUpFormvali.php" class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="fname" placeholder="First Name" class="form-control"
                                    required="required" id="fnamebox">
                                <span id="nameerr" style="font-size:15; color:red; text-align:center;"></span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="lname" placeholder="Last Name" class="form-control"
                                    id="lnamebox">
                            </div>
                        </div>
                        <br>
                        <input type="email" name="mail" class="form-control" placeholder="email@example.com"
                            required="required" id="mailbox">
                        <span id="mailerr" style="font-size:15; color:red; text-align:center;"></span>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="password" name="password" placeholder="password" class="form-control"
                                    required="required" id="passbox">
                                <span id="passerr" style="font-size:15; color:red; text-align:center;"><b>one 0-9, one
                                        A-Z,@/_</b></span>
                            </div>

                            <div class="col-sm-6">
                                <input type="password" name="conPassword" placeholder="confirm password"
                                    class="form-control" required id="conpassbox">
                                <span id="conpasserr" style="font-size:15; color:red; text-align:center;"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control" name="gender" required id="genderbox">
                                    <option>choose Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="phone" placeholder="phone" class="form-control" id="phonebox">
                                <span id="phoneerr" style="font-size:15; color:red; text-align:center;"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="checkbox" class="form-control" style="" required="required">
                            </div>
                            <div class="col-sm-10">
                                <p style="font-size:25;">Agree</p>
                            </div>
                        </div>
                        <br>

                        <input type="button" value="Sign Up" name="submit" class="btn-primary btn-block btn-lg"
                            id="btn1">
                    </form>
                    <a href="/index.php" style="font-size:20">Already have an account?</a>
                    <br>
                    \
                    <h4 class="msg" style="color:#000080; text-align:center;"></h4>

                </div>              
            </div>        
        </div>
    </div>


</body>

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

            //                    validate password/phone regex
            if (pass.length < 8) {
                $('#passbox').css('border-color', 'red');
                $('#passerr').html('al least 8 characters !');

            } else if (pass != conpass) {
                $('#conpassbox').css('border-color', 'red');
                $('#conpasserr').html('din\'t match ! ');

            } else {

                //         var p=/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@_$!\+\*-])[a-zA-Z0-9@_$!\+\*-]{8,}/-- at least one a-z,A-z,0-9,a special char @+ but in last if other character is there lie . is still valid but one character must be there as in the bracket


                //                     var p=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@_!&])[A-Za-z0-9@!_&]*$/ at least one a-z,A_Z,0-, and special xharacter(only in the bracket no other ) if other special char is there the it will not be valid


                //                        var p=/^[^<`~\*=\^:\/;\]\[|,.\\%#)$(>\+\s\'\"}{-](?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@_!&])[A-Za-z0-9@!_&]*$/  same as abouve but the [^ special char] must not allowded anywhere in the string but '@!_&' r only awwoed , if there  is caps then it must not be in the beginig of string but it can be at other place like 3rd,4th positon  


                var validatePass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@_!&])[A-Za-z0-9@!_&]*$/

                var validatePhone = /^[0-9]{10}$/
                if (!validatePass.test(pass)) // password validatrot
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

                    $(".msg").html("wait a moment verification link is being sent...")
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

            //                    $("#nameerr, #phoneerr, #mailerr, #passerr , #conpasserr").html(""); 
            //                     $(".msg").load("database/insertUser.php",{
            //                    fname : fname,
            //                    lname : lname,
            //                    gender : gender,
            //                    password : pass,
            //                    conPassword :conpass,
            //                    phone :phone,
            //                    mail :email
            //                      });
        } else {
            $(".msg").html("")
            $("#nameerr, #phoneerr, #mailerr, #passerr,#conpasserr").html("required !");
        }
    });

});
</script>

</html>