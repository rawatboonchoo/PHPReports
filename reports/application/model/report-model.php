<?php
include_once '../config/db-config.php';
include_once '../controllers/report-controller.php';
  
if(isset($_POST)) {
    $db             =           new DBController();
    $conn           =           $db->connect();

    //if(!empty($_POST['txtDes_detail'])) {
            $Controller         =       new ReportController($conn);
            if ($_POST['txtStatus'] == 'Create'){
                $Result             =       $Controller->createReport(
                    $_POST['txtPlan_id'],
                    $_POST['txtCat_id'],
                    $_POST['txtType_id'],
                    $_POST['txtDep_id'],
                    $_POST['txtAtt_id'],
                    $_POST['txtDes_detail'],
                    $_POST['txtDes_report_start'],
                    $_POST['txtDes_report_end'],
                    $_POST['txtDes_note'],
                    $_POST['txtDes_count'],
                    $_POST['txtDes_create_dtm']
                );
            }elseif ($_POST['txtStatus'] == 'Update'){
                $Result             =       $Controller->updateReport(
                    $_POST['txtDes_id'],
                    $_POST['txtCat_id'],
                    $_POST['txtType_id'],
                    //$_POST['txtDep_id'],
                    $_POST['txtAtt_id'],
                    $_POST['txtDes_detail'],
                    $_POST['txtDes_report_start'],
                    $_POST['txtDes_report_end'],
                    $_POST['txtDes_note'],
                    //$_POST['txtDes_count'],
                    $_POST['txtDes_last_update_dtm']
                );

            }elseif ($_POST['txtStatus'] == 'Delete'){
                $Result             =       $Controller->deleteReport(
                    $_POST['txtDes_id']
                );

            }else {
                echo "<div class='alert alert-success alert-dismissible'>ERROR</div>";
            }
            

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
    //}else{
    //    echo "<div class='alert alert-danger alert-dismissible'>กรุณาระบุข้อมูลให้ครบถ้วน</div>";
    //}        
}
?>