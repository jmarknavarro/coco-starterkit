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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" type="image/png" sizes="16x16" href="/coco-starterkit/resource/img/favicon.ico">
    <title>Dashboard</title>
    <!-- Custom CSS -->
    <link href="/coco-starterkit/vendor/c3/c3.min.css" rel="stylesheet">
    <link href="/coco-starterkit/vendor/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/coco-starterkit/resource/css/style.min.css" rel="stylesheet">
    <link href="/coco-starterkit/resource/css/croppie.css" rel="stylesheet">
    <link href="/coco-starterkit/resource/css/jquery.signature.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/cr-1.6.1/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sp-2.1.0/sr-1.2.0/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ygc5xtx.css">

    <style>
    .kbw-signature {
        width: 400px;
        height: 200px;
    }
    </style>
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
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/coco-starterkit/settings/changeemail"
                                aria-expanded="false"><i data-feather="mail" class="feather-icon"></i><span
                                    class="hide-menu">Change Email</span></a></li>
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
                    <div class="col-lg-10 col-xl-10">
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

            <div id="uploadimageModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content rounded-15">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title-custom">Upload & Crop Image</h5>
                        </div>
                        <div class="modal-body mt-3">
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <div id="image_preview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary mx-1"
                                data-dismiss="modal">Close</button>
                            <button class="btn btn-info crop_image">Upload</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="uploadSignature" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content rounded-15">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title-custom">Upload Signature</h5>
                        </div>
                        <div class="modal-body mt-3">
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <form method="POST" action="updatesign.php">
                                    <?php  UserSignature()?>
                                        <div id="sig"></div>
                                        <div class="mt-1 text-right">
                                        </div>
                                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                                        <button class="btn btn-outline-secondary btn-sm" id="clear">Clear
                                Signature</button>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary mx-1"
                                data-dismiss="modal">Close</button>
                            
                            <button class="btn btn-info">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <!-- Table -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="pb-3">
                                        <img src=<?php profilePic(); ?> alt="image" class="avatar-settings">

                                    </div>
                                    <div class="col-md-12">
                                        <h4 class="avatar-info text-center font-weight-medium">
                                            <?php $user = new user();
                                            echo $user->data()->name; ?></h4>
                                        <h6 class="text-center"><?php $user = new user();
                                                                        echo $user->data()->email; ?>
                                        </h6>
                                        <h6 class="text-center mt-2">Member Since: <b><?php $user = new user();

                                                                                        $timestamp = strtotime($user->data()->joined);
                                                                                        $new_date = date("M j, Y, h:i A", $timestamp);
                                                                                        echo $new_date;

                                                                                        ?></b>
                                        </h6>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="upload_image">Upload Picture</label>
                                            <input type="file" class="custom-file-input" name="upload_image"
                                                id="upload_image" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="page-title text-dark font-weight-medium">User Information</br></h4>
                                        <h6 class="text-muted">You can edit your personal information here.</h6>
                                        <hr>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-12  col-xl-12">
                                        <?php updateProfile(); ?>
                                        <form enctype='multipart/form-data' class="" action="" method="POST">
                                            <div class="form-body">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Username</label>
                                                        <input type="text" name="username" id="username"
                                                            value="<?php echo escape($user->data()->username); ?>"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Full Name</label>
                                                        <input type="text" class="form-control" name="fullName"
                                                            id="fullName"
                                                            value="<?php echo escape($user->data()->name); ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">College to handle</label>
                                                        <select class="form-control" id="collegedept"
                                                            value="<?php echo ($user->data()->collegedept);?>"
                                                            name="collegedept" required>
                                                            <?php $view->CollegeLS1(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                       
                                        <div class="col-12">
                                        <label class="col-form-label" for="">Signature</label>
                                        <div class="form-group mb-4">
                                        <?php  UserSignature()?>
                                       
                                                    <button type="button" class="btn btn-outline-info btn-sm"
                                                    data-toggle="modal" data-target="#uploadSignature">Edit
                                                    Signature</button>
                        
                                                    </div>
                                                
                                       
                                        </div>
                                        </div>

                                        <div class="form-actions mt-5">
                                            <div class="text-right">
                                                <a class="btn btn-outline-secondary mx-1" href="./">Cancel</a>

                                                <button type="submit" name="success" class="btn btn-info">Save
                                                    Changes</button>
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
    </div>
    </div>
    </div>
    </div>
    </div>



    <script src="/coco-starterkit/vendor/jquery/dist/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    <script src="/coco-starterkit/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/coco-starterkit/resource/js/selectize.js"></script>
    <script src="/coco-starterkit/resource/js/jquery.signature.min.js"></script>


    <script>
    $("select").selectize({
        persist: false,
        readOnly: true,
    });

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
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
    $(document).ready(function() {

        $image_crop = $('#image_preview').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 300,
                type: 'circle'
            },
            boundary: {
                width: 400,
                height: 400
            }
        });
        $('#upload_image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {

                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                size: 'viewport',
                format: 'png',
            }).then(function(response) {
                $.ajax({
                    url: "/coco-starterkit/settings/updatepropic.php",
                    type: "POST",
                    data: {
                        "image": response
                    },
                    success: function(data) {
                        $('#uploadimageModal').modal('hide', );
                        setTimeout(function() {
                            window.history.go(-0);
                        }, 1000);
                    }
                });
            })
        });

    });
    </script>
    <script type="text/javascript">
    var sig = $('#sig').signature({
        background: '#00000000',
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
    </script>


</body>

</html>