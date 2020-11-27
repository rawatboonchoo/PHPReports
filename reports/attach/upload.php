<?php
header('Content-Type: application/json');
include_once '../application/config/db-config.php';
include_once './file-controller.php';
  
if(isset($_POST)) {
    $db             =           new DBController();
    $conn           =           $db->connect();

    if(!empty($_FILES['file'])) {
            $fController         =       new FileController($conn);
            $uploadResult        =       $fController->uploadFile($_FILES['file'],$_POST['filePlan_id'],$_POST['fileDep_id']);

            if($uploadResult['status'] == "SUCCESS") {
                //echo "<div class='alert alert-success alert-dismissible'>" .$uploadResult['files'] . "</div>";
                //echo '<img src="./uploads/'.$uploadResult['files'].'" style="max-width: 540px;">';
                echo json_encode(array('status' => '200','message'=> $uploadResult['message']));
            }

            elseif($uploadResult['status'] == "FAILED") {
                //echo "<div class='alert alert-danger alert-dismissible'>" .$uploadResult['message'] . "</div>";
                echo json_encode(array('status' => '201','message'=> $uploadResult['message']));
            }

            else {
                echo "<div class='alert alert-success alert-dismissible'>" .$uploadResult['message'] . "</div>";
            }
    }   
    
}
?>