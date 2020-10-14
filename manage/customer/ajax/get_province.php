<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `province` ";
	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"code" => array(),
		"name" => array(),
        "shortname" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['code'],$row["code"]);
			array_push($json_result['name'],$row["name"]);
            array_push($json_result['shortname'],$row["shortname"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>