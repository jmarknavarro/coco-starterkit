<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/vendor/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php';
require_once 'config.php';

class update extends config
{

    public function edit_TCOG($transId, $clCode, $subj, $sem, $sy, $college, $term)
    {
        try {
            $config = new config;
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET `clCode`= :clCode,`subj`= :subj, `sem`= :sem, `sy`= :sy, `collegedept`= :college, `term`= :term WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':clCode' => $clCode,
                ':subj' => $subj,
                ':sem' => $sem,
                ':sy' => $sy,
                ':college' => $college,
                ':term' => $term,
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function approveSRA_TCOG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING', `statusTracker`= '1', `RequestStatus`= 'REGISTRAR', `verBy` = :verBy, `verDate` = :verDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'REGISTRAR' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':verBy' => $user->data()->id,
                ':verDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function declineSRA_TCOG($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED', `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function attestedSRA_TCOG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'APPROVED', `statusTracker`= '3', `attBy` = :attBy, `attDate` = :attDate, `isVerified` = 1  WHERE `transId` = :transId;";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':attBy' => $user->data()->id,
                ':attDate' => date('Y-m-d H:i:s')        
            ));

            $con = $config->con();
            $sql2 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query2 = $con->prepare($sql2);
            $query2->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $query2->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();
        
            sendApprovedEmail($transId, $fullname, $email);
            
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function approveRegistrar_TCOG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING', `statusTracker`= '2', `RequestStatus`= 'SRA', `appBy` = :appBy, `appDate` = :appDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':appBy' => $user->data()->id,
                ':appDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function declineRegistrar_TCOG($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED', `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

// COGP

    public function approveDean_COGP($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING',  `statusTracker`= '1',  `RequestStatus`= 'SRA', `recBy` = :recBy, `recDate` = :recDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':recBy' => $user->data()->id,
                ':recDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    
    public function declineDean_COGP($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function approveSRA_COGP($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING',  `statusTracker`= '2',  `RequestStatus`= 'REGISTRAR', `verBy` = :verBy, `verDate` = :verDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'REGISTRAR' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':verBy' => $user->data()->id,
                ':verDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

        
    public function declineSRA_COGP($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function approveRegistrar_COGP($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING', `statusTracker`= '3',  `RequestStatus`= 'SRA2', `appBy` = :appBy, `appDate` = :appDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA2' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':appBy' => $user->data()->id,
                ':appDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function declineRegistrar_COGP($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function attestedSRA_COGP($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'APPROVED',  `statusTracker`= '4', `RequestStatus`= 'SRA',  `attBy` = :attBy, `attDate` = :attDate, `isVerified` = 1  WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':attBy' => $user->data()->id,
                ':attDate' => date('Y-m-d H:i:s')
            ));

            $con = $config->con();
            $sql2 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query2 = $con->prepare($sql2);
            $query2->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $query2->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();
        
            sendApprovedEmail($transId, $fullname, $email);
            
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function approveDean_CCG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING', `statusTracker`= '1', `RequestStatus`= 'VP', `recBy` = :recBy, `recDate` = :recDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':recBy' => $user->data()->id,
                ':recDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function declineDean_CCG($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    

    public function approveVP_CCG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING', `statusTracker`= '2', `RequestStatus`= 'REGISTRAR', `appBy` = :appBy, `appDate` = :appDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'REGISTRAR' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':appBy' => $user->data()->id,
                ':appDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function declineVP_CCG($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }


    
    public function approveRegistrar_CCG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING', `statusTracker`= '3', `RequestStatus`= 'SRA', `appencBy` = :appencBy, `appencDate` = :appencDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':appencBy' => $user->data()->id,
                ':appencDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function declineRegistrar_CCG($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }


    public function approveSRA_CCG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'PENDING',`statusTracker`= '4', `RequestStatus`= 'SRA2', `verBy` = :verBy, `verDate` = :verDate WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA2' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':verBy' => $user->data()->id,
                ':verDate' => date('Y-m-d H:i:s')
            ));
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function attestedSRA_CCG($transId)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'APPROVED', `statusTracker`= '5', `RequestStatus`= 'SRA',  `attBy` = :attBy, `attDate` = :attDate, `isVerified` = 1  WHERE `transId` = :transId;
             UPDATE `tbl_grades` SET `RequestStatus`= 'SRA' WHERE `transId` = :transId";
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':attBy' => $user->data()->id,
                ':attDate' => date('Y-m-d H:i:s')
            ));
            
            $con = $config->con();
            $sql2 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query2 = $con->prepare($sql2);
            $query2->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $query2->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();
        
            sendApprovedEmail($transId, $fullname, $email);
            
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
        
    public function declineSRA_CCG($transId,$remarks)
    {
        try {
            $config = new config;
            $user = new user();
            $con = $config->con();
            $sql = "UPDATE `tbl_transaction` SET  `status`= 'REJECTED',  `rejBy` = :rejBy, `rejDate` = :rejDate, `remarks`= :remarks  WHERE `transId` = :transId; 
             UPDATE `tbl_grades` SET `RequestStatus`= 'REJECTED' WHERE `transId` = :transId";   
            $query = $con->prepare($sql);
            $query->execute(array(
                ':transId' => $transId,
                ':rejBy' => $user->data()->id,
                ':rejDate' => date('Y-m-d H:i:s'),
                ':remarks' => $remarks
            
            ));

            $con = $config->con();
            $sql3 = "SELECT (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $data3 = $con->prepare($sql3);
            $data3->execute(array(
                ':transId' => $transId,        
            ));
            $fullname = $data3->fetchColumn();

            $con = $config->con();
            $sql2 = "SELECT (SELECT `email` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy FROM `tbl_transaction` WHERE `tbl_transaction`.`transId`= :transId;";
            $query3 = $con->prepare($sql2);
            $query3->execute(array(
                ':transId' => $transId,        
            ));
            $email = $query3->fetchColumn();

            sendDeniedEmail($transId, $fullname, $email, $remarks);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    // public function archive_transaction($id)
    // {
    //     try {
    //         $config = new config;
    //         $user = new user();
    //         $con = $config->con();
    //         $sql = "UPDATE `tbl_transaction` SET  `isArchive` = 1 WHERE `id` = :id";     
    //         $query = $con->prepare($sql);
    //         $query->execute(array(
    //             ':id' => $id,
    //        ));
    //     } catch (PDOException $e) {
    //         exit($e->getMessage());
    //     }
    // }





}
