<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco/init/class/core/init.php';
isLogin();
$user = new user();
isInstructor($user->data()->groups);
$view = new view();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco/resource/img/favicon.ico">
    <title>Transaction Logs</title>
    <!-- Custom CSS -->
    <link href="/coco/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco/resource/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.css" />


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
        <?php include '../../sidebar/instructor_sidebar.php';?>

        <!-- Title bar -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-dark font-weight-medium mb-1">Logs
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item active"><a href="/coco/dashboard/instructor/logs"
                                            class="text-muted">Transaction
                                            List</a></li>
                                    <!-- <li class="breadcrumb-item text-muted active" aria-current="page">Student List</li> -->
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
                                <div id="message"></div>
                                <div class="table-responsive mt-2 mb-3">
                                    <table id='list_transaction_logs' class='table table-bordered dt-hover'
                                        style="width:100%">
                                        <?php
                                        $user_id = $user->data()->id;
                                        $viewtable = new viewtable();
                                        $viewtable->viewLogs($user_id);
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

    <script src="/coco/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/coco/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="/coco/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/coco/resource/js/app-style-switcher.js"></script>
    <script src="/coco/resource/js/feather.min.js"></script>
    <script src="/coco/resource/js/sidebarmenu.js"></script>
    <script src="/coco/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/coco/resource/js/custom.min.js"></script>
    <script src="/coco/resource/js/app.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.js">
    </script>
    <script src="/coco/vendor/sweetalert2/dist/sweetalert2.min.js"></script>


</body>

</html>