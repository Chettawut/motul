<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
	
	$strSQL = "SELECT * FROM `places` where placescode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"placescode" => array(),
        "places" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['placescode'],$row["placescode"]);
            array_push($json_result['places'],$row["places"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>