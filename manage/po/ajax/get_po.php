<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.pocode,a.podate,c.stcode,c.stname1,a.supcode,d.supname,b.supstatus FROM `pomaster` as a inner join podetail as b on (a.pocode=b.pocode) inner join stock as c on (c.stcode=b.stcode) inner join supplier as d on (a.supcode=d.supcode) order by a.pocode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "pocode" => array(),
		"podate" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supname" => array(),
		"supstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['pocode'],$row["pocode"]);
            array_push($json_result['podate'],$row["podate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supname'],$row["supcode"].' '.$row["supname"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>