<?php 
// session_start();

  include "showUsers.php";

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/w3.css">
    <link rel="stylesheet" href="../style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">

    <style>
    .new-user {
        height: 280px;
        /* overflow-x: hidden;
        overflow-y: scroll; */
    }

    .requested-user {
        height: 300px;
        /* overflow-x: hidden;
        overflow-y: scroll; */
        margin-top: 5px;
        /* box-shadow: 3px 3px 10px 5px #ccc;
        border-radius: 15px; */
    }

    .known-user {
        height: 590px;
    }

    .known-user .request-list {
        height: 275px;
        /* overflow-x: hidden;
        overflow-y: scroll;
        box-shadow: 3px 3px 10px 5px #ccc; */
    }

    .known-user .friend-list {
        height: 300px;
        background: gray;
        overflow-x: hidden;
        overflow-y: scroll;
        margin-top: 10px;
        box-shadow: -1px 10px 100px 5px green;
        border-radius: 10px;
    }

    .user-detail {
        width:auto;
        height: auto;
        margin: 5px;
        /* padding: 0; */
    }

    .user-pic img {
        height: 90px;
        width: 90px;
        border-radius:50%;
    }

    .user-detail .user-name-buttons {
        margin-top: 5px;
    }

    .user-detail .user-name-buttons p {
        font-size: 16px;
    font-family: sans-serif;
    }

    .user-detail .user-name-buttons button {
        width: 100px;
        padding: 4px 10px;
        font-size: 15px;
        outline: none;
        border: none;
        border-radius: 100px;
    }

    .friend-pic img {
        height: 90px;
        width: 90px;
        border-radius:50%;
    }

    .user-detail .user-name-buttons a{
text-decoration: none;
    }
    </style>

</head>

<body>
    <div class="container-fluid">
        <a href="https://posigraph.com/app/posigraph/post.php" class="btn btn-danger">Back to home</a>
        <div class="row">
           <?php myFriends();
                
           ?>
            <div class="col-md-12 all-user">                
                <div class="col-md-12 new-user">
                <h3>Suggested Friends</h3>
                    <?php friendsOfFriend($_SESSION['id']); 
                           moreSugg();?>
                </div>
                
                <div class="col-md-12 friend-list">
                <h3>My Friends</h3>
                    <?php  myFriends();?>
                </div>                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 known-user">
                <div class="col-md-12 request-list">                
                <h3>Request Sent</h3>
                <?php meToUsers();?>                    
                </div>

                <div class="col-md-12 requested-user">
                <h3>Request Recived</h3>
                <?php usersToMe();?>
                </div>

            </div>
        </div>
    </div>


 <!-- friends slider -->
 <section id="testimonial_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="testmonial_slider_area text-center owl-carousel">
                    <?php  myFriends();?>
                        
                        <!-- END SINGLE TESTIMONIALS -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- friends slider -->

</body>

<script>
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


$(".request-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "request";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    // window.alert(userId);
    callFun.append("userName", userName);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            // window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {request}");
        }
    });
});

$(".cancel-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "cancel";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);
    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {cancel}");
        }
    });
});

$(".ignore-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "ignore";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);
    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');

        },
        error: function(result) {
            window.alert(" sorrry error {ignored}");
        }
    });
});

$(".accept-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "accept";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {accepted}");
        }
    });
});

$(".unfriend-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "unfriend";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error occured {unfriend}");
        }
    });
});
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
    <script>
        $(".testmonial_slider_area").owlCarousel({
            autoplay: true,
            slideSpeed: 1000,
            items: 3,
            loop: true,
            nav: true,
            navText: ['<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>'],
            margin: 30,
            dots: true,
            responsive: {
                320: {
                    items: 1
                },
                767: {
                    items: 3
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 5
                }
            }

        });
    </script>
</html>