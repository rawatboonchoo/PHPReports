<?php
include_once '../config/db-config.php';
include_once '../controllers/register-controller.php';
  
if(isset($_POST)) {
    $db             =           new DBController();
    $conn           =           $db->connect();

    if(!empty($_POST['txtStatus'])) {
            $Controller         =       new RegisterController($conn);
            $Result             =       $Controller->createData($_POST['txtShortname'],$_POST['txtFullname'],$_POST['txtArea'],$_POST['txtStatus']);

            if($Result['status'] == "SUCCESS") {
                echo "<div class='alert alert-success alert-dismissible'>" .$Result['message'] . "</div>";
                // echo json_encode(array('status' => '200','message'=> 'Login successfully'));

            }

            elseif($Result['status'] == "FAILED") {
                echo "<div class='alert alert-danger alert-dismissible'>" .$Result['message'] . "</div>";
            }

            else {
                echo "<div class='alert alert-success alert-dismissible'>" .$Result['message'] . "</div>";
            }
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>กรุณาระบุชื่อส่วนงาน</div>";
    }        
}
?>