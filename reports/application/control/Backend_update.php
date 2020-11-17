<?php
header('Content-Type: application/json');
include("../condb/condb.php");
$id         =   $_POST["txtID"];
$txtPlanid  =   $_POST["txtPlanid"];
$reportStart=   $_POST["txtReportstart"];
$reportEnd  =   $_POST["txtReportend"];
$operation  =   $_POST["txtOperation"];
$note       =   $_POST["txtNote"];


$sql = "UPDATE plan 
SET report_start    = '".$reportStart."',
report_end          = '".$reportEnd."', 
operation           = '".$operation."', 
note                = '".$note."'
WHERE id            = '".$id."'";
$result = $mysqli->query($sql);
if($result) {
echo json_encode(array('status' => '200','message'=> 'Update add successfully'));
}
else
{
echo json_encode(array('status' => '201','message'=> 'Error Update data!'));
}

mysqli_close($mysqli);



?>