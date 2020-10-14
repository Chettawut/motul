<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `unit` where status = 'Y'";
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"unitcode" => array(),
        "unit" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['unitcode'],$row["unitcode"]);
            array_push($json_result['unit'],$row["unit"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>