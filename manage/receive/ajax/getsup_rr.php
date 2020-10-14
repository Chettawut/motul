<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.rrcode,a.rrdate,a.invcode,a.invdate,a.payment,c.stcode,c.stname1,a.supcode,d.supname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,b.rrstatus ";
	$sql .= "FROM `rrmaster` as a inner join rrdetail as b on (a.rrcode=b.rrcode) inner join stock as c on (c.stcode=b.stcode) inner join supplier as d on (a.supcode=d.supcode) ";
	$sql .= "where a.rrcode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "rrcode" => array(),
		"rrdate" => array(),
		"invcode" => array(),
		"invdate" => array(),
		"payment" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supcode" => array(),
		"supname" => array(),
		"address" => array(),
		"rrstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['rrcode'],$row["rrcode"]);
			array_push($json_result['rrdate'],$row["rrdate"]);
			array_push($json_result['invcode'],$row["invcode"]);
			array_push($json_result['invdate'],$row["invdate"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supcode'],$row["supcode"]);
			array_push($json_result['supname'],$row["supname"]);
			array_push($json_result['address'],$address);
			array_push($json_result['rrstatus'],$row["rrstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>