<?php
include  "./friends/showUsers.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Responsive Testimonial Slider</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css"> 
    <style>
        
.box-area {
    /* padding: 30px; */
    position: relative;
    display: block;
    /* background: #fff; */
    color: #000;
    /* box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; */
    /* margin: 40px 0; */
}

.box-area h5 {
    font-size: 16px;
    font-weight: 700;
    color: rgb(39, 123, 192);
    margin-top: 30px;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.box-area span {
    color: #262626;
    display: block;
    font-size: 13px;
    margin: 0 0 10px;
    font-weight: 400;
}

.box-area .content {
    color: #262626;
}

.box-area .img-area {
    width: 100px;
    height: 100px;
    /* position: absolute; */
    top: -40px;
    left: 0;
    bottom: 0;
    margin: 0 auto;
    right: 0;
    z-index: 1;
    border: 5px solid #fff;
    border-radius: 50%;
    box-shadow: 0 5px 4px rgba(0, 0, 0, 0.5);
}

.box-area .img-area img {
    width: 100%;
    height: auto;
    border-radius: 50%;
}

.socials {
    margin-top: 30px;
}

.socials i {
    margin: 0 10px;
    color: #0a69ed;
    font-size: 18px;
}

#testimonial_area .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
}

#testimonial_area .owl-prev,
#testimonial_area .owl-next {
    width: 40px;
    height: 40px;
    line-height: 40px;
    color: #0a69ed;
    border-radius: 50%;
    text-align: center;
    background: #fff;
    position: absolute;
}

#testimonial_area .owl-prev {
    left: -60px;
    top: -30px;
}

#testimonial_area .owl-next {
    right: -60px;
    top: -30px;
}

@media only screen and (max-width: 991px) {
    .owl-nav {
        display: none;
    }
}

@media only screen and (max-width: 767px) {
    .box-area {
        text-align: center;
    }
    .owl-nav {
        display: none;
    }
}
    </style>
</head>

<body>
<!-- friends slider -->
<section id="testimonial_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="testmonial_slider_area text-center owl-carousel">
                    <?php meToUsers();?>
                        
                        <!-- END SINGLE TESTIMONIALS -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- friends slider -->



    <!-- friends slider -->
    <section id="testimonial_area" class="section_padding">
        <div class="container">
            <div class="row">
            <div class='col-md-12'>
           
            <?php //meToUsers();?>
            <?php //usersToMe();?>
            <?php //friendsOfFriend($_SESSION['id']); 
                           //moreSugg();?>
            </div></div>


        </div>
    </section>
    <!-- friends slider -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
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
                    items: 2
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
</body>

</html>