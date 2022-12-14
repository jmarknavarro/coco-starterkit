<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/core/init.php';
isLogin();
$user = new user();
isSRA($user->data()->groups);
$view = new view();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco-starterkit/resource/img/favicon.ico">
    <title>Faculty Report on Completion of Grades - Previous Semester</title>
    <!-- Custom CSS -->
    <link href="/coco-starterkit/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco-starterkit/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco-starterkit/resource/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/sc-2.0.7/sp-2.0.2/datatables.min.css" />
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
        <?php include '../../sidebar/sra_sidebar.php';?>

        <!-- Title bar -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-dark font-weight-medium mb-1">Faculty Report on Completion of Grades
                            (Previous Semester)
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item active"><a href="/coco-starterkit/dashboard/sra/cogp/"
                                            class="text-muted">My Approval
                                            Request</a></li>
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
                                <h4 class="card-title">Transaction List</h4>
                                <div id="message"></div>

                                <ul class="nav nav-tabs nav-bordered mb-3">

                                    <li class="nav-item">
                                        <a href="#pending-cog" data-toggle="tab" aria-expanded="false"
                                            class="nav-link active ">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span>Pending</span>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="#ongoing-cog" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span>In Progress</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#completed-cog" data-toggle="tab" aria-expanded="true"
                                            class="nav-link">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span>Completed</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#reject-cog" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span>Expired</span>
                                        </a>
                                    </li>



                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active table-responsive mt-2 mb-3" id="pending-cog">
                                        <table id='list_transaction_1' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $viewtable = new viewtable();
                                        $viewtable->sraPendingTransactionCOGP();
                                        ?>
                                        </table>
                                    </div>
                                    <div class="tab-pane  table-responsive mt-2 mb-3" id="ongoing-cog">
                                        <table id='list_transaction_2' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $viewtable = new viewtable();
                                        $viewtable->sraVerifiedTransactionCOGP();
                                        ?>
                                        </table>
                                    </div>

                                    <div class="tab-pane table-responsive mt-2 mb-3" id="completed-cog">
                                        <table id='list_transaction_3' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $viewtable = new viewtable();
                                        $viewtable->sraCompletedTransactionCOGP();
                                        ?>
                                        </table>
                                    </div>


                                    <div class="tab-pane table-responsive mt-2 mb-3" id="reject-cog">
                                        <table id='list_transaction_4' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $viewtable = new viewtable();
                                        $viewtable->sraRejectedTransactionCOGP();
                                        ?>
                                        </table>
                                    </div>



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
    <?php require 'modal/approval_process.php';?>
    <?php require 'modal/approval2_process.php';?>
    <?php require 'modal/approval_details.php';?>
    <?php require 'modal/approval3_details.php';?>
    <?php require 'modal/decline_process.php';?>
    <?php require 'modal/decline_details.php';?>

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
    <script>
    $(function() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('lastTab', $(this).attr('href'));
        });
        var lastTab = localStorage.getItem('lastTab');
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
    });
    </script>
</body>

</html>