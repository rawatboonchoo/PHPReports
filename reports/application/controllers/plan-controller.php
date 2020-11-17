<?php
session_start();

    class PlanController {
        
        // --------------- [ Constructor ] --------------------------
        public function __construct($conn) {
             $this->conn = $conn;        
        }

        // --------------- [ Upload Function ] -----------------------
        public function loadPlan() {

            $data                       =           array();

            // ---------------[ load database ] ------------------
                $sql            =           "SELECT * FROM plan ORDER BY id DESC";
                $result         =            $this->conn->query($sql);
                return $result;

        }
    }
?>