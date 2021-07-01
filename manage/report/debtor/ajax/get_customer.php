<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `customer` ";
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	

	$json_result=array(
		"code" => array(),
		"cuscode" => array(),
		"cusname" => array(),
		"address" => array(),
		"tel" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {

			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);
			array_push($json_result['code'],$row["code"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			array_push($json_result['address'],$address);
			array_push($json_result['tel'],$row["tel"]);
        }
        echo json_encode($json_result);



?>