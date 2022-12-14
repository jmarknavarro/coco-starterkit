<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/core/init.php';
isLogin();
$user = new user();
$view = new view();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco-starterkit/resource/img/favicon.ico">
    <title>Change Email</title>
    <!-- Custom CSS -->
    <link href="/coco-starterkit/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco-starterkit/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco-starterkit/resource/css/style.min.css" rel="stylesheet">
    <link href="/coco-starterkit/resource/css/croppie.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ygc5xtx.css">

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
       
        <?php include '../dashboard/header/main_header.php';?>


        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link" href="/coco-starterkit/" aria-expanded="false"><i
                                    data-feather="arrow-left" class="feather-icon"></i><span class="hide-menu">Back to
                                    dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Account Settings</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco-starterkit/settings/"
                                aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                                    class="hide-menu">Edit Profile</span></a></li>
                                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="/coco-starterkit/settings/changeemail" aria-expanded="false"><i data-feather="mail"
                                    class="feather-icon"></i><span class="hide-menu">Change Email</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="/coco-starterkit/settings/changepassword" aria-expanded="false"><i data-feather="lock"
                                    class="feather-icon"></i><span class="hide-menu">Change Passsword</span></a></li>
                                    <?php
                           if (getUserLevel() == '4' || getUserLevel() == '5') {
                            echo "<li class='list-divider'></li>
                            <li class='nav-small-cap'><span class='hide-menu'>User Management</span></li>
                            <li class='sidebar-item'> <a class='sidebar-link sidebar-link' href='/coco-starterkit/settings/add-user' aria-expanded='false'><i
                                        data-feather='plus' class='feather-icon'></i><span class='hide-menu'>Add New User</span></a></li>";
                           }
                            ?>
                        <li class="list-divider"></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco-starterkit/logout"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- Title bar -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-10">
                        <h3 class="page-title text-dark font-weight-medium mb-1">Account Settings
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="#"></a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">
                <!-- Table -->
                <div class="row">
                <div class="col-lg-5 col-xl-1"></div>
                    <div class="col-lg-9 col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="page-title text-dark font-weight-medium">Change Email</br></h4>
                                        <h6 class="text-muted">Your current email address is <span class="font-weight-medium"> <?php $user = new user();
                                            echo $user->data()->email; ?></span>.  Plase enter your new email address and current password.</h6>
                                        <hr>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-12  col-xl-12">
                                    <?php changeEmail(); ?>
                                        <form  action="" method="POST">
                                            <div class="form-body">
                                            <div class="col-8">
                                                    <div class="form-group">
                                                        <label class="col-form-label">New Email Address</label>
                                                        <input type="email" name="New_Email" id="New_Email"
                                                        value ="" autocomplete="off" required
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Confirm Email Address</label>
                                                        <input type="email" name="Confirm_Email" id="Confirm_Email"
                                                        value ="" autocomplete="off" required
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Current Password</label>
                                                        <input type="password" class="form-control" name="Password"
                                                            id="Password"
                                                            value ="" autocomplete="off" required />
                                                    </div>
                                                </div>

                                                <div class="form-actions mt-5">
                                                    <div class="text-right">
                                                        <a class="btn btn-outline-secondary mx-1"
                                                            href="./changeemail">Cancel</a>

                                                        <button type="submit" name="success" class="btn btn-info">Change Email</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
                 <!-- Footer -->
     <?php include '../dashboard/footer/main_footer.php';?>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="/coco-starterkit/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/coco-starterkit/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="/coco-starterkit/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/coco-starterkit/resource/js/app-style-switcher.js"></script>
    <script src="/coco-starterkit/resource/js/feather.min.js"></script>
    <script src="/coco-starterkit/resource/js/sidebarmenu.js"></script>
    <script src="/coco-starterkit/resource/js/croppie.js"></script>
    <script src="/coco-starterkit/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/coco-starterkit/resource/js/custom.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.js">
    </script>
    </script>
    <script src="/coco-starterkit/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
    $("#submit-btn").click(function(e) {
        e.preventDefault();
        // handle form here with your JS
    });
    <?php
        $flashMessage = new flashMessage();
        $flashMessage->printMessage();
        ?>
    </script>

    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>