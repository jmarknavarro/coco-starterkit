<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/core/init.php';
isLogin();
$user = new user();
isSRA($user->data()->groups);
$view = new view();
$id = $_GET['id'];
$clcode = $_GET['classcode'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco-starterkit/resource/img/favicon.ico">
    <title>Faculty Report on Completion Grades Within the Semester</title>
    <!-- Custom CSS -->
    <link href="/coco-starterkit/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco-starterkit/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco-starterkit/resource/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.css" />
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

        <!-- Header -->
        <?php include '../../header/main_header.php';?>

        <!-- Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <li class="sidebar-item "> <a class="sidebar-link " href="/coco-starterkit/dashboard/sra/"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>

                        <li class="sidebar-item selected"> <a class="sidebar-link has-arrow active"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Request List</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                <li class="sidebar-item active"><a href="/coco-starterkit/dashboard/sra/cog/"
                                        class="sidebar-link active"><span class="hide-menu">
                                            Completion Grades <br> Within the Semester
                                        </span></a>
                                </li>

                                <li class="sidebar-item "><a href="/coco-starterkit/dashboard/sra/cogp/" class="sidebar-link ">
                                        <span class="hide-menu">Completion of Grades <br> (Previous Semester)</span>
                                    </a>
                                </li>
                                <li class="sidebar-item"><a href="/coco-starterkit/dashboard/sra/ccg/" class="sidebar-link"><span
                                            class="hide-menu">
                                            Change/Correction<br> of Grades
                                        </span></a>
                                </li>

                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="#" aria-expanded="false"><i
                                    data-feather="bar-chart-2" class="feather-icon"></i><span
                                    class="hide-menu">Logs</span></a></li>


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
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-dark font-weight-medium mb-1">Faculty Report on Completion Grades
                            Within the Semester
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="/coco-starterkit/dashboard/sra/cog/"
                                            class="text-muted">Transaction List</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Student List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">
                <!-- Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-2">
                                    <div id="message"></div>
                                    <table id='list_grades' class='table table-sm v-middle table-bordered dt-hover mt-2'
                                        style="width:100%">
                                        <?php
                                        $user_id = $user->data()->id;
                                        $viewtable = new viewtable();
                                        $viewtable->viewAllStudents($id,$clcode);
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include '../../footer/main_footer.php';?>
        </div>
    </div>
    </div>
    <script src="/coco-starterkit/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/coco-starterkit/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="/coco-starterkit/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/coco-starterkit/resource/js/app-style-switcher.js"></script>
    <script src="/coco-starterkit/resource/js/feather.min.js"></script>
    <script src="/coco-starterkit/resource/js/sidebarmenu.js"></script>
    <script src="/coco-starterkit/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/coco-starterkit/resource/js/custom.min.js"></script>
    <script src="/coco-starterkit/resource/js/app.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.js">
    </script>
    <script src="/coco-starterkit/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    </script>
</body>

</html>