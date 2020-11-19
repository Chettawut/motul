<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.tfcode,a.tfdate,a.trandate,a.remark,c.stcode,c.stname1 FROM `tfmaster` as a inner join tfdetail as b on (a.tfcode=b.tfcode) inner join stock as c on (c.stcode=b.stcode) ";
	$sql .= "where a.tfcode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "tfcode" => array(),
		"tfdate" => array(),
		"trandate" => array(),
		"remark" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			
            array_push($json_result['tfcode'],$row["tfcode"]);
			array_push($json_result['tfdate'],$row["tfdate"]);
			array_push($json_result['trandate'],$row["trandate"]);			
			array_push($json_result['remark'],$row["remark"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>