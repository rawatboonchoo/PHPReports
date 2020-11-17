<?php
	header('Content-Type: application/json');
        include("../condb/condb.php");

	$sql = "INSERT INTO plan (
        plan_id, 
        plan_month, 
        plan_year,
        plan_status
        ) 
		VALUES (
            '".$_POST["txtPlanid"]."',
            '".$_POST["txtPlanmonth"]."',
            '".$_POST["txtPlanyear"]."',
            'กำลังดำเนินการ'
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