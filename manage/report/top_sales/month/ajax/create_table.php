<?php
	header('Content-Type: application/json');
    include('../../../../conn.php');
    
        
        
    $vat = $_POST["vat"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    // $year = '2020';

    $sql = "SELECT * FROM `data_report` where report = '1' order by num_order";
	$query = mysqli_query($conn,$sql);

    $json_result=array(
		"data_code" => array(),
        "data" => array(),
		"report" => array(),
		"num_order" => array(),
        "total_1" => array(),
        "total_2" => array(),
        "total_3" => array(),
        "total_4" => array(),
        "total_5" => array(),
        "total_6" => array(),
        "total_7" => array(),
        "total_8" => array(),
        "total_9" => array(),
        "total_10" => array(),
        "total_11" => array()
		);

    while($row = $query->fetch_assoc()) {
        array_push($json_result['data_code'],$row["data_code"]);
        array_push($json_result['data'],$row["data"]);
        array_push($json_result['report'],$row["report"]);
        array_push($json_result['num_order'],$row["num_order"]);
    }

    
    // echo $json_result['data'][0];


    $strSQL = "SELECT sum(total_1) as total_1,sum(total_2) as total_2,";
    $strSQL .= "sum(total_3) as total_3,sum(total_4) as total_4,";
    $strSQL .= "sum(total_5) as total_5,sum(total_6) as total_6,";
    $strSQL .= "sum(total_7) as total_7,sum(total_8) as total_8,";
    $strSQL .= "sum(total_9) as total_9,sum(total_10) as total_10,";
    $strSQL .= "sum(total_11) as total_11 ";
    $strSQL .= "from ";

	$strSQL .= "(SELECT a.socode,b.invdate,a.amount,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][0]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))   end as total_1,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][1]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_2,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][2]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_3,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][3]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_4,";
    $strSQL .= "case when a.stcode = '".$json_result['data'][4]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_5,";
    $strSQL .= "case when a.stcode = '".$json_result['data'][5]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_6,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][6]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_7,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][7]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_8,";
	$strSQL .= "case when a.stcode = '".$json_result['data'][8]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_9,";
    $strSQL .= "case when a.stcode = '".$json_result['data'][9]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_10,";
    $strSQL .= "case when a.stcode = '".$json_result['data'][10]."' then sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))  end as total_11";    
    $strSQL .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode)";
    $strSQL .= " where (a.supstatus = '03' or a.supstatus = '04')";
    if($vat != 'A') 
    $strSQL .= " and b.vat = '".$vat."' ";
    if($month != '00') 
    $strSQL .= " and SUBSTRING(b.invdate,6,2)='".$month."' ";
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


