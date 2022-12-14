<?php
class delete  {
 
    // public function delete_transaction($transId){
    //     $this->_db = DB::getInstance();
    //     $this->_db->delete('tbl_transaction',array('transId','=',$transId));
    // }

    public function delete_student($id){
        $this->_db = DB::getInstance();
        $this->_db->delete('tbl_grades',array('id','=',$id));
    }

    public function delete_transaction($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'CANCELLED' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    



}
