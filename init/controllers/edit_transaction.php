<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/core/init.php';
$emessage="";
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (trim($_POST['transaction_id']) == "") {
        $emessage = 'transId field is required!';
    } elseif (trim($_POST['class_code'])  == "") {
        $emessage = 'Class Code field is required!';
    } elseif (trim($_POST['subject'])  == "") {
        $emessage = 'Subject field is required!';
    } elseif (trim($_POST['semester'])  == "") {
        $emessage = 'Semester field is required!';
    } elseif (trim($_POST['school_year'])  == "") {
        $emessage = 'School field is required!';
    } elseif (!preg_match('/^\d{4}-\d{4}$/', $_POST['school_year'])) {
        $emessage = 'Please follow school year format: (XXXX-XXXX)';
    } else {
        if (Token::check($_POST['token'])) {
            $update = new update();
            $upd = $update->edit_TCOG($_POST['transaction_id'], escape(strtoupper($_POST['class_code'])), escape(ucfirst($_POST['subject'])), $_POST['semester'], escape($_POST['school_year']), $_POST['college'], $_POST['ter']);
            echo '<script> setTimeout(function() {  window.history.go(-0); }, 1700); </script>';
        } else {
            exit;
        }
    }
}
?>