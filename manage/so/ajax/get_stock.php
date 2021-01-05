<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$notcal_number=6;

	$sql = "SELECT IF(a.storage_id!=$notcal_number, b.amount DIV e.ratio, 0) as amount1,IF(a.storage_id!=$notcal_number, MOD(b.amount, e.ratio), b.amount) as piece1";
	$sql .= ",IF(a.storage_id!=$notcal_number, c.amount DIV e.ratio, 0) as amount2,IF(a.storage_id!=$notcal_number, MOD(c.amount, e.ratio), c.amount) as piece2";
	$sql .= ",IF(a.storage_id!=$notcal_number, d.amount DIV e.ratio, 0) as amount3,IF(a.storage_id!=$notcal_number, MOD(d.amount, e.ratio), d.amount) as piece3";  
	$sql .= ",a.stcode,a.stname1,a.unit,a.status,a.code FROM stock a INNER JOIN stock_level b ON a.stcode = b.stcode ";  
	$sql .= "AND b.places = '1' INNER JOIN stock_level c ON a.stcode = c.stcode AND c.places = '2' INNER JOIN stock_level d ON a.stcode = d.stcode AND d.places = '3' LEFT OUTER JOIN storage_unit e ON e.storage_id ";
	$sql .= "= a.storage_id where status = 'Y' order by stcode";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "code" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount1" => array(),
		"piece1" => array(),
		"amount2" => array(),
		"piece2" => array(),
		"amount3" => array(),
		"piece3" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount1'],$row["amount1"]);
			array_push($json_result['piece1'],$row["piece1"]);
			array_push($json_result['amount2'],$row["amount2"]);
			array_push($json_result['piece2'],$row["piece2"]);
			array_push($json_result['amount3'],$row["amount3"]);
			array_push($json_result['piece3'],$row["piece3"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>