<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
	
	$strSQL = "SELECT * FROM `unit` where unitcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"unitcode" => array(),
        "unit" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['unitcode'],$row["unitcode"]);
            array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>