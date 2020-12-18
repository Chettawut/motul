<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
        
        
    $stock = $_POST["stock"];
    // $stock = '';
    $place = $_POST["place"];
    // $place = '';
    $location = array("Z","A", "B", "C"); 

    $sql = "SELECT b.invoice,b.invdate,d.stcode,d.stname1 as stname,b.invdate,c.cusname,a.amount,a.unit,a.places ";        
    $sql .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode) inner join customer as c on (b.cuscode=c.cuscode) inner join stock as d on (a.stcode=d.stcode) ";
    if($stock==''&&$place=='ALL')
    $sql .= " where (a.supstatus = '03' or a.supstatus = '04')";
    else
    {
        $sql .= " where ";
        if($stock!=''&&$place=='ALL')
        $sql .= " a.stcode = '".$stock."' ";        
        else if($stock==''&&$place!='ALL')
        $sql .= " a.places = '".$place."' ";
        else
        $sql .= " a.stcode = '".$stock."' and a.places = '".$place."' ";

        $sql .= " and (a.supstatus = '03' or a.supstatus = '04')";
    }
    
    $sql .= " order by a.socode desc";  
    
    
    // echo $sql;
    $query = mysqli_query($conn,$sql);
    
    
        
	$json_result=array(
        "invoice" => array(),
        "invdate" => array(),
        "stcode" => array(),
        "stname" => array(),
        "cusname" => array(),
        "amount" => array(),
        "unit" => array(),
        "place" => array()
        // "total" => array()
    );
		
        while($row = $query->fetch_assoc())
        {
            array_push($json_result['invoice'],$row["invoice"]);
            array_push($json_result['invdate'],$row["invdate"]);
            array_push($json_result['stcode'],$row["stcode"]);
            array_push($json_result['stname'],$row["stname"]);
            array_push($json_result['cusname'],$row["cusname"]);
            array_push($json_result['amount'],$row["amount"]);
            array_push($json_result['unit'],$row["unit"]);
            array_push($json_result['place'],$location[$row["places"]]);
            // array_push($json_result['total'],$row["total"]);
            
            
        }

        echo json_encode($json_result);
            
            		
		mysqli_close($conn);
?>


