<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `storage_unit` where storage_id = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"storage_id" => array(),
		"storage_name" => array(),
        "ratio" => array()
		);

        while($row = $query->fetch_assoc()) {
			array_push($json_result['storage_id'],$row["storage_id"]);
			array_push($json_result['storage_name'],$row["storage_name"]);
			array_push($json_result['ratio'],$row["ratio"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>