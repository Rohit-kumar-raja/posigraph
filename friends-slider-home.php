<!DOCTYPE html>
<html>

<head>
    <title>Slick Playground</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
        }
        
        * {
            box-sizing: border-box;
        }

        .slider {
            width: 90%;
            margin: 10px auto;
        }
        
        .slick-slide {
            margin: 0px 20px;
        }
        
        .slick-slide img {
            width: 100%;
        }


        .slick-prev:before,
        .slick-next:before {
            color: black;
        }
        
        .slick-slide {
            transition: all ease-in-out .3s;
            /* opacity: .2; */
        }
        
        .slick-active {
            /* opacity: .5; */
        }
        
        .slick-current {
            /* opacity: 1; */
        }
    </style>
</head>

<body>





    <section class="center slider">
        <div>
            <img src="dp/55user84.jpg" style="height: 250px;"/>
        </div>
        <div>
            <img src="dp/55user84.jpg"  style="height: 250px;"/>
        </div>
        <div>
            <img src="dp/55user84.jpg"  style="height: 250px;"/>
        </div>
        <div>
            <img src="dp/55user84.jpg"  style="height: 250px;"/>
        </div>
        <div>
            <img src="dp/55user84.jpg"  style="height: 250px;"/>
        </div>
        <div>
            <img src="dp/55user84.jpg"  style="height: 250px;"/>
        </div>
        <div>
            <img src="dp/55user84.jpg"  style="height: 250px;"/>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {

            $(".center").slick({
                dots: true,
                infinite: true,
                centerMode: true,
                slidesToShow: 3,
                slidesToScroll: 3,

            });


        });
    </script>

</body>

</html>