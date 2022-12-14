<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php';
require_once 'config.php';

class view extends config{

        public function collegeSP2(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_college`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->collegedept.'." value="'.$row->collegedept.'">'.$row->collegedept.'</option>';
                  echo 'success';
                }
        }

        public function CollegeLS1(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_college`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option value="'.$row->id.'">'.$row->collegedept.'</option>';
                }
        }
        public function CourseLS1(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_course`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option value="'.$row->abvcourse.'">'.$row->course.'</option>';
                }
        }

        public function getdpUser(){
            $user = new user();
            return $user->data()->dp;
        }

        public function getMmUser(){
            $user = new user();
             return $user->data()->nm;
        }
 
        public function getSignatureUser(){
            $user = new user();
             return $user->data()->signature;
        }


        public function fetch_grades($id)
        {
            try {
                
                $config = new config;
                $con = $config->con();
                $sql = "SELECT * FROM `tbl_grades` WHERE `transId` = :id";
                $query = $con->prepare($sql);
                $query->bindParam("id", $id, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    return $query->fetch(PDO::FETCH_OBJ);
                }
            } catch (PDOException $e) {
                
            }
        }
        public function fetch_transaction($id = null, $clcode = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT * FROM `tbl_transaction` WHERE `transId` = :id AND  `clCode` = :clcode" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $id, PDO::PARAM_STR);  
                $data->bindParam("clcode", $clcode, PDO::PARAM_STR);
                $data->execute();
            if ($data->rowCount() > 0) {
                return $data->fetch(PDO::FETCH_OBJ);
            }
            } catch (PDOException $e) {
            }
        }

        public function isPending($id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT * FROM `tbl_transaction` WHERE `transId` = :id AND `status` = 'SUBMITTED'";
                $data= $con->prepare($sql);
                $data->bindParam("id", $id, PDO::PARAM_STR);  
                $data->execute();
            if ($data->rowCount() > 0) {
                return $data->fetch(PDO::FETCH_OBJ);
            }
            } catch (PDOException $e) {
               
            }
        }

        public static function statusTrackNo($id)
        {
            try {
                
                $config = new config;
                $con = $config->con();
                $sql = "SELECT `statusTracker` FROM `tbl_transaction` WHERE `transId` = :id";
                $query = $con->prepare($sql);
                $query->bindParam("id", $id, PDO::PARAM_STR);
                $query->execute();
                return $query->fetchColumn();
            } catch (PDOException $e) {
                
            }
        }

        public function viewTransasction($id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql = "SELECT 
                `transId` as transaction_id, 
                `clCode` as class_code,
                `subj` as 'subject',
                `sem` as semester,
                `sy` as school_year,
                `collegedept` as college_department,
                `term` as ter,
                `user_id` as 'uid',
                `statusTracker`,
                `RequestStatus` as 'rs',
                
                `date_applied` as 'submitted_date',
                `verDate` as 'verified_date',
                `appDate` as 'approved_date',
                `attDate` as 'attested_date',
                `recDate` as 'recommended_date',
                `appencDate` as 'approvedenc_date',
                `rejDate` as 'rejected_date',

                `remarks`, isVerified, isArchive,

                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy,
                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`recBy`= `tbl_accounts`.`id`) as recoBy,
                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`verBy`= `tbl_accounts`.`id`) as verifiedBy,
                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`appBy`= `tbl_accounts`.`id`) as approvedBy,
                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`appencBy`= `tbl_accounts`.`id`) as approvedforencodingBy,
                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`attBy`= `tbl_accounts`.`id`) as attestedBy,
                (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`rejBy`= `tbl_accounts`.`id`) as rejectedBy
                FROM `tbl_transaction` WHERE `tbl_transaction`.`id`= :id;";

                $query = $con->prepare($sql);
                $query->bindParam("id", $id, PDO::PARAM_STR);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                if ($row > 0) {
                    $row['submitted_date'] = date('M j, Y, h:i A', strtotime ($row['submitted_date']));
                    $row['verified_date'] = date('M j, Y, h:i A', strtotime ($row['verified_date']));
                    $row['approved_date'] = date('M j, Y, h:i A', strtotime ($row['approved_date']));
                    $row['attested_date'] = date('M j, Y, h:i A', strtotime ($row['attested_date']));
                    $row['recommended_date'] = date('M j, Y, h:i A', strtotime ($row['recommended_date']));
                    $row['approvedenc_date'] = date('M j, Y, h:i A', strtotime ($row['approvedenc_date']));
                    $row['rejected_date'] = date('M j, Y, h:i A', strtotime ($row['rejected_date']));
                    }
                $filter = array_filter($row);
                echo json_encode($filter);
            
            } catch (PDOException $e) {
               
            }
        }



        
        public function count_grades($id = null, $clcode = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_grades` WHERE `transId` = :id AND  `clCode` = :clcode" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $id, PDO::PARAM_STR);  
                $data->bindParam("clcode", $clcode, PDO::PARAM_STR);
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }





        public static function count_PendingCOG_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'COG' AND `status` = 'SUBMITTED' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }

        public static function count_OngoingCOG_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'COG' AND `status` = 'PENDING' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }


        public static function count_CompletedCOG_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'COG' AND `status` = 'APPROVED' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }

        public static function count_PendingCOGP_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'COGP' AND `status` = 'SUBMITTED' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }

        public static function count_OngoingCOGP_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'COGP' AND `status` = 'PENDING' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }


        public static function count_CompletedCOGP_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'COGP' AND `status` = 'APPROVED' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }


        
        public static function count_PendingCCG_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'CCG' AND `status` = 'SUBMITTED' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }

        public static function count_OngoingCCG_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'CCG' AND `status` = 'PENDING' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }


        public static function count_CompletedCCG_Instructor($user_id = null)
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT COUNT(*) FROM `tbl_transaction`  WHERE `type` = 'CCG' AND `status` = 'APPROVED' AND `user_id` = :id" ;
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }

        public static function count_TotalTransactionforThisMonth()
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT SUM(LAST_DAY(date_applied) = LAST_DAY(CURDATE())) this_month FROM tbl_transaction";
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }

        public static function count_TotalTransactionApprovedforThisMonth()
        {
            try {
                $config = new config;
                $con = $config->con();
                $sql =  "SELECT SUM(LAST_DAY(attdate) = LAST_DAY(CURDATE())) this_month FROM tbl_transaction";
                $data= $con->prepare($sql);
                $data->bindParam("id", $user_id, PDO::PARAM_STR);  
                $data->execute();
                return $data->fetchColumn();
            } catch (PDOException $e) {
            }
        }



        
}
