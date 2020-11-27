<?php
session_start();

    class ReportController {
        
        // --------------- [ Constructor ] --------------------------
        public function __construct($conn) {
             $this->conn = $conn;        
        }

        // --------------- [ Upload Function ] -----------------------
        public function createReport($txtPlan_id,$txtCat_id,$txtType_id,$txtDep_id,$txtAtt_id,$txtDes_detail,$txtDes_report_start,$txtDes_report_end,$txtDes_note,$txtDes_count,$txtDes_create_dtm) {

            $plan_id                    =           $txtPlan_id;

            $cat_id                     =           $txtCat_id;

            $type_id                    =           $txtType_id;

            $dep_id                     =           $txtDep_id;

            $des_detail                 =           $txtDes_detail;

            $des_report_start           =           $txtDes_report_start;

            $des_report_end             =           $txtDes_report_end;

            $des_note                   =           $txtDes_note;

            $des_count                  =           $txtDes_count;

            $des_create_dtm             =           $txtDes_create_dtm;

            $att_id                     =           $txtAtt_id;

            $des_last_update_dtm;

            $data                       =           array();

            // ---------------[ insert database ] -----------------
                $sql                    =           "INSERT INTO description (
                                                    plan_id, 
                                                    cat_id,
                                                    type_id, 
                                                    dep_id, 
                                                    att_id, 
                                                    des_detail, 
                                                    des_report_start, 
                                                    des_report_end, 
                                                    des_note, des_count, 
                                                    des_create_dtm, 
                                                    des_last_update_dtm) 
                                                    VALUES(
                                                    '".$plan_id."',
                                                    '".$cat_id."',
                                                    '".$type_id."',
                                                    '".$dep_id."',
                                                    '".$att_id."',
                                                    '".$des_detail."',
                                                    '".$des_report_start."',
                                                    '".$des_report_end."',
                                                    '".$des_note."',
                                                    '".$des_count."',
                                                    '".$des_create_dtm."',
                                                    NULL
                                                    )";
                $result                 =           $this->conn->query($sql);
                if ($result){
                    $data['status']     =           "SUCCESS";
                    $data['message']    =           "เพิ่มข้อมูล : สำเร็จ";
                }else{
                    $data['status']     =           "FAILED";
                    $data['message']    =           "เพิ่มข้อมูล : ไม่สำเร็จ";
                }
            return $data;
        }

        // --------------- [ update Function ] -----------------------
        public function updateReport($txtDes_id,$txtCat_id,$txtType_id,$txtAtt_id,$txtDes_detail,$txtDes_report_start,$txtDes_report_end,$txtDes_note,$txtDes_last_update_dtm) {

            $des_id                     =           $txtDes_id;

            $cat_id                     =           $txtCat_id;

            $type_id                    =           $txtType_id;

            //$dep_id                   =           $txtDep_id;

            $att_id                     =           $txtAtt_id;

            $des_detail                 =           $txtDes_detail;

            $des_report_start           =           $txtDes_report_start;

            $des_report_end             =           $txtDes_report_end;

            $des_note                   =           $txtDes_note;

            //$des_count                =           $txtDes_count;

            //$des_create_dtm           =           $txtDes_create_dtm;

            //$att_id;

            $des_last_update_dtm        =           $txtDes_last_update_dtm;

            $data                       =           array();

            // ---------------[ update database ] -----------------
  
                $sql                    =          "UPDATE description 
                                                        SET des_detail = '".$des_detail."',
                                                        cat_id                  = '".$cat_id."',
                                                        type_id                 = '".$type_id."',
                                                        att_id                  = '".$att_id."',                                            
                                                        des_detail              = '".$des_detail."', 
                                                        des_report_start        = '".$des_report_start."',  
                                                        des_report_end          = '".$des_report_end."',  
                                                        des_note                = '".$des_note."',                                                           
                                                        des_count               =    des_count + 1,
                                                        des_last_update_dtm     = '".$des_last_update_dtm."'
                                                        WHERE des_id = '".$des_id."'";
                $result                 =           $this->conn->query($sql);
                if ($result){
                    $data['status']     =           "SUCCESS";
                    $data['message']    =           "เพิ่มข้อมูล : สำเร็จ";
                }else{
                    $data['status']     =           "FAILED";
                    $data['message']    =           "เพิ่มข้อมูล : ไม่สำเร็จ";                    
                }
            return $data;
        }
        // --------------- [ delete Function ] -----------------------
        public function deleteReport($txtDes_id) {

            $des_id                     =           $txtDes_id;
            

            $data                       =           array();

            // ---------------[ delete database ] -----------------
  
                $sql                    =          "DELETE FROM description 
                                                    WHERE des_id = '".$des_id."'";
                $result                 =           $this->conn->query($sql);
                //$result return true
                if ($result){
                    $data['status']     =           "SUCCESS";
                    $data['message']    =           "เพิ่มข้อมูล : สำเร็จ";
                }else{
                    $data['status']     =           "FAILED";
                    $data['message']    =           "เพิ่มข้อมูล : ไม่สำเร็จ";                    
                }
            return $data;
        }
    }
?>