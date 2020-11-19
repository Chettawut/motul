<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $places1 = explode(',', $_POST['places1']);
    $places2 = explode(',', $_POST['places2']);
    
    $code='';
    $warehouse=array("","A","B","C");
    $tfcode;
    $yeartfcode;

    $amtprice=array();

    $check = 1;

    foreach ($stcode as $key=> $value) {
        $sql = "SELECT amount,amtprice FROM stock_level ";
        $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places1[$key] ."' ";
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
                $code .= 'ยอดสต๊อกรหัส '.$stcode[$key].' สต๊อก '.$warehouse[$places1[$key]].' ไม่เพียงพอ                                                    ';
                $check = 0;
            }
            else
            {
                array_push($amtprice,$row["amtprice"]);
            }
        }

        // $code++;
        
    }        

    //ลบ
    if($check==1)
    {
        foreach ($stcode as $key=> $value) {
    
                $radio=1;
    
                if($unit[$key]=='ลัง')
                {
                    $sql = "SELECT ratio FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) ";
                    $sql .= " WHERE a.stcode = '". $stcode[$key] ."' ";
                    $query = mysqli_query($conn,$sql);
                    $row2 = $query->fetch_assoc();
                    $radio=$row2["ratio"];
                }

                $sql = "UPDATE stock_level SET amount = amount - ". $amount[$key]*$radio .", price = amtprice*amount ";
                $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places1[$key] ."' ";
                $query2 = mysqli_query($conn,$sql);
            
                if(!$query2) 
                    {
                        $code .= $stcode[$key].' ';
                        $check = 0;
                    }
            
        }  

        //เพิ่ม
        if($check==1)
        {   
            foreach ($stcode as $key=> $value) {
    
                $radio=1;
    
                if($unit[$key]=='ลัง')
                {
                    $sql = "SELECT ratio FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) ";
                    $sql .= " WHERE a.stcode = '". $stcode[$key] ."' ";
                    $query = mysqli_query($conn,$sql);
                    $row2 = $query->fetch_assoc();
                    $radio=$row2["ratio"];
                }

                $sql = "UPDATE stock_level SET amount = amount + ". $amount[$key]*$radio .",amtprice=$amtprice[$key], price = amtprice*amount ";
                $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places2[$key] ."' ";
                $query2 = mysqli_query($conn,$sql);
            
                if(!$query2) 
                    {
                        $code .= $stcode[$key].' ';
                        $check = 0;
                    }
            
            }  
                //สร้าง TF
                if($check==1)
                { 
                    $sql = "SELECT * FROM options order by year desc LIMIT 1";
                    $query = mysqli_query($conn,$sql);

                    while($row = $query->fetch_assoc()) {
                        $code=sprintf("%03s", $row["maxtfcode"]);
                        $yeartfcode=$row["year"];
                        $tfcode= 'TF'.$yeartfcode.$code;            
                        
                    }

                    $StrSQL = "INSERT INTO tfmaster (tfcode,tfdate,trandate,remark,salecode,date,time";
                    $StrSQL .= ")";
                    $StrSQL .= " VALUES (";
                    $StrSQL .= "'".$tfcode."','".$_POST["tfdate"]."','".$_POST["trandate"]."','".$_POST["remark"]."','".$_POST["salecode"]."', '".date("Y-m-d")."','".date("H:i:s")."' ";
                    $StrSQL .= ") ";
                    $query = mysqli_query($conn,$StrSQL);

                    if($query) {
                        $strSQL = "UPDATE options SET ";
                        $strSQL .= "maxtfcode='".($code+1)."' ";
                        $strSQL .= "WHERE year= ".$yeartfcode." ";
                        $query = mysqli_query($conn,$strSQL);
                        foreach ($stcode as $key=> $value) {
                            $StrSQL = "INSERT INTO tfdetail (tfcode , stcode , unit , amount , places1 , places2 ";

                            //pono ต้องอยู่ท้ายตลอด
                            $StrSQL .= ", tfno)";
                            $StrSQL .= "VALUES (";
                            $StrSQL .= "'".$tfcode."', '". $stcode[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , '". $places1[$key] ."', '". $places2[$key] ."' ";            
                            $StrSQL .= ", '". ++$key ."' ) ";
                            $query = mysqli_query($conn,$StrSQL);
                            }

                            
                    }

                    if($query) {
                        echo json_encode(array('status' => '1','message'=> 'เพิ่มใบย้ายสินค้า '. $tfcode.' สำเร็จ'));
                    }
                    else
                    {
                        echo json_encode(array('status' => '0','message'=> $StrSQL));
                    }
                }
                else
                echo json_encode(array('status' => '0','message'=> $code));   
        }
        else
        echo json_encode(array('status' => '0','message'=> $code));   
        
    }
    else
    echo json_encode(array('status' => '0','message'=> $code));
    
    // echo $StrSQL;

    
        
?>