<?php
header('Content-Type: application/json');
include_once '../application/config/db-config.php';

$db             =           new DBController();
$conn           =           $db->connect();
$att_id         =           $_POST['att_id'];
$sql            =           "SELECT * FROM attach WHERE att_id = '".$att_id."'";
$result         =           $conn->query($sql);
$row            =           $result->fetch_object();
echo json_encode(array(
    'status'        =>  '200',
    'att_id'        =>  $row->att_id,
    'att_name'      =>  $row->att_name
));
?>