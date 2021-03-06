<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.socode,a.sodate,c.stcode,c.stname1,a.cuscode,d.cusname,b.supstatus,a.recedate FROM `somaster` as a inner join sodetail as b on (a.socode=b.socode) inner join stock as c on (c.stcode=b.stcode) inner join customer as d on (a.cuscode=d.cuscode) ";
	$sql .= " where (b.supstatus = '02' or b.supstatus = '03' or b.supstatus = '04') and b.giveaway = 0 ";
	$sql .= " ORDER BY CASE WHEN b.supstatus = '03' THEN 1 WHEN b.supstatus = '02' THEN 2 END  desc,sodate desc,socode desc";	
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "socode" => array(),
		"sodate" => array(),
		"stcode" => array(),
		"recedate" => array(),
		"stname1" => array(),
		"cusname" => array(),
		"supstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['socode'],$row["socode"]);
            array_push($json_result['sodate'],$row["sodate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['recedate'],$row["recedate"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['cusname'],$row["cuscode"].' '.$row["cusname"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $sql;
	
		
		mysqli_close($conn);
?>