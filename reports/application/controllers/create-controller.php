<?php
session_start();

    class CreateController {
        
        // --------------- [ Constructor ] --------------------------
        public function __construct($conn) {
             $this->conn = $conn;        
        }

        // --------------- [ Upload Function ] -----------------------
        public function createData($_planID,$_planMonth,$_planYear,$_planStatus) {

            $plan_id                    =           $_planID;

            $plan_month                 =           $_planMonth;

            $plan_year                  =           $_planYear;

            $plan_status                =           $_planStatus;

            $data                       =           array();

            // ---------------[ check database ] ------------------
                $sql            =           "SELECT * FROM plan WHERE plan_month='".$plan_month."' AND plan_year='".$plan_year."'";
                $result         =           $this->conn->query($sql);
                if (mysqli_num_rows($result)>0){
                    $data['status']     =           "FAILED";
                    $data['message']    =           "มีข้อมูลอยู่แล้ว";
                }else{
            // ---------------[ insert database ] -----------------
                $sql            =           "INSERT INTO plan (plan_id,plan_month,plan_year,plan_status) VALUES('".$plan_id."','".$plan_month."','".$plan_year."','".$plan_status."')";
                $result         =           $this->conn->query($sql);
                if ($result){
                    $data['status']     =           "SUCCESS";
                    $data['message']    =           "เพิ่มข้อมูล : สำเร็จ";
                }else{
                    $data['status']     =           "FAILED";
                    $data['message']    =           "เพิ่มข้อมูล : ไม่สำเร็จ";
                }
                }
            return $data;
        }
    }
?>