<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/core/init.php';
require_once 'config.php';

class reportstable extends config{



    public static function reportsCOG_SRA(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT *, (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy 
        FROM `tbl_transaction` WHERE `type` = 'COG' AND `status` IN ('SUBMITTED', 'PENDING','REJECTED', 'APPROVED');";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        echo "<thead >";
        echo "<tr>";
        echo "<th>Transaction ID</th>";
        echo "<th>Class Code</th>";
        echo "<th>Subject</th>";
        echo "<th>Semester</th>";
        echo "<th>Term</th>";
        echo "<th>School Year</th>";
        echo "<th>Submitted By</th>";
        echo "<th>Date Created</th>";
        echo "<th>Date Approved</th>";
        echo "<th>Status</th>";
        echo "<th>More</th>";
        echo "</tr>";
        echo "</thead>";
        foreach ($result as $data) {
          $hash_id = encrypt($data['id'], "_johnmarknavarro");
          $hash_transid = encrypt($data['transId'], "_johnmarknavarro");
          $hash_transid2 = crypto::encrypt($data['transId'], "_johnmarknavarro");
        echo "<tr>";
        echo "<td>
        <a class='text-center text-body font-weight-medium' href='./students?id=$data[transId]&classcode=$data[clCode]'>$data[transId]</a>";
        echo "</td>";
        echo "<td>$data[clCode]</td>";
        echo "<td>$data[subj]</td>";
        echo "<td>$data[sem]</td>";
        echo "<td>$data[term]</td>";
        echo "<td>$data[sy]</td>";
        echo "<td>$data[submittedBy]</td>";
        echo "<td data-type='date'>";
  echo date('M j, Y, h:i A', strtotime ($data['date_applied']));
  echo "</td>";


        if($data['attDate'] == ''){
          echo "<td class='text-muted'>N/A</td>";
        }else{
        echo "<td data-type='date'>";
  echo date('M j, Y, h:i A', strtotime ($data['attDate']));
  echo "</td>";
};
        
        if($data['status'] == 'SUBMITTED'){
          echo "<td class='text-center'><span class='badge badge-warning'>Pending</span></td>";
        }else if($data['status'] == 'PENDING'){
          echo "<td class='text-center'><span class='badge badge-info'>In Progress</span></td>";
        } else if($data['status'] == 'REJECTED'){
          echo "<td class='text-center'><span class='badge badge-danger'>Expired</span></td>";
        }  else if($data['status'] == 'APPROVED'){
            echo "<td class='text-center'><span class='badge badge-success'>Approved</span></td>";
        } else {
          echo "<td class='text-center'><span class='badge badge-light'>Cancelled</span></td>";
        };

        if($data['status'] == 'REJECTED'){
          echo "<td class='text-center'>
        <div class='dropdown sub-dropdown'>
        <button class='btn btn-link text-muted dropdown-toggle' type='button'
            id='dd1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i data-feather='more-vertical'></i> </button>
        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dd1'>

        <a class='dropdown-item' href='./students?id=$data[transId]&classcode=$data[clCode]'>View Student List</i></a>
        <a class='dropdown-item decline_D' data-target='#decline-details' data-toggle='modal' href='' data-id='$hash_id' >View Details</i></a>
        </div>
       </td>";
        } else {
          echo "<td class='text-center'>
          <div class='dropdown sub-dropdown'>
          <button class='btn btn-link text-muted dropdown-toggle' type='button'
              id='dd1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i data-feather='more-vertical'></i> </button>
          <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dd1'>
  
          <a class='dropdown-item' href='./students?id=$data[transId]&classcode=$data[clCode]'>View Student List</i></a>
          <a class='dropdown-item approve_D' data-target='#approve3-details' data-toggle='modal' href='' data-id='$hash_id' >View Details</i></a>
          </div>
         </td>";
        };

        echo "</tr>";
        }  
      }
      

      public static function reportsCOGP_SRA(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT *, (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy 
        FROM `tbl_transaction` WHERE `type` = 'COGP' AND `status` IN ('SUBMITTED', 'PENDING','REJECTED', 'APPROVED');";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        echo "<thead >";
        echo "<tr>";
        echo "<th>Transaction ID</th>";
        echo "<th>Class Code</th>";
        echo "<th>Subject</th>";
        echo "<th>Semester</th>";
        echo "<th>School Year</th>";
        echo "<th>Submitted By</th>";
        echo "<th>Date Created</th>";
        echo "<th>Date Approved</th>";
        echo "<th>Status</th>";
        echo "<th>More</th>";
        echo "</tr>";
        echo "</thead>";
        foreach ($result as $data) {
          $hash_id = encrypt($data['id'], "_johnmarknavarro");
          $hash_transid = encrypt($data['transId'], "_johnmarknavarro");
          $hash_transid2 = crypto::encrypt($data['transId'], "_johnmarknavarro");
        echo "<tr>";
        echo "<td>
        <a class='text-center text-body font-weight-medium' href='./students?id=$data[transId]&classcode=$data[clCode]'>$data[transId]</a>";
        echo "</td>";
        echo "<td>$data[clCode]</td>";
        echo "<td>$data[subj]</td>";
        echo "<td>$data[sem]</td>";
        echo "<td>$data[sy]</td>";
        echo "<td>$data[submittedBy]</td>";
        echo "<td data-type='date'>";
  echo date('M j, Y, h:i A', strtotime ($data['date_applied']));
  echo "</td>";

        if($data['attDate'] == ''){
          echo "<td class='text-muted'>N/A</td>";
        }else{
        echo "<td data-type='date'>";
  echo date('M j, Y, h:i A', strtotime ($data['attDate']));
  echo "</td>";
};
        // echo "<td>$data[status]</td>";
        if($data['status'] == 'SUBMITTED'){
          echo "<td class='text-center'><span class='badge badge-warning'>Pending</span></td>";
        }else if($data['status'] == 'PENDING'){
          echo "<td class='text-center'><span class='badge badge-info'>In Progress</span></td>";
        } else if($data['status'] == 'REJECTED'){
          echo "<td class='text-center'><span class='badge badge-danger'>Expired</span></td>";
        }  else if($data['status'] == 'APPROVED'){
            echo "<td class='text-center'><span class='badge badge-success'>Approved</span></td>";
        } else {
          echo "<td class='text-center'><span class='badge badge-light'>Cancelled</span></td>";
        };

        if($data['status'] == 'REJECTED'){
          echo "<td class='text-center'>
        <div class='dropdown sub-dropdown'>
        <button class='btn btn-link text-muted dropdown-toggle' type='button'
            id='dd1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i data-feather='more-vertical'></i> </button>
        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dd1'>

        <a class='dropdown-item' href='./students?id=$data[transId]&classcode=$data[clCode]'>View Student List</i></a>
        <a class='dropdown-item decline_D' data-target='#decline-details' data-toggle='modal' href='' data-id='$hash_id' >View Details</i></a>
        </div>
       </td>";
        } else {
          echo "<td class='text-center'>
          <div class='dropdown sub-dropdown'>
          <button class='btn btn-link text-muted dropdown-toggle' type='button'
              id='dd1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i data-feather='more-vertical'></i> </button>
          <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dd1'>
  
          <a class='dropdown-item' href='./students?id=$data[transId]&classcode=$data[clCode]'>View Student List</i></a>
          <a class='dropdown-item approve_D' data-target='#approve3-details' data-toggle='modal' href='' data-id='$hash_id' >View Details</i></a>
          </div>
         </td>";
        };

        echo "</tr>";
        }  
      }
      
      public static function reportsCCG_SRA(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT *, (SELECT `name` FROM `tbl_accounts` WHERE `tbl_transaction`.`user_id`= `tbl_accounts`.`id`) as submittedBy 
        FROM `tbl_transaction` WHERE `type` = 'CCG' AND `status` IN ('SUBMITTED', 'PENDING','REJECTED', 'APPROVED');";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        echo "<thead >";
        echo "<tr>";
        echo "<th>Transaction ID</th>";
        echo "<th>Class Code</th>";
        echo "<th>Subject</th>";
        echo "<th>Semester</th>";
        echo "<th>School Year</th>";
        echo "<th>Submitted By</th>";
        echo "<th>Date Created</th>";
        echo "<th>Date Approved</th>";
        echo "<th>Status</th>";
        echo "<th>More</th>";
        echo "</tr>";
        echo "</thead>";
        foreach ($result as $data) {
          $hash_id = encrypt($data['id'], "_johnmarknavarro");
          $hash_transid = encrypt($data['transId'], "_johnmarknavarro");
          $hash_transid2 = crypto::encrypt($data['transId'], "_johnmarknavarro");
        echo "<tr>";
        echo "<td>
        <a class='text-center text-body font-weight-medium' href='./students?id=$data[transId]&classcode=$data[clCode]'>$data[transId]</a>";
        echo "</td>";
        echo "<td>$data[clCode]</td>";
        echo "<td>$data[subj]</td>";
        echo "<td>$data[sem]</td>";
        echo "<td>$data[sy]</td>";
        echo "<td>$data[submittedBy]</td>";
        echo "<td data-type='date'>";
  echo date('M j, Y, h:i A', strtotime ($data['date_applied']));
  echo "</td>";

         if($data['attDate'] == ''){
          echo "<td class='text-muted'>N/A</td>";
        }else{
        echo "<td data-type='date'>";
  echo date('M j, Y, h:i A', strtotime ($data['attDate']));
  echo "</td>";
};
        // echo "<td>$data[status]</td>";
        if($data['status'] == 'SUBMITTED'){
          echo "<td class='text-center'><span class='badge badge-warning'>Pending</span></td>";
        }else if($data['status'] == 'PENDING'){
          echo "<td class='text-center'><span class='badge badge-info'>In Progress</span></td>";
        } else if($data['status'] == 'REJECTED'){
          echo "<td class='text-center'><span class='badge badge-danger'>Expired</span></td>";
        }  else if($data['status'] == 'APPROVED'){
            echo "<td class='text-center'><span class='badge badge-success'>Approved</span></td>";
        } else {
          echo "<td class='text-center'><span class='badge badge-light'>Cancelled</span></td>";
        };
        if($data['status'] == 'REJECTED'){
          echo "<td class='text-center'>
        <div class='dropdown sub-dropdown'>
        <button class='btn btn-link text-muted dropdown-toggle' type='button'
            id='dd1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i data-feather='more-vertical'></i> </button>
        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dd1'>

        <a class='dropdown-item' href='./students?id=$data[transId]&classcode=$data[clCode]'>View Student List</i></a>
        <a class='dropdown-item decline_D' data-target='#decline-details' data-toggle='modal' href='' data-id='$hash_id' >View Details</i></a>
        </div>
       </td>";
        } else {
          echo "<td class='text-center'>
          <div class='dropdown sub-dropdown'>
          <button class='btn btn-link text-muted dropdown-toggle' type='button'
              id='dd1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i data-feather='more-vertical'></i> </button>
          <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dd1'>
  
          <a class='dropdown-item' href='./students?id=$data[transId]&classcode=$data[clCode]'>View Student List</i></a>
          <a class='dropdown-item approve_D' data-target='#approve3-details' data-toggle='modal' href='' data-id='$hash_id' >View Details</i></a>
          </div>
         </td>";
        };


       
        echo "</tr>";
        }  
      }
      

}