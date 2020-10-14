<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "rrcode" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%03s", $row["maxrrcode"]);
            $yearrrcode=$row["year"];
            array_push($json_result['rrcode'],$yearrrcode.'/'.$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>