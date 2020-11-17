<?php
session_start();
header('Content-Type: application/json');
include("../condb/condb.php");
$sql = "SELECT * FROM department WHERE dep_shortname = '".$_GET["txtShortname"]."'";
$result = $mysqli->query($sql);

$view=$result->fetch_object();
if (mysqli_num_rows($result)>0)
		{
			$_SESSION['dep_id']=$view->dep_id;
			$_SESSION['dep_shortname']=$view->dep_shortname;
			$_SESSION['dep_fullname']=$view->dep_fullname;
			$_SESSION['dep_status']=$view->dep_status;
			echo json_encode(array('status' => '200','message'=> 'Login successfully','user'=>$view->dep_fullname));
		}
		else{
			echo json_encode(array('status' => '201','message'=> 'Error Login!'));
		}
mysqli_close($mysqli);	
?>