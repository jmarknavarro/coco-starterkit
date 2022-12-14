<?php require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php'; auth()?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CEU | CoCo Portal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <!-- Favicon -->
    <link href="resource/img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ygc5xtx.css">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Libraries Stylesheet -->
    <link href="vendor/animate/animate.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="resource/css/style.css" rel="stylesheet" />
</head>

<body>


    <!-- Content Start -->
    <div class="container-fluid bg-nav px-lg-5 px-sm-0 wow fadeIn">
        <nav class="navbar navbar-expand-lg navbar-dark px-lg-3 " data-wow-delay="0.1s">
            <a href="https://malolos.ceu.edu.ph/" class="navbar-brand ms-4 ms-lg-0">
                <img src="resource/img/logo-w.png" class="logo img-responsive" width="230" height="auto" />
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end " id="navbarCollapse">
                <ul class="navbar-nav ms-auto p-lg-0">
                    <li class="menu-half"><a href="https://www.facebook.com/theCEUofficial/" class="nav-item nav-link"><i
                            class="fa fa-facebook" aria-hidden="true"> </i></a></li>
                    <li class="menu-half"><a href="https://twitter.com/ceumalolos" class="nav-item nav-link"><i class="fa fa-twitter"
                            aria-hidden="true"></i></a></li>
                    <li class="menu-half"><a href="https://www.instagram.com/ceuofficial/" class="nav-item nav-link"><i class="fa fa-instagram"
                            aria-hidden="true"></i></a></li>

                </ul>
        </nav>
    </div>
    <div class="container-fluid bg py-5 h-100">
        <div class="landing d-flex justify-content-center align-items-center ">
            <div class="col-lg-6 text-center">
                <img src="resource/img/coco.png" class="img-fluid mb-4 animated slideInDown coco-logo" width="500"
                    alt="Coco Logo">

                <h1 class="titlelanding text-white animated slideInDown">
                    <span class="titlelanding-top">Office of the Registrar</span><br> Completion and Correction<br> of
                    Grades Portal
                    <hr class="bottomline">
                </h1>

                <p class="text-white-50 my-3 animated slideInDown">Correction and Completion of Grade portal "CoCo" is the portal used by the Centro Escolar University - Malolos staffs to have an overview of completion of grades and correction of grades requested by different instructors.</p>
                <a class="btn btn-rpink animated slideInDown mt-2" href="./login">Login to Continue</a>
                <!-- <a class="btn btn-primary py-1 px-4 animated slideInDown" href="./register"> Registration Form</a> -->

            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a> -->
    <div class="mt-5">
        <?php include 'dashboard/footer/main_footer.php';?>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>