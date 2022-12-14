<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco/init/class/core/init.php';
isLogin();
$user = new user();
$view = new view();
isAdmin($user->data()->groups);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco/resource/img/favicon.ico">
    <title>Add New User</title>
    <!-- Custom CSS -->
    <link href="/coco/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco/resource/css/style.min.css" rel="stylesheet">
    <link href="/coco/resource/css/croppie.css" rel="stylesheet">
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
                        <li class="sidebar-item"> <a class="sidebar-link" href="/coco/" aria-expanded="false"><i
                                    data-feather="arrow-left" class="feather-icon"></i><span class="hide-menu">Back to
                                    dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Account Settings</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco/settings/"
                                aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                                    class="hide-menu">Edit Profile</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco/settings/changeemail"
                                aria-expanded="false"><i data-feather="mail" class="feather-icon"></i><span
                                    class="hide-menu">Change Email</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="/coco/settings/changepassword" aria-expanded="false"><i data-feather="lock"
                                    class="feather-icon"></i><span class="hide-menu">Change Passsword</span></a></li>
                        <?php
                           if (getUserLevel() == '4' || getUserLevel() == '5') {
                            echo "<li class='list-divider'></li>
                            <li class='nav-small-cap'><span class='hide-menu'>User Management</span></li>
                            <li class='sidebar-item'> <a class='sidebar-link sidebar-link' href='/coco/settings/add-user' aria-expanded='false'><i
                                        data-feather='plus' class='feather-icon'></i><span class='hide-menu'>Add New User</span></a></li>";
                           }
                            ?>


                        <li class="list-divider"></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco/logout"
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
                    <div class="col-lg-10 col-xl-10">
                        <h3 class="page-title text-dark font-weight-medium mb-1">User Management
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
                                    <h3 class="page-title text-dark font-weight-medium">Add New User</br></h4>
                                        <h6 class="text-muted">Complete your profile by filling in this account creation
                                            form.</h6>
                                        <hr>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-12  col-xl-12">
                                        <?php vald(); ?>
                                        <form enctype='multipart/form-data' class="" action="" method="POST">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Username</label>
                                                            <input type="text" name="username" id="username"
                                                                value="<?php echo input::get('username');?>"
                                                                autocomplete="off" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Full Name</label>
                                                            <input type="text" name="fullName" id="fullName"
                                                                value="<?php echo input::get('fullName');?>"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Email Addresss</label>
                                                            <input type="email" name="email" id="email"
                                                                value="<?php echo input::get('email');?>"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Password</label>
                                                            <input type="password" name="password" id="password"
                                                                value="<?php echo input::get('password');?>"
                                                                autocomplete="off" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Confirm Password</label>
                                                            <input type="password" class="form-control"
                                                                name="ConfirmPassword" id="ConfirmPassword"
                                                                value="<?php echo input::get('ConfirmPassword');?>"
                                                                autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group mb-4">
                                                            <label class="col-form-label">College to handle</label>
                                                            <select class="form-control" id="collegedept"
                                                                value="<?php echo input::get('collegedept'); ?>"
                                                                name="collegedept" required>
                                                                <?php $view->CollegeLS1(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <label class="col-form-label">User Role</label>
                                                            <select class="form-control"
                                                                value="<?php echo input::get('role');?>"
                                                                name="role">
                                                                <option value="6" <?php if(isset($_POST['role']) && $_POST['role'] == "6") echo "selected"; ?>>Instructor</option>
                                                                <option value="5" <?php if(isset($_POST['role']) && $_POST['role'] == "5") echo "selected"; ?>>Student Records Assistant</option>
                                                                <option value="4" <?php if(isset($_POST['role']) && $_POST['role'] == "4") echo "selected"; ?>>Registrar</option>
                                                                <option value="3" <?php if(isset($_POST['role']) && $_POST['role'] == "3") echo "selected"; ?>>Dean/Acad.Head/Head of Program of Students
                                                                </option>
                                                                <option value="2" <?php if(isset($_POST['role']) && $_POST['role'] == "2") echo "selected"; ?>>VP for Academic Affair</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions mt-5">
                                                    <div class="text-right">
                                                        <a class="btn btn-outline-secondary mx-1" href="./">Cancel</a>
                                                        <input type="hidden" name="Token"
                                                            value="<?php echo Token::generate();?>" />
                                                        <button type="submit" name="success"
                                                            class="btn btn-info">Submit</button>
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



    <script src="/coco/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/coco/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="/coco/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/coco/resource/js/app-style-switcher.js"></script>
    <script src="/coco/resource/js/feather.min.js"></script>
    <script src="/coco/resource/js/sidebarmenu.js"></script>
    <script src="/coco/resource/js/croppie.js"></script>
    <script src="/coco/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/coco/resource/js/custom.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.js">
    </script>
    </script>
    <script src="/coco/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/coco/resource/js/selectize.js"></script>

    <script>
    $("select").selectize({
        persist: false,
        readOnly: true,
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