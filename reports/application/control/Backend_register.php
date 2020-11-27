<?php
	header('Content-Type: application/json');
        include("../condb/condb.php");

	$sql = "INSERT INTO department (
        dep_shortname,
        dep_fullname, 
        dep_status) 
		VALUES (
            '".$_POST["txtShortname"]."',
            '".$_POST["txtFullname"]."',
            '".$_POST["txtStatus"]."'
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