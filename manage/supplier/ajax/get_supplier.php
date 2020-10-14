<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `supplier` ";
	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"code" => array(),
        "supcode" => array(),
		"supname" => array(),
		"idno" => array(),
		"road" => array(),
		"subdistrict" => array(),
		"district" => array(),
		"province" => array(),
		"zipcode" => array(),
		"tel" => array(),
		"fax" => array(),
		"taxnumber" => array(),
		"email" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['code'],$row["code"]);
            array_push($json_result['supcode'],$row["supcode"]);
			array_push($json_result['supname'],$row["supname"]);
			array_push($json_result['idno'],$row["idno"]);
			array_push($json_result['road'],$row["road"]);
			array_push($json_result['subdistrict'],$row["subdistrict"]);
			array_push($json_result['district'],$row["district"]);
			array_push($json_result['province'],$row["province"]);
			array_push($json_result['zipcode'],$row["zipcode"]);
			array_push($json_result['tel'],$row["tel"]);
			array_push($json_result['fax'],$row["fax"]);
			array_push($json_result['taxnumber'],$row["taxnumber"]);
			array_push($json_result['email'],$row["email"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>