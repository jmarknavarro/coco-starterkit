<?php

class config{
    // LIVE SERVER
    // private $user = 'ceumlsre_root';
    // private $password = 'Eg5c272klko5';

    // LOCAL SERVER
    private $user = 'root';
    private $password = '';


    public $pdo = null;

    public function con(){
        try {
            // LIVE SERVER
            // $this->pdo = new PDO('mysql:host=109.106.254.186:3306;dbname=ceumlsre_coco', $this->user, $this->password);

            // LOCAL SERVER
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=coco', $this->user, $this->password);
            } catch (PDOException $e) {
                die($e->getMessage());
        }
        return $this->pdo;

    }
}

 ?>
