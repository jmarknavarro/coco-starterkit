<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/core/init.php';
isLogin();

$user = new user();
isInstructor($user->data()->groups);
$view = new view();
$id = $_GET['id'];
$clcode = $_GET['classcode'];
authAdd($id);
addStdAuth($id,$clcode);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco-starterkit/resource/img/favicon.ico">
    <title>New Student</title>
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

                        <li class="sidebar-item "> <a class="sidebar-link " href="/coco-starterkit/dashboard/instructor/" aria-expanded="false"><i
                                    data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>

                        <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>

                        <li class="sidebar-item selected"> <a class="sidebar-link has-arrow active"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">My Request</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                <li class="sidebar-item active"><a href="/coco-starterkit/dashboard/instructor/cog/" class="sidebar-link active"><span
                                            class="hide-menu">
                                            Completion Grades <br> Within the Semester
                                        </span></a>
                                </li>

                                <li class="sidebar-item"><a href="/coco-starterkit/dashboard/instructor/cogp/" class="sidebar-link">
                                        <span class="hide-menu">Completion of Grades <br> (Previous Semester)</span>
                                    </a>
                                </li>
                                <li class="sidebar-item"><a href="/coco-starterkit/dashboard/instructor/ccg/" class="sidebar-link"><span class="hide-menu">
                                Change/Correction<br> of Grades
                                        </span></a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco-starterkit/dashboard/instructor/logs" aria-expanded="false"><i data-feather="bar-chart-2" class="feather-icon"></i><span class="hide-menu">Logs</span></a></li>
                        
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
                        <h3 class="page-title text-dark font-weight-medium mb-1">Faculty Report on Completion Grades Within the Semester
</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a
                                            href="./students?id=<?php echo $id?>&classcode=<?php echo $clcode?>"
                                            class="text-muted">Student List</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">New Student</li>
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
                        <h4 class="card-title">New Students</h4>
                             </div>
                            <div class="card-body">
                                <div class="text-right"><a href="./forms"></a></div>
                                

                                <form id="user-form" enctype='multipart/form-data' action="" method="POST">
                                    <?php stdCOG();
                                    $docu = $view->fetch_transaction($id,$clcode);
                                    ?>
                                    <div class="form-body">
                           
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Name of Student</label>
                                                    <input type="text" name="student_name" id="student_name" class="form-control" style="text-transform: capitalize;" required
                                                        value="<?php echo input::get('student_name');?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label class="col-form-label">Course</label>
                                                    <select class="form-control"
                                                        value="<?php echo input::get('course');?>" name="course">
                                                        <?php $view->CourseLS1();?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                     
                                        <hr classs="my-4">
                                        <h4 class="heading-small">Lecture Grade</h4>
                               
                  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Class Participation</label>
                                                    <input type="number" name="1" id="1" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('1');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Period Exam</label>
                                                    <input type="number" name="2" id="2" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('2');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Period Grade</label>
                                                    <input type="number" name="3" id="3" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('3');?>" />
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <hr classs="my-4">
                                        <h4 class="heading-small">Laboratory Grade</h4>
                                    
                                      
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Class Participation</label>
                                                    <input type="number" name="4" id="4"class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('4');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Period Exam</label>
                                                    <input type="number" name="5" id="5" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('5');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Period Grade</label>
                                                    <input type="number" name="6" id="6" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('6');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Weighted Grade</label>
                                                    <input type="number" name="7"  id="7" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('7');?>" />
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row mt-5">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">1st Period Grade</label>
                                                    <input type="number" name="8" id="8" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('8');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">2nd Period Grade</label>
                                                    <input type="number" name="9" id="9"class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('9');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">3rd Period Grade</label>
                                                    <input type="number" name="10" id="10" class="form-control" min="1" max="5" onchange="dec(this)" 
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$"
                                                        value="<?php echo input::get('10');?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Final Rating</label>
                                                    <input type="number" name="11" id="11" class="form-control" min="1" max="5" onchange="dec(this)" required
                                                        step="0.25" pattern="^\d*(\.\d{0,2})?$" 
                                                        value="<?php echo input::get('11');?>" />
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <input type=hidden name="class_code" value="<?php echo $docu->clCode; ?>">
                                    <input type=hidden name="transaction_id" value="<?php echo $docu->transId; ?>">

                                    <div class="form-actions mt-5">
                                        <div class="text-right">
                                        <input type="button" name="reset" class="btn btn-outline-danger"
                                                value="Clear" onclick="ResetStudent()" />
                                            <a class="btn btn-outline-secondary mx-1"
                                                href="./students?id=<?php echo $id?>&classcode=<?php echo $clcode?>">Cancel</a>
                                            <button type="submit" name="sendform" class="btn btn-info">Submit</button>

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