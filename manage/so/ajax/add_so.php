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

    $code='';
    $warehouse=array("","A","B","C");
    $socode;
    $yearsocode;
    $check = 1;

    foreach ($stcode as $key=> $value) {
        $sql = "SELECT amount FROM stock_level ";
        $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places[$key] ."' ";
        $query = mysqli_query($conn,$sql);
        while($row = $query->fetch_assoc()) {

            $radio=1;

            if($unit[$key]=='ลัง')
            {
                $sql = "SELECT ratio FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) ";
                $sql .= " WHERE a.stcode = '". $stcode[$key] ."' ";
                $query = mysqli_query($conn,$sql);
                $row2 = $query->fetch_assoc();
                $radio=$row2["ratio"];
            }
        
            if($row["amount"]<($amount[$key]*$radio))
            {
                $code .= 'ยอดสต๊อกรหัส '.$stcode[$key].' สต๊อก '.$warehouse[$places[$key]].' ไม่เพียงพอ                                                    ';
                $check = 0;
            }
        }

        // $code++;
        
    }        

    foreach ($stcode2 as $key2=> $value2) {
        $sql = "SELECT amount FROM stock_level ";
        $sql .= " WHERE stcode = '". $stcode2[$key2] ."' and places = '". $places2[$key2] ."' ";
        $query = mysqli_query($conn,$sql);
        while($row = $query->fetch_assoc())
        {

            $radio=1;

            if($unit2[$key2]=='ลัง')
            {
                $sql = "SELECT ratio FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) ";
                $sql .= " WHERE a.stcode = '". $stcode2[$key2] ."' ";
                $query = mysqli_query($conn,$sql);
                $row2 = $query->fetch_assoc();
                $radio=$row2["ratio"];
            }

            if($row["amount"]<($amount2[$key2]*$radio))
            {
                $code .= 'ยอดสต๊อกรหัส '.$stcode2[$key2].' สต๊อก '.$warehouse[$places2[$key2]].' ไม่เพียงพอ                                                    ';
                // $code = $row["amount"].' '.$amount[$key].' '.$socode;
                $check = 0;
            }
        }
    }

    if($check==1)
    {
        
        $sql = "SELECT * FROM options order by year desc LIMIT 1";
        $query = mysqli_query($conn,$sql);

            while($row = $query->fetch_assoc()) {
                $code=sprintf("%03s", $row["maxsocode"]);
                $yearsocode=$row["year"];            
                $socode= $yearsocode.'KM'.$code;
            }

        $StrSQL = "INSERT INTO somaster (socode,cuscode,sodate,deldate,paydate,payment,currency,vat,remark,salecode,date,time";
        $StrSQL .= ")";
        $StrSQL .= "VALUES (";
        $StrSQL .= "'".$socode."','".$_POST["cuscode"]."','".$_POST["sodate"]."','".$_POST["deldate"]."','".$_POST["paydate"]."','".$_POST["payment"]."' ";
        $StrSQL .= ", '".$_POST["currency"]."' , '".$_POST["vat"]."', '".$_POST["remark"]."', '".$_POST["salecode"]."' , '".date("Y-m-d")."','".date("H:i:s")."' ";
        $StrSQL .= ") ";
        $query = mysqli_query($conn,$StrSQL);

        if($query) {
            $strSQL = "UPDATE options SET ";
            $strSQL .= "maxsocode='".($code+1)."' ";
            $strSQL .= "WHERE year= ".$yearsocode." ";
            $query = mysqli_query($conn,$strSQL);
            foreach ($stcode as $key=> $value) {
                $StrSQL = "INSERT INTO sodetail (socode , stcode , price , unit , amount , supstatus , discount, giveaway, places ";

                //pono ต้องอยู่ท้ายตลอด
                $StrSQL .= ", sono)";
                $StrSQL .= "VALUES (";
                $StrSQL .= "'".$socode."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , '01', '". $discount[$key] ."', '0', '". $places[$key] ."' ";            
                $StrSQL .= ", '". ++$key ."' ) ";
                $query = mysqli_query($conn,$StrSQL);
                }

                foreach ($stcode2 as $key2=> $value2) {
                    if($stcode2[$key2]!='')
                    {

                    $StrSQL = "INSERT INTO sodetail (socode , stcode , price , unit , amount , supstatus, giveaway, places  ";
                
                    //rrno ต้องอยู่ท้ายตลอด
                    $StrSQL .= ", sono)";
                    $StrSQL .= "VALUES (";
                    $StrSQL .= "'".$socode."', '". $stcode2[$key2] ."', '0', '". $unit2[$key2] ."' , '". $amount2[$key2] ."', '01', '1', '". $places2[$key2] ."' ";            
                    $StrSQL .= ", '". ++$key2 ."' ) ";
                    $query2 = mysqli_query($conn,$StrSQL);
                    }
                }
        }

        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบสั่งขาย '. $socode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
        
    }
    else
    echo json_encode(array('status' => '0','message'=> $code));
    
    // echo $StrSQL;

    
        
?>