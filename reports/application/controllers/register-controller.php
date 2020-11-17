<?php
session_start();

    class RegisterController {
        
        // --------------- [ Constructor ] --------------------------
        public function __construct($conn) {
             $this->conn = $conn;        
        }

        // --------------- [ Upload Function ] -----------------------
        public function createData($_shortname,$_fullname,$_area,$_status) {

            $dep_shortname              =           $_shortname;

            $dep_fullname               =           $_fullname;

            $dep_area                   =           $_area;

            $dep_status                 =           $_status;

            $data                       =           array();

            if(
                $dep_shortname == ""    ||
                $dep_fullname  == ""
                ){
                $data['status']         =           "FAILED";
                $data['message']        =           "ชื่อย่อและชื่อเต็มต้องระบุด้วยครับ";
                return $data;
            }


            // ---------------[ insert database ] -----------------
                $sql            =           "INSERT INTO department (dep_shortname,dep_fullname,dep_area,dep_status) VALUES('".$dep_shortname."','".$dep_fullname."','".$dep_area."','".$dep_status."')";
                $result         =           $this->conn->query($sql);
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