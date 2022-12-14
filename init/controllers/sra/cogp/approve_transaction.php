<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (trim($_POST['transaction_id']) == "") {
        $smessage = 'Transaction Id field is required!';
    } else {
        $update = new update();
        $upd = $update->approveSRA_COGP($_POST['transaction_id']);
        echo '<script> setTimeout(function() {  window.history.go(-0); }, 1700); </script>';
    }
} if ($smessage!="") {
    echo "<div class='alert alert-danger'>".$smessage."</div>";
}
