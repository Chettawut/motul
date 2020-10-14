<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $StrSQL = "INSERT INTO supplier (`supcode`, `supname`, `idno`, `road`, `subdistrict` ,`district`";
    $StrSQL .= ",`province`, `zipcode`, `tel`, `fax`, `taxnumber` ,`email`,`status`";
    $StrSQL .= ",`s_date`,`s_time`)";
    $StrSQL .= " VALUES (";
    $StrSQL .= "'".$_POST["supcode"]."','".$_POST["supname"]."','".$_POST["idno"]."','".$_POST["road"]."','".$_POST["subdistrict"]."','".$_POST["district"]."'";
    $StrSQL .= ",'".$_POST["province"]."','".$_POST["zipcode"]."','".$_POST["tel"]."','".$_POST["fax"]."','".$_POST["taxnumber"]."','".$_POST["email"]."'";
    $StrSQL .= ",'Y','".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มรหัสผู้ขาย '.$_POST["supcode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>