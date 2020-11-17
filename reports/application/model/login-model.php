<?php
session_start();
include_once '../config/db-config.php';
include_once '../controllers/login-controller.php';
  
if(isset($_POST)) {
    $db             =           new DBController();
    $conn           =           $db->connect();

    if(!empty($_POST['txtShortname'])) {
            $Controller         =       new LoginController($conn);
            $Result             =       $Controller->checkLogin($_POST['txtShortname']);

            if($Result['status'] == "SUCCESS") {
                echo "<div class='alert alert-success alert-dismissible'>" .$Result['message'] . " : " .$Result['user']. "</div>";
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