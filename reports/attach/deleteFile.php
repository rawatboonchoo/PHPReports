<?php 
// PHP program to delete a file named gfg.txt  
// using unlike() function  
header('Content-Type: application/json');
include_once '../application/config/db-config.php';
$file_name      =  $_POST['att_name'];
$file_id        =  $_POST['att_id'];
$file_pointer   = "./file/'".$file_name."'";  

$db             =           new DBController();
$conn           =           $db->connect();
$sql            =           "DELETE * FROM attach WHERE att_id='".$file_id."'";
$result         =           $conn->query($sql);
if($result){
    if (!unlink($file_pointer)) {  
        //echo ("$file_pointer cannot be deleted due to an error"); 
        echo json_encode(array(
            'status'        =>  '200',
            'massage'        =>  "$file_name cannot be deleted due to an error"            
        )); 
    }  
    else {  
        //echo ("$file_pointer has been deleted");
        echo json_encode(array(
            'status'        =>  '200',
            'massage'        =>  "$file_name has been deleted"            
        ));
    }  
}

  
?>  