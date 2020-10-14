<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");
    $status = "";
    $flg = "";
    //var_dump($_POST);
    if( $_POST["flg"] ){
        $status = "02";
        $flg = "อนุมัติ"; 
    }else{
        $status = "01";
        $flg = "ยกเลิกอนุมัติ";        
    }
    $so_code = $_POST["so_code"];
    $StrSQL = "UPDATE sodetail SET supstatus = '$status' WHERE socode = '$so_code'";
    $query = mysqli_query($conn,$StrSQL);  
    if( $query) {
        echo json_encode(array('status' => '1','message'=> $flg . ' '. $so_code.' สำเร็จ'));
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $StrSQL));
    }
    exit;
?>