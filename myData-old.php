<?php
 session_start();
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{
    include_once("database/connection.php");
    include_once("database/getPost.php");
     include("database/getMyImagePost.php");
     include("database/getMsgNotif.php");
     
     $query="select * from user where userId=".$_SESSION['id'];
     $result=mysqli_query($conn,$query);
     $user=mysqli_fetch_array($result);
     
      $query="select * from user_details where userId='".$_SESSION['id']."'";
     $result=mysqli_query($conn,$query);
     $userDetail=mysqli_fetch_array($result);
 
     include "posi_header.php";
}
?>
<!DOCTYPE html>
<html>

<head>

    <title>plexUs</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: "Open Sans", sans-serif
    }
    </style>
</head>

<body class="w3-theme-l5">

    <!-- Navbar -->
    <!--    ------------------------   -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>

            </a>

            <a href="./home.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>


            <input type="text" placeholder="search"
                style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">

            <button class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
            </button>





            <a href="./message/chatApp.php" class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white"
                title="Messages"><i class="fa fa-envelope"></i><span
                    class="w3-badge w3-right w3-small w3-green">10</span></a>


            <a href="./friends/friends.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="friends"><i class="fa fa-users" aria-hidden="true"></i>
            </a>



            <div class="w3-dropdown-hover">

                <button class="w3-button w3-padding-large" title="Notifications">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">4</span> </button>

                <!--      notification drop down-->

                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="overflow:scroll;height:300px;">

                    <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                    <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                    <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                    <a href="#" class="w3-bar-item w3-button">me</a>
                    <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                    <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                    <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                    <a href="#" class="w3-bar-item w3-button">me</a>
                    <a href="#" class="w3-bar-item w3-button">rahul</a>


                </div>


            </div>

            <a href="./myData.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="My Account">
                <img src="dp/<?php echo $user['dp'];?>" class="w3-circle" style="height:23px;width:23px" alt="dp">
            </a>
            <a href="./logOut.php"
                class="w3-bar-item w3-button w3-hide-medium  w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="logOut"><i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <!--    ----------------------    -->


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-large">
        <br>
        <br>
        <br>
        <a href="./home.php" class="w3-bar-item w3-button w3-padding-large "><i class="fa fa-home"
                aria-hidden="true"></i></a>

        <a href="./message/chatApp.php" class="w3-bar-item  w3-hide-medium w3-button w3-padding-large"><i
                class="fa fa-envelope"></i><span class="w3-badge w3-small w3-green">10</span></a>

        <a href="./friends/friends.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-users"
                aria-hidden="true"></i></a>

        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Post</a>

        <a href="./myData.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-cogs"
                aria-hidden="true"></i>
        </a>

        <a href="./logOut.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-power-off"
                aria-hidden="true"></i>
        </a>
    </div>
    <!--    complete menubar ends here-->

    <!--    main body starts here-->
    <div class="container" style="max-width:1300px;margin-top:50px">


        <div class="row">

            <div class="col-sm-12">
                <div class="col-sm-3 change_dp">
                    <div class="row">
                        <div class="col-sm-12 dp">
                            <div class="user-dp" style="height:200px; width:200px;">

                            </div>
                        </div>

                    </div>

                    <div class="row" id="btns-div">
                        <input type="file" id="file" style="display:none" accept=".png,.jpg,.bmp,.jpeg">

                        <button id="cstmbtn" type="button" class="col-sm-8 col-xs-6 btn btn-default"
                            style="margin-left:5px"><span id="imgName">select photo</span></button>

                        <button id="uploadDp" type="button" class=" btn btn-primary">upload</button>
                    </div>

                    <script>



                    </script>



                </div>

                <div class="col-sm-9 userTable">
                    <br>
                    <div class="row r1">

                        <div class="col-sm-4">
                            <input disabled id="firstName" type="text" class="form-control">
                            <br>
                        </div>

                        <div class="col-sm-4">
                            <input disabled id="lastName" type="text" class="form-control">
                            <br>
                        </div>

                        <div class="col-sm-4">
                            <input disabled id="email" type="text" class="form-control">

                        </div>

                    </div>

                    <br>

                    <div class="row r2">

                        <div class="col-sm-4">
                            <input disabled id="password" type="text" class="form-control">
                            <br>
                        </div>

                        <div class="col-sm-4">
                            <input disabled id="gender" type="text" class="form-control">
                            <br>
                        </div>

                        <div class="col-sm-4">
                            <input disabled id="phone" type="text" class="form-control">

                        </div>


                    </div>

                    <br>
                    <div class="row r3">

                        <div class="col-sm-4">
                            <input disabled id="dob" type="text" class="form-control">
                            <br>
                        </div>

                        <div class="col-sm-4">
                            <input disabled id="about" type="text" class="form-control">
                            <br>
                        </div>

                        <div class="col-sm-3">
                            <!--                             when button i click pop model is shown-->
                            <button type="button" id="show-detail-pop" class="form-control btn-success">update
                                Information</button>

                            <br>
                        </div>


                    </div>

                </div>
            </div>
            <!--           pop up model-->

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update</h4>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 form-group">
                                    <label>First Name</label>
                                    <input id="M_firstName" type="text" class="form-control" placeholder="first name">
                                </div>

                                <div class="col-sm-6 col-xs-6 form-group">
                                    <label>Last Name</label>
                                    <input id="M_lastName" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input id="M_email" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input id="M_password" type="text" class="form-control">
                            </div>

                            <div class="row">
                                <div class=" col-sm-6  col-xs-6 form-group">
                                    <label>Gender</label>
                                    <input id="M_gender" type="text" class="form-control">
                                </div>

                                <div class="col-sm-6 col-xs-6 form-group">
                                    <label>Date Of Birth</label>
                                    <input id="M_dob" type="text" class="form-control">
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input id="M_phone" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>About</label>
                                <input id="M_about" type="text" class="form-control">
                            </div>


                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="update-details" class="btn btn-success"> update</button>
                        </div>
                    </div>

                </div>
            </div>



            <!--   pop up model           -->
        </div>
        <!--    //////////////////////////////////////////////////////////////////////////////////  -->


        <div class="row userdetails_table">

            <div class="col-sm-12">
                <h2 style="text-align:center">social Media </h2>
                <div class="row r1">

                    <div class="col-sm-4">
                        <input id="job" type="text" class="form-control" disabled>
                        <br>
                    </div>

                    <div class="col-sm-4">
                        <input id="city" type="text" class="form-control" disabled>
                        <br>
                    </div>

                    <div class="col-sm-4">
                        <input id="pin" type="text" class="form-control" disabled>

                    </div>

                </div>
                <br>
                <div class="row r2">

                    <div class="col-sm-4">
                        <input id="state" type="text" class="form-control" disabled>
                        <br>
                    </div>

                    <div class="col-sm-4">
                        <input id="country" type="text" class="form-control" disabled>
                        <br>
                    </div>

                </div>

                <hr>
                <div class="row r3">

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 col-xs-3"><label>facebook link</label></div>
                            <div class="col-sm-9 col-xs-9">
                                <input id="fb" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3 col-xs-3"><label>Insta link</label></div>
                            <div class="col-sm-9 col-xs-9">
                                <input id="insta" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3 col-xs-3"><label>LinkedIn</label></div>
                            <div class="col-sm-9 col-xs-9">
                                <input id="linked" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3 col-xs-3"><label>Twitter</label></div>
                            <div class="col-sm-9 col-xs-9">
                                <input id="twi" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3 col-xs-3"><label>My website</label></div>
                            <div class="col-sm-9 col-xs-9">
                                <input id="web" type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <br>
                        <div class="row">

                            <div class="col-sm-5 col-xs-3"></div>

                            <div class="col-sm-5 col-xs-3"></div>

                            <div class="col-sm-2 col-xs-6">
                                <button id="btn-social" class="form-control btn-success"> update</button>
                            </div>
                        </div>

                        <br>
                    </div>


                </div>

            </div>
            <!--           social pop model-->


            <!-- Modal -->
            <div id="social-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Social details</h4>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-4 col-xs-4 form-group">
                                    <label>Job/work</label>
                                    <input id="SM_job" type="text" class="form-control" placeholder="job">
                                </div>

                                <div class="col-sm-4 col-xs-4 form-group">
                                    <label>City</label>
                                    <input id="SM_city" type="text" class="form-control">
                                </div>
                                <div class="col-sm-4 col-xs-4 form-group">
                                    <label>PIN Code</label>
                                    <input id="SM_pin" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6  col-xs-6 form-group">
                                    <label>state</label>
                                    <input id="SM_state" type="text" class="form-control">
                                </div>

                                <div class="col-sm-6 col-xs-6 form-group">
                                    <label>coountry</label>
                                    <input id="SM_country" type="text" class="form-control">
                                </div>

                            </div>


                            <div class="form-group">
                                <label>Facebook link</label>
                                <input id="SM_fb" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Instagram link</label>
                                <input id="SM_insta" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>LinkedIn</label>
                                <input id="SM_linked" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Twitter</label>
                                <input id="SM_twi" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>My Website</label>
                                <input id="SM_web" type="text" class="form-control">
                            </div>


                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="update-social" class="btn btn-success"> update</button>
                        </div>
                    </div>

                </div>
            </div>




            <!-- social popup model          -->
        </div>


    </div>
    <!--    //////////////////////////////////////////////////////////-->
