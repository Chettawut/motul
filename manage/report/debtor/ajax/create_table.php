<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
        
        
    // $vat = 'Y';
    $min = $_POST["min"];
    $max = $_POST["max"];
    $pay_status = $_POST["pay_status"];
    $cuscode = $_POST["cuscode"];
    $search_name = $_POST["search_name"];
    

    $sql = "SELECT a.socode,b.sodate,b.paydate,b.invoice,b.invdate,c.cusname,sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))-sum(((((a.amount*a.price)-((a.amount*a.price)*a.discount/100))*100)/107)*7/100) as price,sum(((((a.amount*a.price)-((a.amount*a.price)*a.discount/100))*100)/107)*7/100) as vat,sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100)) as total,recedate,delcode,paycondate ";        
    $sql .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode) inner join customer as c on (b.cuscode=c.cuscode) ";
    $sql .= " where a.supstatus !='C'";  
    if($min!=''&&$max!='')
    $sql .= " and (b.".$search_name."  BETWEEN '".$min."' and '".$max."' ) ";          
    else if($max!='')
    $sql .= " and b.".$search_name."  <= '".$max."' ";    
    else if($min!='')
    $sql .= " and b.".$search_name."  >= '".$min."' ";    
    if($pay_status=='Y')
    $sql .= " and b.paycondate  != '' ";    
    else if($pay_status=='N')
    $sql .= " and b.paycondate  = '' ";    

    if($cuscode!='')
    $sql .= " and c.cuscode  = '".$cuscode."' ";    

    if($min!=''||$max!='')
    $sql .= " GROUP by a.socode order by b.".$search_name.",a.socode desc";  
    else
    $sql .= " GROUP by a.socode order by a.socode desc";  
    
    
    // echo $strSQL;
    $query = mysqli_query($conn,$sql);
    
    
        
	$json_result=array(
        "socode" => array(),
        "sodate" => array(),
        "paydate" => array(),
        "invoice" => array(),
        "invdate" => array(),
        "cusname" => array(),
        "total" => array(),
        "delcode" => array(),
        "recedate" => array(),
        "paycondate" => array()
    );
		
        while($row = $query->fetch_assoc())
        {
            array_push($json_result['socode'],$row["socode"]);
            array_push($json_result['sodate'],$row["sodate"]);
            array_push($json_result['paydate'],$row["paydate"]);
            array_push($json_result['invoice'],$row["invoice"]);
            array_push($json_result['invdate'],$row["invdate"]);
            array_push($json_result['cusname'],$row["cusname"]);
            array_push($json_result['total'],(float)$row["total"]);
            array_push($json_result['delcode'],$row["delcode"]);
            array_push($json_result['recedate'],$row["recedate"]);
            array_push($json_result['paycondate'],$row["paycondate"]);
            
            
        }

        echo json_encode($json_result);
            
            		
?>


