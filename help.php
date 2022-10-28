<?php 

include "./posi_header.php";
?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <!-- google font end -->


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!--Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
<style>
    .btn-link:hover{
        text-decoration: none;
    }
</style>
<title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
</head>

<body>
    <div class="container" style="margin-top:75px;">
        <div class="row">
            <h2 class="text-center">Help</h2>


            <!-- accordian -->
            <div id="accordion" style="width: 100%;">
                <div class="card">
                    <div class="card-header bg-danger" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                               Step-1
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <i class="fa fa-arrow-right"></i> first signup by filling your details
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-light" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                               Step 2
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                        <i class="fa fa-arrow-right"></i> second verify your account by clicking on the link which you have recived in your mail
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-light" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Step 3
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                        <i class="fa fa-arrow-right"></i> third login your account
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger" id="headingfour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-light" data-toggle="collapse" data-target="#collapsefour"
                                aria-expanded="false" aria-controls="collapsefour">
                                Step 4
                            </button>
                        </h5>
                    </div>
                    <div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                        <i class="fa fa-arrow-right"></i> third login your account
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger" id="headingfive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-light" data-toggle="collapse" data-target="#collapsefive"
                                aria-expanded="false" aria-controls="collapsefive">
                                Step 5
                            </button>
                        </h5>
                    </div>
                    <div id="collapsefive" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                        <i class="fa fa-arrow-right"></i> third login your account
                        </div>
                    </div>
                </div>
            </div>
            <!-- // accordian -->

        </div>
    </div>

</body>

</html>