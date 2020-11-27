<?php
include("../application/config/condb.php");
$sql = "SELECT * FROM jobtype";
$result = $mysqli->query($sql);

// Generate array with skills data 
$skillData = array(); 
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ 
        $data['type_id'] = $row['type_id']; 
        $data['type_work'] = $row['type_work']; 
        array_push($skillData, $data); 
    } 
}
else{
    echo "55";
} 
// Return results as json encoded array 
echo json_encode($skillData); 
mysqli_close($mysqli);	
?>