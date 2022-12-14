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
    <title>Dashboard</title>
    <!-- Custom CSS -->
    <link href="/coco/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco/resource/css/style.min.css" rel="stylesheet">
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
        <?php include '../header/main_header.php';?>

        <!-- Sidebar -->
        <?php include '../sidebar/instructor_sidebar.php';?>
        <!-- Title bar -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-dark font-weight-medium mb-1">Dashboard
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="#">Overview</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select
                                class="tab custom-select custom-select-set  form-control bg-white border-0 custom-shadow custom-radius">
                                <option value="cog" selected>Completion Grades Within the Semester</option>
                                <option value="cogp">Completion of Grades (Previous Semester)</option>
                                <option value="ccg">Change/Correction of Grades</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- Table -->
                <div class="cog tabcontent">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">Pending
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_PendingCOG_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i
                                                    data-feather="more-horizontal"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">In
                                                Progress
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_OngoingCOG_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i data-feather="clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">Completed
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_CompletedCOG_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i
                                                    data-feather="check-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transaction</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="cog/add-transaction">New
                                                        Transaction</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-2 mb-3">
                                        <table id='recent_transaction_1' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $user_id = $user->data()->id;
                                       echo overviewtable::overviewTransaction_instructor($user_id);
                                        ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cogp tabcontent">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">Pending
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_PendingCOGP_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i
                                                    data-feather="more-horizontal"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">In
                                                Progress
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_OngoingCOGP_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i data-feather="clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">Completed
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_CompletedCOGP_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i
                                                    data-feather="check-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transaction</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="cogp/add-transaction">New
                                                        Transaction</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-2 mb-3">
                                        <table id='recent_transaction_2' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $user_id = $user->data()->id;
                                       echo overviewtable::overviewTransactionCOGP_instructor($user_id);
                                        ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ccg tabcontent">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">Pending
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_PendingCCG_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i
                                                    data-feather="more-horizontal"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">In
                                                Progress
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_OngoingCCG_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i data-feather="clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h6 class="text-muted font-weight-normal mb-2 w-100 text-truncate">Completed
                                            </h6>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                    <?php  $user_id = $user->data()->id; echo $view::count_CompletedCCG_Instructor($user_id)?>
                                                </h2>
                                            </div>

                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i
                                                    data-feather="check-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transaction</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="cgg/add-transaction">New
                                                        Transaction</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-2 mb-3">
                                        <table id='recent_transaction_3' class='table table-bordered dt-hover'
                                            style="width:100%">
                                            <?php
                                        $user_id = $user->data()->id;
                                       echo overviewtable::overviewTransactionCCG_instructor($user_id);
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
            <?php include '../footer/main_footer.php';?>
        </div>
    </div>
    </div>


    <?php require 'modal/cog_approval_details.php';?>
    <?php require 'modal/cogp_approval_details.php';?>
    <?php require 'modal/ccg_approval_details.php';?>

    <script src="/coco/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/coco/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="/coco/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/coco/resource/js/app-style-switcher.js"></script>
    <script src="/coco/resource/js/feather.min.js"></script>
    <script src="/coco/resource/js/sidebarmenu.js"></script>
    <script src="/coco/resource/js/app.js"></script>
    <script src="/coco/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/coco/resource/js/custom.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/sc-2.0.7/sp-2.0.2/datatables.min.js"></script>
    </script>


</body>

</html>