</body>


<script>
$("#cstmbtn").click(function() {
    const filebtn = document.getElementById("file");
    filebtn.click();
    filebtn.addEventListener("change", function() {

        if (filebtn.value) {
            var checkFile = $("#file");
            var data = checkFile[0].files;
            if (data[0].name.length > 20) {
                $("#imgName").html(data[0].name.slice(0, 20) + "...");
            } else
                $("#imgName").html(data[0].name);




        }
    });


});



$("#uploadDp").click(function() {


    var checkFile = $("#file");
    var Length = checkFile[0].files.length;
    var data = checkFile[0].files;
    var check;
    if (Length > 0) {

        ext = data[0].name.substring(data[0].name.lastIndexOf(".") + 1);
        check = validatePost(ext, data[0].size);

        if (check == true) {
            var dp = new FormData();
            id = "<?php echo $id?>";
            dp.append("dp", data[0]);
            dp.append("userId", id);
            dp.append("fun", "updateDp");
            $.ajax({
                method: 'post',
                url: "database/getUserData.php",
                cache: false,
                data: dp,
                contentType: false,
                processData: false,
                success: function(result) {
                    //                                                     fetchDp();
                    $(".user-dp").html(result);
                }
            });

        } else
            window.alert("img size must be less than 5 MB");



    } else
        window.alert("please select a photo");
});


