<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT code,stcode,stname1 FROM `stock` ";
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	

	$json_result=array(
		"code" => array(),
		"stcode" => array(),
		"stname1" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {

			array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>