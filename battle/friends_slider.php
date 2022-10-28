<?php 
 session_start();
  include("showUsers.php");
  ?>

<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->

<head>
    <meta charset="UTF-8">
    <title>Responsive Testimonial Slider</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="friends/index_friends.css">
</head>

<body>
    <!-- START TESTIMONIAL -->
    <section id="testimonial_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div>
                <h3>Suggested</h3>    
                </div>
                <div class="col-md-12">
                    <div class="testmonial_slider_area text-center owl-carousel new-user">
                       
                        <!-- END SINGLE TESTIMONIALS -->
                        <?php friendsOfFriend($_SESSION['id']); 
                           moreSugg();?>
                       
                        <!-- END SINGLE TESTIMONIALS -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TESTIMONIAL -->

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
    callFun.append("userName", userName);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            
            window.open('battle.php', '_self');
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
   
    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            // window.open('home.php','_self');
            window.alert(result);
            window.open('battle.php', '_self');
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
            window.open('button.php', '_self');

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
            window.open('button.php', '_self');
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
            window.open('button.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error occured {unfriend}");
        }
    });
});

$(".battle-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "requests";
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
            window.open('battle.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {request}");
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
                    items: 2
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }

        });
    </script>
</body>

</html>