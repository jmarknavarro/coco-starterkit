<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/core/init.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (trim($_POST['transaction_id']) == "") {
        $smessage = 'transaction_id field is required!';
    } else {
        $update = new update();
        $upd = $update->declineSRA_COGP($_POST['transaction_id'],$_POST['remarks']);
        echo '<script> setTimeout(function() {  window.history.go(-0); }, 1700); </script>';
    }
} if ($smessage!="") {
    echo "<div class='alert alert-danger'>".$smessage."</div>";
}
