<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT b.amount as amount1,c.amount as amount2,d.amount as amount3,a.stcode,a.stname1,a.unit,a.status,a.code ";
	$sql .= "FROM stock a ";  
	$sql .= "INNER JOIN stock_level b ";
	$sql .= "    ON a.stcode = b.stcode ";  
	$sql .= "    AND b.places = '1' ";  
	$sql .= "INNER JOIN stock_level c ";
	$sql .= "    ON a.stcode = c.stcode ";  
	$sql .= "      AND c.places = '2' ";  
	$sql .= "      INNER JOIN stock_level d ";
	$sql .= "    ON a.stcode = d.stcode ";  
	$sql .= "      AND d.places = '3' ";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "code" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount1" => array(),
		"amount2" => array(),
		"amount3" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount1'],$row["amount1"]);
			array_push($json_result['amount2'],$row["amount2"]);
			array_push($json_result['amount3'],$row["amount3"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>