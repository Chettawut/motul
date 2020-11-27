<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
        
        
    // $vat = 'Y';
    $cuscode = $_POST["cuscode"];
    // $year = '2020';

    $sql = "SELECT a.socode,b.sodate,b.invoice,b.invdate,c.cusname,sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))-sum(((((a.amount*a.price)-((a.amount*a.price)*a.discount/100))*100)/107)*7/100) as price,sum(((((a.amount*a.price)-((a.amount*a.price)*a.discount/100))*100)/107)*7/100) as vat,sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100)) as total,recelog,delcode ";        
    $sql .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode) inner join customer as c on (b.cuscode=c.cuscode) ";
    if($cuscode!='')
    $sql .= " where b.cuscode = '".$cuscode."' and a.supstatus !='C'";    
    else
    $sql .= " where a.supstatus !='C'";    
    $sql .= " GROUP by a.socode order by socode desc";  
    
    
    // echo $strSQL;
    $query = mysqli_query($conn,$sql);
    
    
        
	$json_result=array(
        "socode" => array(),
        "sodate" => array(),
        "invoice" => array(),
        "invdate" => array(),
        "cusname" => array(),
        "total" => array(),
        "delcode" => array(),
        "recelog" => array()
    );
		
        while($row = $query->fetch_assoc())
        {
            array_push($json_result['socode'],$row["socode"]);
            array_push($json_result['sodate'],$row["sodate"]);
            array_push($json_result['invoice'],$row["invoice"]);
            array_push($json_result['invdate'],$row["invdate"]);
            array_push($json_result['cusname'],$row["cusname"]);
            array_push($json_result['total'],(float)$row["total"]);
            array_push($json_result['delcode'],$row["delcode"]);
            array_push($json_result['recelog'],$row["recelog"]);
            
            
        }

        echo json_encode($json_result);
            
            		
?>


