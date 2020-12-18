<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "socode" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%03s", $row["maxsocode"]);
            $yearsocode=$row["year"];
            array_push($json_result['socode'],$yearsocode.'KM'.$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>