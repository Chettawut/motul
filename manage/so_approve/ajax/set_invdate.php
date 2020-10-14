<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    

    $sql = "SELECT invdate FROM somaster where socode = '".$_POST["socode"]."' ";
	$query = mysqli_query($conn,$sql);
    $log;
    $invdate;
        while($row = $query->fetch_assoc()) {
            $invdate = $row["invdate"];
        }       
            
    if($invdate=='')
    {
        $strSQL = "UPDATE somaster SET ";
        $strSQL .= "invdate='".date("Y-m-d")."' ";
        $strSQL .= "WHERE socode= '".$_POST["socode"]."' ";

        $query = mysqli_query($conn,$strSQL);
       
        $strSQL2 = "UPDATE sodetail SET ";
        $strSQL2 .= "supstatus='03' ";
        $strSQL2 .= "WHERE socode= '".$_POST["socode"]."' ";

        $query2 = mysqli_query($conn,$strSQL2);
        $log ='success';
    }
    else
    {
        $log ='f';
    }

                                
        
        // echo $strSQL;

    if($query2)         
        echo json_encode(array('status' => '1','message'=> 'แก้ไขสำเร็จ ','log'=> $log));        
    else        
        echo json_encode(array('status' => '0','message'=> 'หมายเลขหัวข้อการประชุมซ้ำ','log'=> $log));
        
        

    
    
?>