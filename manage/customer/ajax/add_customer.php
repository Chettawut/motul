<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $_POST["cuscode"] = $_POST["cuscode1"].$_POST["cuscode2"].$_POST["cuscode3"];

    $StrSQL = "INSERT INTO customer (`cuscode`, `cusname`, `idno`, `road`, `subdistrict` ,`district`";
    $StrSQL .= ",`province`, `zipcode`, `tel`, `fax`, `taxnumber` ,`email`,`status`,`salecode`";
    $StrSQL .= ",`s_date`,`s_time`)";
    $StrSQL .= " VALUES (";
    $StrSQL .= "'".$_POST["cuscode"]."','".$_POST["cusname"]."','".$_POST["idno"]."','".$_POST["road"]."','".$_POST["subdistrict"]."','".$_POST["district"]."'";
    $StrSQL .= ",'".$_POST["province"]."','".$_POST["zipcode"]."','".$_POST["tel"]."','".$_POST["fax"]."','".$_POST["taxnumber"]."','".$_POST["email"]."'";
    $StrSQL .= ",'Y','".$_POST["salecode"]."','".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
   
    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มรหัสลูกค้า '.$_POST["cuscode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>