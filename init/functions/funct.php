<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/vendor/sendmail.php';

function CheckSuccess($status)
{
    if ($status == 'Success') {
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert" id="success-alert">
            <b>Congratulations!</b> You have successfully submitted your request!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        echo "<script language='javascript' type='text/javascript'> setTimeout(function() { }, 1500);</script>";
    }
    if ($status == 'UpdateProfile') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Good Job!", "Profile was successsfully updated.", 'success');
        echo "<script language='javascript' type='text/javascript'> setTimeout(function() {window.history.go(-0); }, 1000);</script>";
    }

    if ($status == 'FSuccessT') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Good Job!", "Your transaction was successsfully submitted.", 'success');
        echo "<script language='javascript' type='text/javascript'> setTimeout(function() { ResetTransaction(); }, 1500);</script>";
    }

    if ($status == 'FSuccessUT') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Good Job!", "Your transaction was successsfully updated.", 'success');
        echo "<script language='javascript' type='text/javascript'> setTimeout(function() { ResetTransaction(); }, 1500);</script>";
    }

    if ($status == 'FSuccessS') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Good Job!", "Your request was successsfully submitted.", 'success');
        echo "<script language='javascript' type='text/javascript'> setTimeout(function() { ResetStudent(); }, 1500);</script>";
    }

    if ($status == 'ProfileSuccess') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Profile Updated!", "Your profile has been successfully updated.", 'success');
        echo '<script> setTimeout(function() {  window.history.go(-0); }, 1700); </script>';
    }

    if ($status == 'PasswordSuccess') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Password Changed!", "Your passsword has been changed successfully.", 'success');
    }

    if ($status == 'EmailSuccess') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Email Changed!", "Your email has been changed successfully.", 'success');
        echo '<script> setTimeout(function() {  window.history.go(-0); }, 1700); </script>';
    }

    if ($status == 'AddUserSuccess') {
        $flashMessage = new flashMessage();
        $flashMessage->setMessage("Good Job!", "Your account was created successfully.", 'success');
        echo '<script> setTimeout(function() {  window.history.go(-0); }, 1700); </script>';
    }
}

function Success()
{
    echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            <b>Congratulations!</b> You have successfully registered a new Student Records Assistant!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
function loginError()
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                Incorrect username or password.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}
function curpassError()
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid Current Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}


function pError($error)
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
             ' . $error . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}

function vald()
{
    if (input::exists()) {
        if (Token::check(Input::get('Token'))) {
            if (!empty($_POST['College'])) {
                $_POST['College'] = implode(',', input::get('College'));
            } else {
                $_POST['College'] = "";
            }
            $validate = new Validate;
            $validate = $validate->check($_POST, array(
                'username' => array(
                    'required' => 'true',
                    'min' => 4,
                    'max' => 20,
                    'unique' => 'tbl_accounts'
                ),
                'password' => array(
                    'required' => 'true',
                    'min' => 6,
                ),
                'ConfirmPassword' => array(
                    'required' => 'true',
                    'matches' => 'password'
                ),
                'fullName' => array(
                    'required' => 'true',
                    'min' => 2,
                    'max' => 50,
                ),
                'email' => array(
                    'required' => 'true',
                    'unique' => 'tbl_accounts'

                ),
                'collegedept' => array(
                    'required' => 'true'
                )
            ));

            if ($validate->passed()) {
                $user = new user();
                $salt = Hash::salt(32);
                $username = input::get('username');
                $password = input::get('password');
                $email = input::get('email');
                try {
                    $user->create(array(
                        'username' => input::get('username'),
                        'password' => Hash::make(input::get('password'), $salt),
                        'salt' => $salt,
                        'name' => input::get('fullName'),
                        'joined' => date('Y-m-d H:i:s'),
                        'groups' => input::get('role'),
                        'collegedept' => input::get('collegedept'),
                        'email' => $email,
                    ));

                } catch (Exception $e) {
                    die($e->getMessage());
                }
                CheckSuccess('AddUserSuccess');
                sendNewAcc($username, $password, $email);
            } else {
                foreach ($validate->errors() as $error) {
                    pError($error);
                }
            }
        }
    } else {
        return false;
    }
}

