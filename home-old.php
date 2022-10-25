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
    ?>

<!--// html code-->


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
</head>
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


#pop-up-div {
    background: brown;
    display: none;
    position: fixed;
    height: 95vh;
    overflow: hidden;
    top: 52%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    border-radius: 10px;
    box-shadow: 0 0 10px 10px black;

}

#comment-like-div {
    background-color: white;
    height: 60vh;
    overflow-x: hidden;
    overflow-y: scroll;
    padding: 10px;
    box-sizing: border-box;
}

#comment-text {
    width: 300px;
    padding-top: 13px;
    padding-left: 10px;
    box-sizing: border-box;
    margin-right: 5px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
}
</style>

<body class="w3-theme-l5">

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>
            </a>

            <a href="./home.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>


            <input id="srch_input" type="text" placeholder="search"
                style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">

            <button id="srch" class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
            </button>

            <a id="msg" href="./message/chatApp.php"
                class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white" title="Messages"><i
                    class="fa fa-envelope"></i><span class="w3-badge w3-right w3-small w3-green">
                    <?php
                $n=getUnreadMsg($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>
                </span></a>


            <a href="./friends/friends.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="friends"><i class="fa fa-users" aria-hidden="true"></i>
            </a>



            <div class="w3-dropdown-hover">

                <button id="notif" class="w3-button w3-padding-large" title="Notifications">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">
                        <?php
                $n=getTotalUnseenNotif($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>
                    </span> </button>

                <!--      notification drop down-->

                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="overflow:scroll;height:300px;">
                    <?php getAllNotif($_SESSION['id']); ?>
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

    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!--        pop up div initially didden-->
            <div class="container">
                <div class="row">
                    <div id='pop-up-div' class="col-sm-10 col-xs-11 "><br>
                        <!--            append  dynamic comment div here-->
                    </div>
                </div>
                <!--pop up div closse here        -->
            </div>


            <!-- Left Column -->
            <div class="w3-col m4 visible-sm visible-md visible-lg" style="height:80vh;position:fixed;overflow:scroll;">
                <div class="w3-col m12 ">
                    <!-- Profile -->
                    <div class="w3-card w3-round" style="background:rgba(0,0,0,0.1)">
                        <div class="w3-container">
                            <h4 class="w3-center">My Profile</h4>
                            <p class="w3-center"><img src="dp/<?php echo $user['dp'];?>" class="w3-circle"
                                    style="height:106px;width:106px" alt="dp"></p>
                            <hr>
                            <button><i class="fa fa-whatsapp" aria-hidden="true" style="color:green"></i></button>

                            <button><i class="fa fa-instagram" aria-hidden="true" style="color:green"></i></button>
                            <button><i class="fa fa-linkedin-square" aria-hidden="true"></i></button>
                            <button><i class="fa fa-twitter" aria-hidden="true"></i></button>
                            <hr>
                            <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>
                                <?php echo $userDetail['job'];?></p>
                            <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>
                                <?php echo $userDetail['city']." , ".$userDetail['state']." , ".$userDetail['country'] ?>
                            </p>
                            <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>
                                <?php echo $user['DOB']; ?> </p>
                        </div>
                    </div>
                    <br>

                    <!-- Accordion -->
                    <div class="w3-card w3-round">
                        <div class="w3-white">
                            <button onclick="myFunction('Demo1')"
                                class="w3-button w3-block w3-theme-l1 w3-left-align"><i
                                    class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
                            <div id="Demo1" class="w3-hide w3-container">
                                <p>Some text..</p>
                            </div>
                            <button onclick="myFunction('Demo2')"
                                class="w3-button w3-block w3-theme-l1 w3-left-align"><i
                                    class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
                            <div id="Demo2" class="w3-hide w3-container">
                                <p>Some other text..</p>
                            </div>
                            <button onclick="myFunction('Demo3')"
                                class="w3-button w3-block w3-theme-l1 w3-left-align"><i
                                    class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
                            <div id="Demo3" class="w3-hide w3-container">
                                <div class="w3-row-padding">
                                    <br>
                                    <?php image();?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- Interests -->
                    <div class="w3-card w3-round w3-white w3-hide-small">
                        <div class="w3-container">
                            <p>Interests</p>
                            <p>
                                <span class="w3-tag w3-small w3-theme-d5">News</span>
                                <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
                                <span class="w3-tag w3-small w3-theme-d3">Labels</span>
                                <span class="w3-tag w3-small w3-theme-d2">Games</span>
                                <span class="w3-tag w3-small w3-theme-d1">Friends</span>
                                <span class="w3-tag w3-small w3-theme">Games</span>
                                <span class="w3-tag w3-small w3-theme-l1">Friends</span>
                                <span class="w3-tag w3-small w3-theme-l2">Food</span>
                                <span class="w3-tag w3-small w3-theme-l3">Design</span>
                                <span class="w3-tag w3-small w3-theme-l4">Art</span>
                                <span class="w3-tag w3-small w3-theme-l5">Photos</span>
                            </p>
                        </div>
                    </div>
                    <br>

                    <!-- Alert Box -->
                    <div
                        class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
                        <span onclick="this.parentElement.style.display='none'"
                            class="w3-button w3-theme-l3 w3-display-topright">
                            <i class="fa fa-remove"></i>
                        </span>
                        <p><strong>Hey!</strong></p>
                        <p>People are looking at your profile. Find out who.</p>
                    </div>

                    <!-- End Left Column -->
                </div>

                <h1>hh</h1>
            </div>

            <!-- Middle Column -->
            <div class="w3-col m7" style="float:right;margin-right:30px;" id="postDiv">
                <div class="w3-row-padding ">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <h6 class="w3-opacity"> welcome <?php echo $_SESSION['name']?></h6>
                                <div class="row">
                                    <form>
                                        <textarea id="content" class="form-control"
                                            placeholder="write something here or photo/video description"
                                            style="resize:none"></textarea>
                                        <input type="file" id="file" style="display:none"
                                            accept=".png,.jpg,.gif,.bmp,.jpeg,.mp4,.3gp,.mvk,.mov">
                                        <button id="cstmbtn" type="button" class="w3-button w3-theme"><i
                                                class="fa fa-camera" aria-hidden="true"></i>
                                            &nbsp;photo/video</button>
                                        <button id="postbtn" style="float:right" type="button"
                                            class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;Post</button>
                                    </form>
                                </div>
                                <div class="row">
                                    <span id="fileName"> png / gif / jpg / jpeg / video(5MB)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- End Middle Column post area -->
                <?php         
        if(isset($_GET['pn']))  // when pagination started
        {    $pn=$_GET['pn'];
                if($pn=="" || $pn=="1")
            {
                getPost(0,10) ;// for 
            }
            else
            {
                $from=($pn*10)-10;
                 getPost($from,10) ;
            }
        }
        else
        getPost(0,10) ; // for the very first time when pagination is not started                    
        ?>
            </div>
            <!--   pagination div-->
            <div class="w3-col m7" style="float:right;margin-right:30px;padding:10px 20px;" id="pagination">
                <?php include("database/pagination.php");?>
            </div>
            <!--      end of pagination-->
            <!-- End Grid -->
        </div>
        <!-- End Page Container -->
    </div>
    <br>



    <script>
    $(".comment-btn").click(function() {

        //             prepare  a jaxa call and load all like and comment of id (pid) and appen/write it comment div of pup-up-div and add pid data as data-pid for inert-comment btn and like btn of pup-up div
        var $this = $(this);
        pid = $this.data("pid");
        window.alert(pid);
        postId = new FormData();
        postId.append("pid", pid);
        postId.append("comment-btn", "comment");

        $.ajax({
            method: 'post',
            url: "database/loadComments.php",
            cache: false,
            data: postId,
            contentType: false,
            processData: false,
            success: function(loadData) {
                $("#pop-up-div").html(loadData);
            }
        });
        $("#pop-up-div").css("display", "block");

        //             first wirte in pop div then show it
    });



    $("#close-popUp").click(function() {
        $("#pop-up-div").css("display", "none");

    });

    $(".like-btn").click(function() {

        var $this = $(this);
        pid = $this.data("pid");
        $("#" + pid).css("color", "blue");
        postId = new FormData();
        postId.append("pid", pid);
        postId.append("me", "<?php echo $_SESSION['id']?>");
        postId.append("name", "<?php echo $_SESSION['name']?>");
        postId.append("like-btn", "like");

        $.ajax({
            method: 'post',
            url: "database/like.php",
            cache: false,
            data: postId,
            contentType: false,
            processData: false,
            success: function(loadData) {
                if (loadData == "yes") {
                    $("#" + pid).css("color", ""); // remove icon color
                    //                                     get total like after deletion
                    postId = new FormData();
                    postId.append("pid", pid);
                    postId.append("totalLikes", "totalLikes");

                    $.ajax({
                        method: 'post',
                        url: "database/like.php",
                        cache: false,
                        data: postId,
                        contentType: false,
                        processData: false,
                        success: function(loadData) {
                            $("#like" + pid).html(loadData);
                        }
                    });


                } else {

                    $("#" + pid).css("color", "blue");
                    //           get total like after insertion of like
                    postId = new FormData();
                    postId.append("pid", pid);
                    postId.append("totalLikes", "totalLikes");

                    $.ajax({
                        method: 'post',
                        url: "database/like.php",
                        cache: false,
                        data: postId,
                        contentType: false,
                        processData: false,
                        success: function(loadData) {
                            $("#like" + pid).html(loadData);
                        }
                    });
                }
            }
        });
    });



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


    //    my deign

    //    later after click on post btn check two thing  textarea and file choosen then run ajax..
    //       create formData() fetch inputed value from input field object or use submit btn for complete form form submission at once.  

    $("#cstmbtn").click(function() {
        const filebtn = document.getElementById("file");
        filebtn.click();
        filebtn.addEventListener("change", function() {

            if (filebtn.value) {
                var checkFile = $("#file");
                var data = checkFile[0].files;
                $("#fileName").css("font-size", "15px");
                $("#fileName").css("color", "darkGreen");
                $("#fileName").html(data[0].name);
            }
        });
    });



    $("#postbtn").click(function() {
        var checkFile = $("#file");
        var Length = checkFile[0].files.length;
        var data = checkFile[0].files;
        var check;
        if (Length > 0) {
            ext = data[0].name.substring(data[0].name.lastIndexOf(".") + 1);
            check = validatePost(ext, data[0].size);
            if (check == true) {
                var post = new FormData();
                post.append("file", data[0]);
                post.append("id", <?php echo $_SESSION['id']?>);
                <?php  $d=rand(1,1000000000000); ?>
                // if img is selected then test content
                var con = $("#content").val();
                if (con.length > 0) {
                    post.append("text", con);
                    $.ajax({
                        method: 'post',
                        url: "database/insertPost.php",
                        cache: false,
                        data: post,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            window.open('home.php', '_self');
                        }
                    });
                } else {
                    //                                          send only img
                    post.append("text", "");
                    $.ajax({
                        method: 'post',
                        url: "database/insertPost.php",
                        cache: false,
                        data: post,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            window.open('home.php', '_self');
                        }
                    });
                }


            } else
                window.alert("invalid");


        } else {

            var con = $("#content").val();
            if (con.length > 0) {
                // window.alert("only content");
                var post = new FormData();
                post.append("file", data[0]);
                post.append("id", <?php echo $_SESSION['id']?>);
                post.append("text", con);
                $.ajax({
                    method: 'post',
                    url: "database/insertPost.php",
                    cache: false,
                    data: post,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        window.open('home.php', '_self');
                    }
                });
            }
        }
    });

    function validatePost(ext, size) {
        extension = new Array("png", "jpg", "jpeg", "gif", "bmp", "mp4", "3gp", "mvk", "mov");
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
                error = "file is not supported";
            }
        }

        if (flag != 0)
            return false;
        else
            return true;

    }
    </script>


    <script>
    $("#srch").click(function() {

        v = $("#srch_input").val();
        if (v == "")
            window.alert("please enter name or email")
        else
            window.open('search.php?a=' + v, '_self')

    });
    </script>
</body>

</html>


<?php    
}
?>