<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.pocode,a.podate,a.deldate,a.payment,a.poqua,a.currency,a.vat,c.stcode,c.stname1,a.supcode,d.supname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,b.supstatus ";
	$sql .= "FROM `pomaster` as a inner join podetail as b on (a.pocode=b.pocode) inner join stock as c on (c.stcode=b.stcode) inner join supplier as d on (a.supcode=d.supcode) ";
	$sql .= "where a.pocode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "pocode" => array(),
		"podate" => array(),
		"deldate" => array(),
		"payment" => array(),
		"poqua" => array(),
		"currency" => array(),
		"vat" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supcode" => array(),
		"supname" => array(),
		"address" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['podate'],$row["podate"]);
			array_push($json_result['deldate'],$row["deldate"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['poqua'],$row["poqua"]);
			array_push($json_result['currency'],$row["currency"]);
			array_push($json_result['vat'],$row["vat"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supcode'],$row["supcode"]);
			array_push($json_result['supname'],$row["supname"]);
			array_push($json_result['address'],$address);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>