function logd()
{
    if (input::exists()) {
        if (Token::check(input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true)
            ));
            if ($validation->passed()) {
                $user = new user();
                $remember = (input::get('remember') === 'on') ? true : false;
                $login = $user->login(input::get('username'), input::get('password'), $remember);
                if ($login) {
                    if ($user->data()->groups == 1) {
                        Redirect::to('/coco-starterkit/admin/');
                        echo $user->data()->groups;
                    } elseif ($user->data()->groups == 2) {
                        Redirect::to('/coco-starterkit/dashboard/vp/ccg');
                        echo $user->data()->groups;
                    } elseif ($user->data()->groups == 3) {
                        Redirect::to('/coco-starterkit/dashboard/dean/cogp');
                        echo $user->data()->groups;
                    } elseif ($user->data()->groups == 4) {
                        Redirect::to('/coco-starterkit/dashboard/registrar/cog');
                        echo $user->data()->groups;
                    } elseif ($user->data()->groups == 5) {
                        Redirect::to('/coco-starterkit/dashboard/sra/cog');
                        echo $user->data()->groups;
                    } elseif ($user->data()->groups == 6) {
                        Redirect::to('/coco-starterkit/dashboard/instructor/');
                        echo $user->data()->groups;
                    } else {
                        Redirect::to('./home');
                        echo $user->data()->groups;
                    }
                } else {
                    loginError();
                }
            } else {
                foreach ($validation->errors() as $error) {
                    pError($error);
                    // echo $error.'<br />';
                }
            }
        }
    }
}

function isLogin()
{
    $user = new user();
    if (!$user->isLoggedIn()) {
        Redirect::to('/coco-starterkit/login');
    }
}

function auth()
{
    $user = new user();
    $login = $user->isLoggedIn();
    if ($login) {
        if ($user->data()->groups == 1) {
            Redirect::to('/coco-starterkit/admin/');
        } elseif ($user->data()->groups == 2) {
            Redirect::to('/coco-starterkit/dashboard/vp/cogp');
        } elseif ($user->data()->groups == 3) {
            Redirect::to('/coco-starterkit/dashboard/dean/cogp');
        } elseif ($user->data()->groups == 4) {
            Redirect::to('/coco-starterkit/dashboard/registrar/cog');
        } elseif ($user->data()->groups == 5) {
            Redirect::to('/coco-starterkit/dashboard/sra/cog');
        } elseif ($user->data()->groups == 6) {
            Redirect::to('/coco-starterkit/dashboard/instructor/');
        }
    }
}

function authAdd($id)
{
    $view = new view();
    if ($view->isPending($id)) {
    } else {
        Redirect::to('./');
        exit;
    }
}
function addStdAuth($id, $clcode)
{
    $view = new view();
    $count = $view->count_grades($id, $clcode);
    if ($count <= 9) {
    } else {
        echo $id;
        Redirect::to('./students?id=' . $id . '&classcode=' . $clcode . '');
        exit;
    }
}
function isAdmin($user)
{
    if ($user === "4" || $user === "5") {
    } else {
        Redirect::to(404);
        exit;
    }
}

function isVP($user)
{
    if ($user === "2") {
    } else {
        Redirect::to(404);
        exit;
    }
}

function isDean($user)
{
    if ($user === "3") {
    } else {
        Redirect::to(404);
        exit;
    }
}

function isRegistrar($user)
{
    if ($user === "4") {
    } else {
        Redirect::to(404);
        exit;
    }
}

function isSRA($user)
{
    if ($user === "5") {
    } else {
        Redirect::to(404);
        exit;
    }
}

function isInstructor($user)
{
    if ($user === "6") {
    } else {
        Redirect::to(404);
        exit;
    }
}

function getUserLevel(){
    $user = new user();
     return $user->data()->groups;
}


function profilePic()
{
    $view = new view();
    if ($view->getdpUser() !== null || $view->getdpUser() !== null) {
        echo "'data:" . $view->getMmUser() . ";base64," . base64_encode($view->getdpUser()) . "'";
    } else {
        echo "'/coco-starterkit/resource/img/user.jpg'";
    }
}

function UserSignature()
{
    $view = new view();
    if ($view->getSignatureUser() !== null) {
        echo "<img src='../upload/signature/". $view->getSignatureUser()."'";
        echo 'alt="image" height="120px">';
    } else {
        echo '<img src="/coco-starterkit/resource/img/em.png"';
        echo 'alt="image" height="120px">';
    }
}





