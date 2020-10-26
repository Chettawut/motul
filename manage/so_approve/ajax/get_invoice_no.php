<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `somaster` where invoice !='' order by invoice desc ";
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	

	$json_result=array(
		"socode" => array(),
		"invoice" => array(),
		"sodate" => array(),
		"vat" => array()
		
		);
		$vat='';
        while($row = $query->fetch_assoc()) {

			
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['invoice'],$row["invoice"]);
			array_push($json_result['sodate'],$row["sodate"]);			
			if($row["vat"]=='Y')
			$vat='VAT';
			else
			$vat='NO VAT';
			array_push($json_result['vat'],$vat);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>