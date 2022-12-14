<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/core/init.php';
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
    <link rel="icon" type="image/png" sizes="16x16" href="/coco-starterkit/resource/img/favicon.ico">
    <title>New Transaction</title>
    <!-- Custom CSS -->
    <link href="/coco-starterkit/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco-starterkit/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco-starterkit/resource/css/style.min.css" rel="stylesheet">
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

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <li class="sidebar-item "> <a class="sidebar-link " href="/coco-starterkit/dashboard/instructor/"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>

                        <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>

                        <li class="sidebar-item selected"> <a class="sidebar-link has-arrow active"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">My Request</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                <li class="sidebar-item"><a href="/coco-starterkit/dashboard/instructor/cog"
                                        class="sidebar-link "><span class="hide-menu">
                                            Completion Grades <br> Within the Semester
                                        </span></a>
                                </li>

                                <li class="sidebar-item active"><a href="/coco-starterkit/dashboard/instructor/cogp/"
                                        class="sidebar-link active">
                                        <span class="hide-menu">Completion of Grades <br> (Previous Semester)</span>
                                    </a>
                                </li>
                                <li class="sidebar-item"><a href="/coco-starterkit/dashboard/instructor/ccg/"
                                        class="sidebar-link"><span class="hide-menu">
                                            Change/Correction<br> of Grades
                                        </span></a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="/coco-starterkit/dashboard/instructor/logs" aria-expanded="false"><i
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
                        <h3 class="page-title text-dark font-weight-medium mb-1">Faculty Report on Completion of Grades
                            (Previous Semester)
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="/coco-starterkit/dashboard/instructor/cogp/"
                                            class="text-muted">Transaction List</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">New Transaction
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Transaction</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-right"><a href="./forms"></a></div>
                                <form id="user-form" enctype='multipart/form-data' action="" method="POST">
                                    <?php transCOGP();?>
                                    <?php 
                                    $transid = 'COGP'.generateRandomString();
                                    $_SESSION['transaction_id'] = $transid;
                                    
                                    ?>

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Transaction ID</label>
                                                    <input type="text"
                                                        value="<?php echo (isset($_SESSION['transaction_id'])) ? $_SESSION['transaction_id'] : '' ?>"
                                                        name="transaction_id" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Class Code</label>
                                                    <input type="text" name="class_code" id="class_code"
                                                        style="text-transform: uppercase;" class="form-control"
                                                        value="<?php echo input::get('class_code');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline">
                                                    <label class="col-form-label">Subject</label>
                                                    <input type="text" name="subject" id="subject" class="form-control"
                                                        value="<?php echo input::get('subject');?>" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">School Year</label>
                                                    <input type="text" name="school_year" id="school_year"
                                                        class="form-control" placeholder="1234-5678" maxlength="9"
                                                        oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*)\./g, '$1');"
                                                        value="<?php echo input::get('school_year');?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label class="col-form-label">Semester</label>
                                                    <select class="form-control semester"
                                                        value="<?php echo input::get('semester');?>" name="semester">
                                                        <option>1st Semester</option>
                                                        <option>2nd Semester</option>
                                                        <option>Summer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label class="col-form-label">College</label>
                                                    <select class="form-control"
                                                        value="<?php echo input::get('collegedept');?>"
                                                        name="collegedept">
                                                        <?php $view->CollegeLS1();?>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-actions mt-5">
                                        <div class="text-right">
                                            <input type="button" name="reset" class="btn btn-outline-danger"
                                                value="Clear" onclick="ResetTransaction()" />
                                            <a class="btn btn-outline-secondary mx-1"
                                                href="/coco-starterkit/dashboard/instructor/cogp/">Cancel</a>
                                            <button type="submit" name="success" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include '../../footer/main_footer.php';?>
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
    <script src="/coco-starterkit/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/coco-starterkit/resource/js/custom.min.js"></script>
    <script src="/coco-starterkit/resource/js/app.js"></script>
    <script src="/coco-starterkit/resource/js/selectize.js"></script>
    <script src="/coco-starterkit/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
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


</body>

</html>