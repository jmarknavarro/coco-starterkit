<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php';
$view = new view();
$sNo = $view->statusTrackNo($_POST['action']);
$statustracker = new statusTracker($sNo);
$statustracker->statusCOG();
?>