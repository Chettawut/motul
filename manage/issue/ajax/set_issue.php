<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    $places = explode(',', $_POST['places']);
    
    $amount2 = explode(',', $_POST['amount2']);
    $stcode2 = explode(',', $_POST['stcode2']);
    $unit2 = explode(',', $_POST['unit2']);
    $places2 = explode(',', $_POST['places2']);

    $check = 1;
    $code = '';
    $socode= $_POST['editsocode'];

    // foreach ($stcode as $key=> $value) {
    //     $sql = "SELECT amount FROM stock_level ";
    //     $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places[$key] ."' ";
    //     $query = mysqli_query($conn,$sql);
    //     while($row = $query->fetch_assoc()) {
        
    //         if($row["amount"]<$amount[$key])
    //         {
    //             $code .= $stcode[$key].' ';
    //             $check = 0;
    //         }
    //     }

    //     // $code++;
        
    // }

        

    // foreach ($stcode2 as $key2=> $value2) {
    //     $sql = "SELECT amount FROM stock_level ";
    //     $sql .= " WHERE stcode = '". $stcode2[$key2] ."' and places = '". $places2[$key2] ."' ";
    //     $query = mysqli_query($conn,$sql);
    //     while($row = $query->fetch_assoc())
    //     {
    //         if($row["amount"]<$amount2[$key2])
    //         {
    //             $code .= $stcode2[$key2].' ';
    //             // $code = $row["amount"].' '.$amount[$key].' '.$socode;
    //             $check = 0;
    //         }
    //     }
    // }


    if($check==1)
    {

        if($check==1)   
        {
            //แก้สถานะ
            $StrSQL = "UPDATE sodetail SET supstatus = '04' WHERE socode = '$socode'";
            $query = mysqli_query($conn,$StrSQL); 

            echo json_encode(array('status' => '1','message'=> 'ตัดสต๊อก '. $socode.' สำเร็จ'));        
        }             
        else
        {
        echo json_encode(array('status' => '0','message'=> 'การตัดสต๊อกรหัสพัสดุ '. $code.' มีปัญหา'));        
        }

    }
    else
    {
        echo json_encode(array('status' => '0','message'=> 'ยอดสต๊อกรหัส '. $code.' มีไม่เพียงพอ'));
    }
    
    
    
        mysqli_close($conn);
?>