<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $StrSQL = "INSERT INTO stock (`stcode`, `stname1`, `unit`, `storage_id`, `stmin1`, `stmin2` ,`sellprice`, `status`,`s_date`,`s_time`) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["stcode"]."','".$_POST["stname1"]."','".$_POST["unit"]."','".$_POST["storage_id"]."','".$_POST["stmin1"]."','".$_POST["stmin2"]."' ";
    $StrSQL .= ",'".$_POST["sellprice"]."','Y','".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    

    // echo $StrSQL;


        if($query) {
            $sql = "SELECT * FROM `places` where status = 'Y' ";
            $query1 = mysqli_query($conn,$sql);

                while($row = $query1->fetch_assoc()) {
                    $strSQL2 = " INSERT INTO stock_level (stcode,price,amtprice,amount,places,s_date,s_time) ";
                    $strSQL2 .= " VALUES ('".$_POST["stcode"]."','0','0','0','".$row["placescode"]."','".date("Y-m-d"). "','".date("H:i:s"). "' ) ";
                    $oRs2=mysqli_query($conn,$strSQL2);
                }
            echo json_encode(array('status' => '1','message'=> 'เพิ่มรหัสสินค้า '.$_POST["stcode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>