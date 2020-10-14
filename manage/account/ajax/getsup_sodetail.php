<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT b.socode,b.sono,c.stcode,c.stname1,b.amount,b.unit,b.price,b.discount,b.supstatus,b.places ";
	$sql .= "FROM sodetail as b inner join stock as c on (c.stcode=b.stcode) ";
	$sql .= "where b.socode = '".$_POST['idcode']."' and b.giveaway = '0' order by b.sono ";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"socode" => array(),
		"sono" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),
		"price" => array(),
		"discount" => array(),
		"places" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sono'],$row["sono"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['discount'],$row["discount"]);
			array_push($json_result['places'],$row["places"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $sql;
	
		
		mysqli_close($conn);
?>