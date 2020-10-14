<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");
    
    $StrSQL = "UPDATE somaster SET ";
    $StrSQL .= " delcode='".$_POST["editdelcode"]."' ,deltype='".$_POST["editdeltype"]."' ,paycondate='".$_POST["editpaycondate"]."',invoice='".$_POST["editinvoice"]."' ,vat='".$_POST["editvat"]."' ";
    $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' ";
    $query = mysqli_query($conn,$StrSQL);

    
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขขอขายเรียบร้อยแล้ว '. $_POST["editsocode"].' สำเร็จ','sql'=> $StrSQL));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>