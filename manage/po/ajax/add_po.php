<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    

    $code;
    $pocode;
    $yearpocode;
    $sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=sprintf("%03s", $row["maxpocode"]);
            $yearpocode=$row["year"];
			$pocode= 'PO'.$yearpocode.'/'.$code;
        }

    $StrSQL = "INSERT INTO pomaster (pocode,supcode,podate,deldate,payment,poqua,currency,vat ,date , time";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$pocode."','".$_POST["supcode"]."','".$_POST["podate"]."','".$_POST["deldate"]."','".$_POST["payment"]."','".$_POST["poqua"]."' ";
    $StrSQL .= ", '".$_POST["currency"]."' , '".$_POST["vat"]."' , '".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxpocode='".($code+1)."' ";
        $strSQL .= "WHERE year= ".$yearpocode." ";
        $query = mysqli_query($conn,$strSQL);
        foreach ($stcode as $key=> $value) {
            $StrSQL = "INSERT INTO podetail (pocode , stcode , price , unit , amount , supstatus , discount,recamount ";

            //pono ต้องอยู่ท้ายตลอด
            $StrSQL .= ", pono)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$pocode."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , '01' ";
            $StrSQL .= ", '". $discount[$key] ."' , '0'  ";
            $StrSQL .= ", '". ++$key ."' ) ";
            $query = mysqli_query($conn,$StrSQL);
            }
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มผู้ใบสั่งซื้อ '. $pocode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>