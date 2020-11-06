<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    

    $sql = "SELECT recelog FROM somaster where socode = '".$_POST["socode"]."' ";
	$query = mysqli_query($conn,$sql);
    $log;
    $recelog;
        while($row = $query->fetch_assoc()) {
            $recelog = $row["recelog"];
        }       
            
    if($invdate=='')
    {
        $strSQL = "UPDATE somaster SET ";
        $strSQL .= "recelog='".date("Y-m-d")."' ";
        $strSQL .= "WHERE socode= '".$_POST["socode"]."' ";

        $query = mysqli_query($conn,$strSQL);
       
        $log ='success';
    }
    else
    {
        $log ='f';
    }

                                
        
        // echo $strSQL;

    if($query)         
        echo json_encode(array('status' => '1','message'=> 'แก้ไขสำเร็จ ','log'=> $log));        
    else        
        echo json_encode(array('status' => '0','message'=> 'หมายเลขหัวข้อการประชุมซ้ำ','log'=> $log));
        
        

    
    
?>