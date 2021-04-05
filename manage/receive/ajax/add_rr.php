<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $recamount = explode(',', $_POST['recamount']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $pocode = explode(',', $_POST['pocode']);
    $price = explode(',', $_POST['price']);
    $discount = explode(',', $_POST['discount']);
    $places = explode(',', $_POST['places']);

    $amount2 = explode(',', $_POST['amount2']);
    $stcode2 = explode(',', $_POST['stcode2']);
    $unit2 = explode(',', $_POST['unit2']);
    $price2 = explode(',', $_POST['price2']);
    $places2 = explode(',', $_POST['places2']);
    

    $code;
    $rrcode;
    $yearrrcode;
    
    $sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=sprintf("%03s", $row["maxrrcode"]);
            $yearrrcode=$row["year"];
			$rrcode= $yearrrcode.'/'.$code;
        }

    $StrSQL = "INSERT INTO rrmaster (rrcode,supcode,rrdate,invcode,invdate,payment ,date , time";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$rrcode."','".$_POST["supcode"]."','".$_POST["rrdate"]."','".$_POST["invcode"]."','".$_POST["invdate"]."','".$_POST["payment"]."' ";
    $StrSQL .= " , '".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxrrcode='".($code+1)."' ";
        $strSQL .= "WHERE year= ".$yearrrcode." ";
        $query = mysqli_query($conn,$strSQL);

        
        foreach ($stcode as $key=> $value) {

            $sql3 = "SELECT amount,recamount FROM podetail where pocode = '".$pocode[$key]."' and stcode = '".$stcode[$key]."' ";
	        $query3 = mysqli_query($conn,$sql3);
            $checkstatus;
            while($row = $query3->fetch_assoc()) {

                $poamount=$row["amount"];
                $recamounttotal=$recamount[$key]+$row["recamount"];
                if($poamount > $recamounttotal)
                $checkstatus='02';
                else 
                $checkstatus='03';
            }

            $radio=1;
            if($unit[$key]=='ลัง')
            {
                $sql = "SELECT ratio FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) ";
                $sql .= " WHERE a.stcode = '". $stcode[$key] ."' ";
                $query = mysqli_query($conn,$sql);
                $row2 = $query->fetch_assoc();
                $radio=$row2["ratio"];
            }

            $strSQL = "UPDATE options SET ";
            $strSQL .= "maxrrcode='".($code+1)."' ";
            $strSQL .= "WHERE year= ".$yearrrcode." ";
            $query = mysqli_query($conn,$strSQL); 

            $strSQL2 = "UPDATE stock_level SET ";
            $strSQL2 .= "price= price + '".(($price[$key]*$recamount[$key])-(($price[$key]*$recamount[$key])*$discount[$key]/100) )."',amount= amount+'".$recamount[$key]*$radio."',amtprice= price/amount ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and places = '".$places[$key]."' ";
            $query2 = mysqli_query($conn,$strSQL2);

            $strSQL2 = "UPDATE podetail SET ";
            $strSQL2 .= "recamount= recamount+'".$recamount[$key]."',supstatus = '".$checkstatus."' ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and pocode = '".$pocode[$key]."' ";
            $query2 = mysqli_query($conn,$strSQL2);
            
            $StrSQL = "INSERT INTO rrdetail (rrcode , stcode , price , unit , amount , discount, pocode , rrstatus, giveaway, places  ";
        
            //rrno ต้องอยู่ท้ายตลอด
            $StrSQL .= ", rrno)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$rrcode."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $recamount[$key] ."', '". $discount[$key] ."', '". $pocode[$key] ."' , '".$checkstatus."', '0', '". $places[$key] ."' ";            
            $StrSQL .= ", '". ++$key ."' ) ";
            $query2 = mysqli_query($conn,$StrSQL);


        }
        
            foreach ($stcode2 as $key2=> $value2) {
                if($stcode2[$key2]!='')
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

                $strSQL2 = "UPDATE stock_level SET ";
                $strSQL2 .= "price= price + '".($price2[$key2]*$amount2[$key2])."',amount= amount+'".$amount2[$key2]*$radio."',amtprice= price/amount ";
                $strSQL2 .= "WHERE stcode = '".$stcode2[$key2]."' and places = '".$places2[$key2]."' ";
                $query2 = mysqli_query($conn,$strSQL2);

                $StrSQL = "INSERT INTO rrdetail (rrcode , stcode , price , unit , amount , rrstatus, giveaway, places  ";
            
                //rrno ต้องอยู่ท้ายตลอด
                $StrSQL .= ", rrno)";
                $StrSQL .= "VALUES (";
                $StrSQL .= "'".$rrcode."', '". $stcode2[$key2] ."', '". $price[$key2] ."', '". $unit2[$key2] ."' , '". $amount2[$key2] ."', '03', '1', '". $places2[$key2] ."' ";            
                $StrSQL .= ", '". ++$key2 ."' ) ";
                $query2 = mysqli_query($conn,$StrSQL);
                }
            }
        
    }
    
    // echo $StrSQL;

    
        if($query2) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบรับสินค้า '. $rrcode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>