<?php
include_once '../config/db-config.php';
include_once '../controllers/plan-controller.php';
  

    $db             =           new DBController();
    $conn           =           $db->connect();

   
            $Controller         =       new PlanController($conn);
            $result               =       $Controller->loadPlan();
            //echo  $data;
            //return
              

?>



             