function validatePost(ext, size) {
    extension = new Array("png", "jpg", "jpeg", "bmp");
    flag = 0, error = "";
    maxSize = 5242880; // 5mb

    for (i = 0; i < extension.length; i++) {
        if (ext == extension[i]) {
            if (size <= maxSize) {
                flag = 0;
            } else {
                flag = 1;
                error = "file size is large ! please select upto 5MB";
            }
            break;
        } else {
            flag = 1;
            error = "file is not supported"; // extension is not valid
        }
    }

    if (flag != 0)
        return false;
    else
        return true;

}


$("#update-social").click(function() {

    $job = $("#SM_job").val();
    $city = $("#SM_city").val();
    $pinCode = $("#SM_pin").val();
    $state = $("#SM_state").val();
    $country = $("#SM_country").val();
    $facebook = $("#SM_fb").val();
    $insta = $("#SM_insta").val();
    $linkedIn = $("#SM_linked").val();
    $twitter = $("#SM_twi").val();
    $website = $("#SM_web").val();


    id = "<?php echo $id?>";
    data = new FormData();
    data.append("userId", id);
    data.append("fun", "updateSocial");
    data.append("job", $job);
    data.append("city", $city);
    data.append("pinCode", $pinCode);
    data.append("state", $state);
    data.append("country", $country);
    data.append("facebook", $facebook);
    data.append("insta", $insta);
    data.append("linkedIn", $linkedIn);
    data.append("twitter", $twitter);
    data.append("website", $website);



    $.ajax({
        method: 'post',
        url: "database/getUserData.php",
        cache: false,
        data: data,
        contentType: false,
        processData: false,
        success: function(loadData) {
            fetchSocial();
            $("#social-modal").modal("hide");
        }
    });




});


