<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/core/init.php';
$user = new user();
$user->logout();
Redirect::to('login');
 ?>