function updateProfile()
{
    if (input::exists()) {
        if (!empty($_POST['collegedept'])) {
        } else {
            $_POST['collegedept'] = "";
        }

        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'username' => array(
                'required' => 'true',
                'min' => 4,
                'max' => 20,
                'unique' => 'tbl_accounts'
            ),
            'fullName' => array(
                'required' => 'true',
                'min' => 2,
                'max' => 50,
            ),
            'collegedept' => array(
                'required' => 'true'
            )
        ));

        if ($validate->passed()) {
            $user = new user();

            try {
                $user->update(array(
                    'username' => input::get('username'),
                    'name' => input::get('fullName'),
                    'collegedept' => input::get('collegedept'),
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('ProfileSuccess');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}


function changeEmail()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'New_Email' => array(
                'required' => 'true',
            ),
            'Confirm_Email' => array(
                'required' => 'true',
                'matches' => 'New_Email'

            ),
            'Password' => array(
                'unique' => 'tbl_accounts'
            )
        ));

        if ($validate->passed()) {
            $user = new user();
            if (Hash::make(input::get('Password'), $user->data()->salt) !== $user->data()->password) {
                curpassError();
            } else {
                $user = new user();
                try {
                    $user->update(array(
                        'email' => input::get('New_Email'),
                    ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                CheckSuccess('EmailSuccess');
            }
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}


function changeP()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'password_current' => array(
                'required' => 'true',
            ),
            'password' => array(
                'required' => 'true',
                'min' => 6,
            ),
            'ConfirmPassword' => array(
                'required' => 'true',
                'matches' => 'password'
            )
        ));

        if ($validate->passed()) {
            $user = new user();
            if (Hash::make(input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                curpassError();
            } else {
                $user = new user();
                $salt = Hash::salt(32);
                try {
                    $user->update(array(
                        'password' => Hash::make(input::get('password'), $salt),
                        'salt' => $salt
                    ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                CheckSuccess('PasswordSuccess');
            }
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}

function encrypt($plainText, $key)
{
    $secretKey = md5($key);
    $iv = substr(hash('sha256', "aaaabbbbcccccddddeweee"), 0, 16);
    $encryptedText = openssl_encrypt($plainText, 'AES-128-CBC', $secretKey, OPENSSL_RAW_DATA, $iv);
    return base64_encode($encryptedText);
}

function decrypt($encryptedText, $key)
{
    $key = md5($key);
    $iv = substr(hash('sha256', "aaaabbbbcccccddddeweee"), 0, 16);
    $decryptedText = openssl_decrypt(base64_decode($encryptedText), 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decryptedText;
}

function generateRandomString($length = 9)
{
    $characters = '012345678987654321';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function transCOG()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'transaction_id' => array(
                'required' => 'true',
                'matches_sesssion' => 'transaction_id'
            ),
            'class_code' => array(
                'required' => 'Class Code',
            ),
            'subject' => array(
                'required' => 'Subject',
            ),
            'semester' => array(
                'required' => 'Semester',
            ),
            'ter' => array(
                'required' => 'Semester',
            ),
            'school_year' => array(
                'required' => 'School Year',
                'schoolyear' => 'true',
            ),
            'collegedept' => array(
                'required' => 'College',
            ),
        ));
        if ($validate->passed()) {
            $insert = new insert;
            $user = new user();
            $user->data()->id;
            try {
                $insert->insertTransaction(array(
                    'transId' => input::get('transaction_id'),
                    'term' => input::get('ter'),
                    'clCode' => escape(strtoupper(input::get('class_code'))),
                    'subj' => escape(ucfirst(input::get('subject'))),
                    'sem' => escape(input::get('semester')),
                    'sy' => input::get('school_year'),
                    'collegedept' => input::get('collegedept'),
                    'user_id' => $user->data()->id,
                    'date_applied' => date('Y-m-d H:i:s'),
                    'RequestStatus' => 'SRA'
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('FSuccessT');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}

function stdCOG()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'student_name' => array(
                'required' => 'Student Name'
            ),
            '1' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '2' => array(
                'numeric' => 'true',
                'maxnumber' => '5'

            ),
            '3' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '4' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '5' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '6' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '7' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '8' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '9' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '10' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '11' => array(
                'numeric' => 'true',
                'maxnumber' => '5',
                'required' => 'Final Rating'
            ),
        ));
        if ($validate->passed()) {
            $insert = new insert;
            $user = new user();
            $user->data()->id;
            try {
                $insert->insertStudent(array(
                    'transId' => input::get('transaction_id'),
                    'clCode' => input::get('class_code'),
                    'stdName' => escape(ucwords(input::get('student_name'))),
                    'course' => input::get('course'),

                    'clPartLec' => input::get('1'),
                    'perExLec' => input::get('2'),
                    'perGrLec' => input::get('3'),

                    'clPartLab' => input::get('4'),
                    'perExLab' => input::get('5'),
                    'perGrLab' => input::get('6'),
                    'weiGr' => input::get('7'),

                    'onePerGr' => input::get('8'),
                    'twoPerGr' => input::get('9'),
                    'threePerGr' => input::get('10'),
                    'finRate' => input::get('11'),

                    'user_id' => $user->data()->id
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('FSuccessS');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}

function transCOGP()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'transaction_id' => array(
                'required' => 'true',
                'matches_sesssion' => 'transaction_id'
            ),
            'class_code' => array(
                'required' => 'Class Code',
            ),
            'subject' => array(
                'required' => 'Subject',
            ),
            'semester' => array(
                'required' => 'Semester',
            ),
            'school_year' => array(
                'required' => 'School Year',
                'schoolyear' => 'true',
            ),
            'collegedept' => array(
                'required' => 'College',
            ),
        ));
        if ($validate->passed()) {
            $insert = new insert;
            $user = new user();
            $user->data()->id;
            try {
                $insert->insertTransaction(array(
                    'transId' => input::get('transaction_id'),
                    'clCode' => escape(strtoupper(input::get('class_code'))),
                    'subj' => escape(ucfirst(input::get('subject'))),
                    'sem' => escape(input::get('semester')),
                    'sy' => input::get('school_year'),
                    'collegedept' => input::get('collegedept'),
                    'user_id' => $user->data()->id,
                    'type' => 'COGP',
                    'date_applied' => date('Y-m-d H:i:s'),
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('FSuccessT');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}
function stdCOGP()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'student_name' => array(
                'required' => 'Student Name'
            ),
            '1' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '2' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '3' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '4' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '5' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '6' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '7' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '8' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '9' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '10' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '11' => array(
                'numeric' => 'true',
                'maxnumber' => '5',
                'required' => 'Final Rating'
            ),
        ));
        if ($validate->passed()) {
            $insert = new insert;
            $user = new user();
            $user->data()->id;
            try {
                $insert->insertStudent(array(
                    'transId' => input::get('transaction_id'),
                    'clCode' => input::get('class_code'),
                    'stdName' =>  escape(ucwords(input::get('student_name'))),
                    'course' => input::get('course'),

                    'clPartLec' => input::get('1'),
                    'perExLec' => input::get('2'),
                    'perGrLec' => input::get('3'),

                    'clPartLab' => input::get('4'),
                    'perExLab' => input::get('5'),
                    'perGrLab' => input::get('6'),
                    'weiGr' => input::get('7'),

                    'onePerGr' => input::get('8'),
                    'twoPerGr' => input::get('9'),
                    'threePerGr' => input::get('10'),
                    'finRate' => input::get('11'),

                    'user_id' => $user->data()->id,
                    'RequestStatus' => 'DEAN'
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('FSuccessS');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}

function transCCG()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'transaction_id' => array(
                'required' => 'true',
                'matches_sesssion' => 'transaction_id'
            ),
            'class_code' => array(
                'required' => 'Class Code',
            ),
            'subject' => array(
                'required' => 'Subject',
            ),
            'semester' => array(
                'required' => 'Semester',
            ),
            'school_year' => array(
                'required' => 'School Year',
                'schoolyear' => 'true',
            ),
            'collegedept' => array(
                'required' => 'College',
            ),
        ));
        if ($validate->passed()) {
            $insert = new insert;
            $user = new user();
            $user->data()->id;
            try {
                $insert->insertTransaction(array(
                    'transId' => input::get('transaction_id'),
                    'clCode' => escape(strtoupper(input::get('class_code'))),
                    'subj' => escape(ucfirst(input::get('subject'))),
                    'sem' => escape(input::get('semester')),
                    'sy' => escape(input::get('school_year')),
                    'collegedept' => escape(input::get('collegedept')),
                    'user_id' => $user->data()->id,
                    'type' => 'CCG',
                    'date_applied' => date('Y-m-d H:i:s'),
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('FSuccessT');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}

function stdCCG()
{
    if (input::exists()) {
        $validate = new Validate;
        $validate = $validate->check($_POST, array(
            'student_name' => array(
                'required' => 'Student Name'
            ),
            '1' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '2' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '3' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '4' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '5' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '6' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '7' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '8' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '9' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '10' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '11' => array(
                'numeric' => 'true',
                'maxnumber' => '5',
                'required' => 'Final Rating'
            ),
            '12' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '13' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '14' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
            '15' => array(
                'numeric' => 'true',
                'maxnumber' => '5'
            ),
        ));
        if ($validate->passed()) {
            $insert = new insert;
            $user = new user();
            $user->data()->id;
            try {
                $insert->insertStudent(array(
                    'transId' => input::get('transaction_id'),
                    'clCode' => input::get('class_code'),
                    'stdName' => escape(ucwords(input::get('student_name'))),
                    'course' => input::get('course'),

                    'clPartLec' => input::get('1'),
                    'perExLec' => input::get('2'),
                    'perGrLec' => input::get('3'),

                    'clPartLab' => input::get('4'),
                    'perExLab' => input::get('5'),
                    'perGrLab' => input::get('6'),
                    'weiGr' => input::get('7'),

                    'clPartCor' => input::get('12'),
                    'perExCor' => input::get('13'),
                    'perGrCor' => input::get('14'),
                    'weiGrCor' => input::get('15'),

                    'onePerGr' => input::get('8'),
                    'twoPerGr' => input::get('9'),
                    'threePerGr' => input::get('10'),
                    'finRate' => input::get('11'),

                    'user_id' => $user->data()->id,
                    'RequestStatus' => 'DEAN'
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }
            CheckSuccess('FSuccessS');
        } else {
            foreach ($validate->errors() as $error) {
                pError($error);
            }
        }
    }
}
