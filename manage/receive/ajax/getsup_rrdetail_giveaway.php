<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT b.rrcode,b.rrno,c.stcode,c.stname1,b.amount as recamount,b.pocode,b.unit,b.price,b.discount,b.rrstatus,b.places ";
	$sql .= "FROM rrdetail as b inner join stock as c on (c.stcode=b.stcode)  ";
	$sql .= "where b.rrcode = '".$_POST['idcode']."' and b.giveaway = '1' order by b.rrno  ";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"rrcode" => array(),
		"rrno" => array(),
		"stcode" => array(),
		"pocode" => array(),
		"stname1" => array(),		
		"recamount" => array(),
		"unit" => array(),
		"price" => array(),
		"discount" => array(),
		"places" => array(),
		"rrstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['rrcode'],$row["rrcode"]);
			array_push($json_result['rrno'],$row["rrno"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['recamount'],$row["recamount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['discount'],$row["discount"]);
			array_push($json_result['places'],$row["places"]);
			array_push($json_result['rrstatus'],$row["rrstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $sql;
	
		
		// mysqli_close($conn);
?>