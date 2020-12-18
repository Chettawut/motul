<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
	
	$strSQL = "SELECT sellprice,ratio FROM `stock` as a INNER JOIN storage_unit as b on (a.storage_id=b.storage_id)  where stcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
        "sellprice" => array(),
		"ratio" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['sellprice'],$row["sellprice"]);
			array_push($json_result['ratio'],$row["ratio"]);
        }
        echo json_encode($json_result);



?>