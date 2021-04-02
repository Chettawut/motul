<?php
	header('Content-Type: application/json');
	include('../../../../conn.php');

	$sql = "SELECT * FROM `data_report` where report = '1' order by num_order";
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"data_code" => array(),
        "data" => array(),
		"report" => array(),
		"num_order" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['data_code'],$row["data_code"]);
            array_push($json_result['data'],$row["data"]);
			array_push($json_result['report'],$row["report"]);
			array_push($json_result['num_order'],$row["num_order"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>