<?php
include_once '../config/db-config.php';
include_once '../controllers/create-controller.php';
  
if(isset($_POST)) {
    $db             =           new DBController();
    $conn           =           $db->connect();

    if(!empty($_POST['txtPlanstatus'])) {
            $Controller         =       new CreateController($conn);
            $Result             =       $Controller->createData($_POST['txtPlanid'],$_POST['txtPlanmonth'],$_POST['txtPlanyear'],$_POST['txtPlanstatus']);

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
    }       
}
?>