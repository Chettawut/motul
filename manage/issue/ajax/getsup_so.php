<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.socode,a.sodate,a.deldate,a.paydate,a.payment,a.currency,a.vat,a.remark,c.stcode,c.stname1,a.cuscode,d.cusname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,d.tel,b.supstatus ";
	$sql .= "FROM `somaster` as a inner join sodetail as b on (a.socode=b.socode) inner join stock as c on (c.stcode=b.stcode) inner join customer as d on (a.cuscode=d.cuscode) ";
	$sql .= "where a.socode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "socode" => array(),
		"sodate" => array(),
		"deldate" => array(),
		"payment" => array(),
		"paydate" => array(),
		"currency" => array(),
		"vat" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"cuscode" => array(),
		"cusname" => array(),
		"address" => array(),
		"tel" => array(),
		"remark" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sodate'],$row["sodate"]);
			array_push($json_result['deldate'],$row["deldate"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['paydate'],$row["paydate"]);
			array_push($json_result['currency'],$row["currency"]);
			array_push($json_result['vat'],$row["vat"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			array_push($json_result['tel'],$row["tel"]);
			array_push($json_result['remark'],$row["remark"]);
			array_push($json_result['address'],$address);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>