$("#btn-social").click(function() {
    id = "<?php echo $id?>";
    $.post("database/getUserData.php", {
            userId: id,
            fun: "fetchSocial"
        },
        function(social, status) {
            var soc = JSON.parse(social); //receive data from ajax and isolate  it
            $("#SM_job").val(soc.job);
            $("#SM_city").val(soc.city);
            $("#SM_pin").val(soc.pinCode);
            $("#SM_state").val(soc.state);
            $("#SM_country").val(soc.country);
            $("#SM_fb").val(soc.facebook);
            $("#SM_insta").val(soc.insta);
            $("#SM_linked").val(soc.linkedIn);
            $("#SM_twi").val(soc.twitter);
            $("#SM_web").val(soc.website);

        }
    );
    $("#social-modal").modal("show");

});



$(document).ready(function() {
    fetch();
    fetchSocial();
    fetchDp();
});

$("#show-detail-pop").click(function() {

    id = "<?php echo $id?>";
    $.post("database/getUserData.php", {
            userId: id,
            fun: "fetch"
        },
        function(data, status) {
            var user = JSON.parse(data); //receive data from ajax and isolate  it
            $("#M_firstName").val(user.firstName);
            $("#M_lastName").val(user.lastName);
            $("#M_email").val(user.email);
            $("#M_password").val(user.password);
            $("#M_gender").val(user.gender);
            $("#M_phone").val(user.phone);
            $("#M_dob").val(user.DOB);
            $("#M_about").val(user.status);
        }
    );

    $("#myModal").modal("show");
});




$("#update-details").click(function() {


    //open a pop box and allow them to update


    $fName = $("#M_firstName").val();
    $lName = $("#M_lastName").val();
    $email = $("#M_email").val();
    $pass = $("#M_password").val();
    $gen = $("#M_gender").val();
    $phone = $("#M_phone").val();
    $dob = $("#M_dob").val();
    $about = $("#M_about").val();

    id = "<?php echo $id?>";
    data = new FormData();
    data.append("userId", id);
    data.append("fName", $fName);
    data.append("lName", $lName);
    data.append("email", $email);
    data.append("pass", $pass);
    data.append("gen", $gen);
    data.append("phone", $phone);
    data.append("dob", $dob);
    data.append("about", $about);
    data.append("fun", "updateDetalis");



    $.ajax({
        method: 'post',
        url: "database/getUserData.php",
        cache: false,
        data: data,
        contentType: false,
        processData: false,
        success: function(loadData) {
            fetch();
            $("#myModal").modal("hide");
        }
    });




});

function fetchDp() {
    id = "<?php echo $id?>";
    $.post("database/getUserData.php", {
            userId: id,
            fun: "fetchDp"
        },
        function(data, status) {
            $(".user-dp").html(data);

        });
}

function fetch() {
    id = "<?php echo $id?>";
    $.post("database/getUserData.php", {
            userId: id,
            fun: "fetch"
        },
        function(data, status) {
            var user = JSON.parse(data); //receive data from ajax and isolate  it
            $("#firstName").val(user.firstName);
            $("#lastName").val(user.lastName);
            $("#email").val(user.email);
            $("#password").val(user.password);
            $("#gender").val(user.gender);
            $("#phone").val(user.phone);
            $("#dob").val(user.DOB);
            $("#about").val(user.status);
        }
    );
}



function fetchSocial() {
    id = "<?php echo $id?>";
    $.post("database/getUserData.php", {
            userId: id,
            fun: "fetchSocial"
        },
        function(social, status) {
            var soc = JSON.parse(social); //receive data from ajax and isolate  it
            $("#job").val(soc.job);
            $("#city").val(soc.city);
            $("#pin").val(soc.pinCode);
            $("#state").val(soc.state);
            $("#country").val(soc.country);
            $("#fb").val(soc.facebook);
            $("#insta").val(soc.insta);
            $("#linked").val(soc.linkedIn);
            $("#twi").val(soc.twitter);
            $("#web").val(soc.website);

            //                           here may be null err occour so please inset userId in user_details at the time of user sign up it woul help update and fetch data

        }
    );
}

// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</html>