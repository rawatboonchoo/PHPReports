<?php
session_start();

    class LoginController {
        
        // --------------- [ Constructor ] --------------------------
        public function __construct($conn) {
             $this->conn = $conn;        
        }

        // --------------- [ Upload Function ] -----------------------
        public function checkLogin($_shortname) {

            $dep_shortname              =           $_shortname;

            $data                       =           array();

            if($dep_shortname == ""){
                $data['status']         =           "FAILED";
                $data['message']        =           "Invalid file type. (File type only jpg, jpeg, gif, and png allowed)";
                return $data;
            }

            
            // ---------------[ select database ] -----------------
                $sql            =           "SELECT * FROM department WHERE dep_shortname='".$dep_shortname."'";
                $result         =           $this->conn->query($sql);
                if (mysqli_num_rows($result)>0){
                    $data['status']     =           "SUCCESS";
                    $data['message']    =           "สำเร็จ";
            // ---------------[ set session ] -----------------
                    $view                       =       $result->fetch_object();
                    $_SESSION['dep_id']         =       $view->dep_id;
                    $_SESSION['dep_shortname']  =       $view->dep_shortname;
                    $_SESSION['dep_fullname']   =       $view->dep_fullname;
                    $_SESSION['dep_status']     =       $view->dep_status;
                    $data['user']    =           $view->dep_fullname;
                }else{
                    $data['status']     =           "FAILED";
                    $data['message']    =           "ข้อมูลผิดพลาก กรุณาติดต่อผู้ดูแลระบบ";
                }
            return $data;
        }
    }
?>