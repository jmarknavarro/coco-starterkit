<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/core/init.php';
if(isset($_POST['id'])){
    $id = decrypt($_POST['id'], "_johnmarknavarro");
    $view = new view();
    $fetch = $view->viewTransasction($id);
 }

?>