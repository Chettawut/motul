<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.tfcode,a.tfdate,a.trandate,b.tfno,b.amount,b.unit,b.places1,b.places2,c.stcode,c.stname1 FROM `tfmaster` as a inner join tfdetail as b on (a.tfcode=b.tfcode) inner join stock as c on (c.stcode=b.stcode) ";
	$sql .= "where a.tfcode = '".$_POST['idcode']."'  order by b.tfno";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"tfcode" => array(),
		"tfno" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),		
		"places1" => array(),
		"places2" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['tfcode'],$row["tfcode"]);
			array_push($json_result['tfno'],$row["tfno"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);			
			array_push($json_result['places1'],$row["places1"]);
			array_push($json_result['places2'],$row["places2"]);
			
        }
        echo json_encode($json_result);

		// echo $sql;
	
		
		mysqli_close($conn);
?>