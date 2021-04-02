<?php
	header('Content-Type: application/json');
    include('../../../../conn.php');
    
        
        
    $vat = $_POST["vat"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $stcode = $_POST["stcode"];
    // $year = '2020';

    $json_result=array(
		"data_code" => array(),
        "data" => array(),
		"report" => array(),
		"num_order" => array(),
        "total_Jan" => array(),
        "total_Feb" => array(),
        "total_Mar" => array(),
        "total_Apr" => array(),
        "total_May" => array(),
        "total_Jun" => array(),
        "total_Jul" => array(),
        "total_Aug" => array(),
        "total_Sep" => array(),
        "total_Oct" => array(),
        "total_Nov" => array(),
        "total_Dec" => array()
		);

    
    // echo $json_result['data'][0];
    
    $strSQL = "SELECT sum(total_Jan) as total_Jan,sum(total_Feb) as total_Feb,";
    $strSQL .= "sum(total_Mar) as total_Mar,sum(total_Apr) as total_Apr,";
    $strSQL .= "sum(total_May) as total_May,sum(total_Jun) as total_Jun,";
    $strSQL .= "sum(total_Jul) as total_Jul,sum(total_Aug) as total_Aug,";
    $strSQL .= "sum(total_Sep) as total_Sep,sum(total_Oct) as total_Oct,";
    $strSQL .= "sum(total_Nov) as total_Nov,sum(total_Dec) as total_Dec ";
    $strSQL .= "from ";

	$strSQL .= "(SELECT a.socode,b.invdate,a.amount,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '01' THEN sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))   end as total_Jan,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '02' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Feb,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '03' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Mar,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '04' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Apr,";
    $strSQL .= "case when SUBSTRING(b.invdate,6,2) = '05' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_May,";
    $strSQL .= "case when SUBSTRING(b.invdate,6,2) = '06' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Jun,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '07' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Jul,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '08' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Aug,";
	$strSQL .= "case when SUBSTRING(b.invdate,6,2) = '09' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Sep,";
    $strSQL .= "case when SUBSTRING(b.invdate,6,2) = '10' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Oct,";
    $strSQL .= "case when SUBSTRING(b.invdate,6,2) = 11 then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Nov,";
    $strSQL .= "case when SUBSTRING(b.invdate,6,2) = '12' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_Dec";	
    $strSQL .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode)";
    $strSQL .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode)";
    $strSQL .= " where (a.supstatus = '03' or a.supstatus = '04')";
    if($vat != 'A') 
    $strSQL .= " and b.vat = '".$vat."' ";
    if($month != '00') 
    $strSQL .= " and SUBSTRING(b.invdate,6,2)='".$month."' ";
    $strSQL .= " and a.stcode='".$stcode."' ";
    $strSQL .= " and SUBSTRING(b.invdate,1,4)='".$year."' and (a.supstatus = '03' or a.supstatus = '04') ";
    $strSQL .= " GROUP by socode) as c";    
    
    
    // echo $strSQL;
    $query = mysqli_query($conn,$strSQL);
    		
        while($row = $query->fetch_assoc())
        {
            array_push($json_result['total_1'],(int)$row["total_1"]);
            array_push($json_result['total_2'],(int)$row["total_2"]);
            array_push($json_result['total_3'],(int)$row["total_3"]);
            array_push($json_result['total_4'],(int)$row["total_4"]);
            array_push($json_result['total_5'],(int)$row["total_5"]);
            array_push($json_result['total_6'],(int)$row["total_6"]);
            array_push($json_result['total_7'],(int)$row["total_7"]);
            array_push($json_result['total_8'],(int)$row["total_8"]);
            array_push($json_result['total_9'],(int)$row["total_9"]);
            array_push($json_result['total_10'],(int)$row["total_10"]);
            array_push($json_result['total_11'],(int)$row["total_11"]);
            
        }

        echo json_encode($json_result);
            
            		
		mysqli_close($conn);
?>


