<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
        
        
    $vat = $_POST["vat"];
    // $vat = 'Y';
    $year = $_POST["year"];
    // $year = '2020';

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
    $strSQL .= " where b.vat = '".$vat."' and SUBSTRING(b.invdate,1,4)='".$year."' and (a.supstatus = '03' or a.supstatus = '04') ";
    $strSQL .= " GROUP by socode) as c";    
    
    
    // echo $strSQL;
    $query = mysqli_query($conn,$strSQL);
    
    
        
	$json_result=array(
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
		
        while($row = $query->fetch_assoc())
        {
            array_push($json_result['total_Jan'],(int)$row["total_Jan"]);
            array_push($json_result['total_Feb'],(int)$row["total_Feb"]);
            array_push($json_result['total_Mar'],(int)$row["total_Mar"]);
            array_push($json_result['total_Apr'],(int)$row["total_Apr"]);
            array_push($json_result['total_May'],(int)$row["total_May"]);
            array_push($json_result['total_Jun'],(int)$row["total_Jun"]);
            array_push($json_result['total_Jul'],(int)$row["total_Jul"]);
            array_push($json_result['total_Aug'],(int)$row["total_Aug"]);
            array_push($json_result['total_Sep'],(int)$row["total_Sep"]);
            array_push($json_result['total_Oct'],(int)$row["total_Oct"]);
            array_push($json_result['total_Nov'],(int)$row["total_Nov"]);
            array_push($json_result['total_Dec'],(int)$row["total_Dec"]);
            
            
        }

        echo json_encode($json_result);
            
            		
		mysqli_close($conn);
?>


