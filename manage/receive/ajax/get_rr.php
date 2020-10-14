<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.rrcode,a.rrdate,c.stcode,c.stname1,a.supcode,d.supname,b.rrstatus FROM `rrmaster` as a inner join rrdetail as b on (a.rrcode=b.rrcode) inner join stock as c on (c.stcode=b.stcode) inner join supplier as d on (a.supcode=d.supcode) order by a.rrcode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "rrcode" => array(),
		"rrdate" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supname" => array(),
		"rrstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['rrcode'],$row["rrcode"]);
            array_push($json_result['rrdate'],$row["rrdate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supname'],$row["supcode"].' '.$row["supname"]);
			array_push($json_result['rrstatus'],$row["rrstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>