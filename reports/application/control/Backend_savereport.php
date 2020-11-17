<?php
	header('Content-Type: application/json');
        include("../condb/condb.php");

	$sql = "INSERT INTO plan (
        plan_id, 
        user_part_name, 
        report_start, 
        report_end, 
        operation, 
        note, 
        user_id) 
		VALUES (
            '".$_POST["txtPlanid"]."',
            '".$_POST["txtPartname"]."',
            '".$_POST["txtReportstart"]."',
            '".$_POST["txtReportend"]."',
            '".$_POST["txtOperation"]."',
            '".$_POST["txtNote"]."',
            '".$_POST["txtUserid"]."'
            )";
        $result = $mysqli->query($sql);
	if($result) {
        echo json_encode(array('status' => '200','message'=> 'Record add successfully'));
	}
	else
	{
        echo json_encode(array('status' => '201','message'=> 'Error insert data!'));
	}

	mysqli_close($mysqli);
?>