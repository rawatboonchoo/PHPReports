<?php
header('Content-Type: application/json');
include_once '../application/config/db-config.php';

$db             =           new DBController();
$conn           =           $db->connect();
$sql            =           "SELECT * FROM attach ORDER BY att_id DESC LIMIT 1";
$result         =           $conn->query($sql);
$row            =           $result->fetch_object();
echo json_encode(array(
    'status'        =>  '200',
    'att_id'        =>  $row->att_id,
    'att_name'      =>  $row->att_name
));
?>