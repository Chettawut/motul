<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT b.pocode,d.podate,d.deldate,a.supname,d.payment,b.pono,c.stcode,c.stname1,b.amount,b.recamount,b.unit,b.price,b.discount,b.supstatus ";
	$sql .= " FROM supplier as a inner join pomaster as d on (a.supcode=d.supcode) inner join podetail as b on (d.pocode=b.pocode) inner join stock as c on (c.stcode=b.stcode)";
	$sql .= "where a.supcode = '".$_POST['idcode']."' and b.supstatus !='03' order by d.podate desc ";
	
	// echo $sql;
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"pocode" => array(),
		"podate" => array(),
		"deldate" => array(),
		"supname" => array(),
		"payment" => array(),
		"pono" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"recamount" => array(),
		"unit" => array(),
		"price" => array(),
		"discount" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['podate'],$row["podate"]);
			array_push($json_result['deldate'],$row["deldate"]);
			array_push($json_result['supname'],$row["supname"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['pono'],$row["pono"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['recamount'],$row["recamount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['discount'],$row["discount"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		
	
		
		mysqli_close($conn);
?>