<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
        
        
    $stock = $_POST["stock"];
    // $stock = '';
    $place = $_POST["place"];
    // $place = '';

    $sql = "SELECT a.socode,b.sodate,d.stcode,d.stname1 as stname,b.invdate,c.cusname,a.amount,a.unit ";        
    $sql .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode) inner join customer as c on (b.cuscode=c.cuscode) inner join stock as d on (a.stcode=d.stcode) ";
    if($stock=='')
    $sql .= " where (a.supstatus = '03' or a.supstatus = '04')";
    else if ($place!='ALL')
    $sql .= " where a.stcode = '".$stock."' and a.places ='".$place."'  and (a.supstatus = '03' or a.supstatus = '04')";
    else
    $sql .= " where a.stcode = '".$stock."' and (a.supstatus = '03' or a.supstatus = '04')";
    $sql .= " order by a.socode desc";  
    
    
    // echo $sql;
    $query = mysqli_query($conn,$sql);
    
    
        
	$json_result=array(
        "socode" => array(),
        "sodate" => array(),
        "stcode" => array(),
        "stname" => array(),
        "cusname" => array(),
        "amount" => array(),
        "unit" => array()
        // "total" => array()
    );
		
        while($row = $query->fetch_assoc())
        {
            array_push($json_result['socode'],$row["socode"]);
            array_push($json_result['sodate'],$row["sodate"]);
            array_push($json_result['stcode'],$row["stcode"]);
            array_push($json_result['stname'],$row["stname"]);
            array_push($json_result['cusname'],$row["cusname"]);
            array_push($json_result['amount'],$row["amount"]);
            array_push($json_result['unit'],$row["unit"]);
            // array_push($json_result['total'],$row["total"]);
            
            
        }

        echo json_encode($json_result);
            
            		
		mysqli_close($conn);
?>


