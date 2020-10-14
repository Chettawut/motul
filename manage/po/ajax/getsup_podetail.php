<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT b.pocode,b.pono,c.stcode,c.stname1,b.amount,b.unit,b.price,b.discount,b.supstatus ";
	$sql .= "FROM podetail as b inner join stock as c on (c.stcode=b.stcode) ";
	$sql .= "where b.pocode = '".$_POST['idcode']."' order by b.pono ";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"pocode" => array(),
		"pono" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),
		"price" => array(),
		"discount" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['pono'],$row["pono"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['discount'],$row["discount"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>