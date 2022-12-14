<?php
class insert
{
    private $_db, $_data;

    public function insertTransaction($fields){
        $this->_db = DB::getInstance();
        if($this->_db->insert('tbl_transaction',$fields)){
            return true;
        }else{
            return false;
        }
    }


    public function insertStudent($fields){
        $this->_db = DB::getInstance();
        if($this->_db->insert('tbl_grades',$fields)){
            return true;
        }else{
            return false;
        }
    }

}
