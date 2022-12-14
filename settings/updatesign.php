<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/coco-starterkit/init/class/config.php';
$user = new user();

if (isset($_POST['signed'])) {
    if (trim($_POST['signed']) == "") {
        Redirect::to('index.php');
    } else {
        $file_path = "../upload/signature/";
        $image_parts = explode(";base64,", $_POST['signed']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file =  $file_path . uniqid() . '.' . $image_type;
        $fileName =  uniqid() . '.' . $image_type;
        $data = file_put_contents("../upload/signature/" . $fileName, $image_base64);
        try {
            $user->update(array(
                'signature' => $fileName
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
        Redirect::to('index.php');
    }
} else {
    Redirect::to('index.php');
}
