<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.tfcode,a.tfdate,c.stcode,c.stname1 FROM `tfmaster` as a inner join tfdetail as b on (a.tfcode=b.tfcode) inner join stock as c on (c.stcode=b.stcode) ";
	// $sql .= " where b.supstatus = '01'";
	$sql .= " ORDER BY tfdate desc,tfcode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "tfcode" => array(),
		"tfdate" => array(),
		"stcode" => array(),
		"stname1" => array()
		
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['tfcode'],$row["tfcode"]);
            array_push($json_result['tfdate'],$row["tfdate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);			
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>