<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/config.php';
$user = new user();

if(isset($_POST['image'])){
     $name = $_POST['image']['name'];
     $type = $_POST['image']['type'];
     $imageName = time() . '.png';
     $data = file_get_contents($_POST['image']);
    try {
        $user->update(array(
            'nm'=>$imageName,
            'dp'=> $data
        ));
    } catch (Exception $e) {
        die($e->getMessage());
    }
}else{
}
 ?>
