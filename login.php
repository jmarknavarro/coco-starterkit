<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php';
auth();
 ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <title>Log In</title>
    <link href="resource/img/favicon.ico" rel="icon" />

    <link href="vendor/animate/animate.min.css" rel="stylesheet" />


    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ygc5xtx.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">

            <!-- First Half -->
            <div class="col-md-8 d-none d-md-flex">
                <div class="d-md-flex  p-5 info animated fadeIn">
                    <div class="container">
                        <div class="logo">
                        <a href="https://malolos.ceu.edu.ph/">
                        <img src="resource/img/logo-w.png" class="loginlogo img-responsive" width="400" height="auto" />
                    </a>
                        </div>
                        <div class="d-md-flex p-5 tagline animated fadeIn">
                    <h1><span>CEU</span> EMPOWERS.<br><span>CEU</span> INSPIRES.</h1>
                </div>
                    </div>
                    
                </div>
               

            </div>


            <!-- Second Half -->

            <div class=" col-md-4 p-0">
                <div class="d-flex p-2 justify-content-center align-items-center loginbox form-main animated fadeIn">
                    <div class="loginform form-main" id="loginform-main">
                        <h1 class="m-title text-center"><span>Welcome to</span><br> CoCo Portal</h1>

                        <h5 class="p-title text-center">COMPLETION AND CORRECTION OF GRADES PORTAL</h5>
                        <?php logd();?>
                        <form id="login-form" action="" method="POST">
                            <div class="form-group md-form">
                                <input type="text" name="username" id="username" class="form-control" autocomplete="off"
                                    placeholder="Username" value="" required>
                            </div>
                            <div class="form-group md-form">
                                <input type="password" name="password" id="defaultLoginFormPassword"
                                    class="form-control" autocomplete="off" placeholder="Password" required>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                    <input id="remember" name="remember" type="checkbox" class="custom-control-input"  value="on" <?= $inputs['remember'] ?? '' ?> >
                                    <label for="remember" class="custom-control-label">Remember me</label>
                                </div>
                                
                            <div class="form-group">
                                <input type=hidden name="token" value="<?php echo Token::generate(); ?>">
                                <input type="submit" class="form-control btn btn-blue mt-2" aria-pressed="true"
                                    value="Login"></input>
                            </div>
                            <div class="text-center text-info"><small>
                                    <a href="./" class="text-black  btn-link">Back to menu</a>
                                </small></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    
    document.getElementById('login-form').scrollIntoView()
    </script>

</body>

</html>