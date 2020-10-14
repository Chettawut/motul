<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
	
	$strSQL = "SELECT * FROM `stock`  where code = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
        "code" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"storage_id" => array(),
		"unit" => array(),
		"stmin1" => array(),
		"stmin2" => array(),
		"sellprice" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['storage_id'],$row["storage_id"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['stmin1'],$row["stmin1"]);
			array_push($json_result['stmin2'],$row["stmin2"]);
			array_push($json_result['sellprice'],$row["sellprice"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>