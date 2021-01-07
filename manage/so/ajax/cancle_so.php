<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");
    
    $status = "C";
    $flg = "ยกเลิก"; 

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $places = explode(',', $_POST['places']);
    $discount = explode(',', $_POST['discount']);
    
    $amount2 = explode(',', $_POST['amount2']);
    $stcode2 = explode(',', $_POST['stcode2']);
    $unit2 = explode(',', $_POST['unit2']);
    $places2 = explode(',', $_POST['places2']);
    
    $check = 1;

        if($check)
        {

            //เพิ่มสต๊อกสินค้า 
            foreach ($stcode as $key=> $value) {

                $radio=1;

                
                    $sql = "SELECT ratio,amount,price,amtprice FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) INNER join stock_level as c on (a.stcode=c.stcode)";
                    $sql .= " WHERE a.stcode = '". $stcode[$key] ."' and c.places = '". $places[$key] ."'";
                    $query = mysqli_query($conn,$sql);
                    $row2 = $query->fetch_assoc();
                    if($unit[$key]=='ลัง')
                    $radio=$row2["ratio"];
                    $current_amount=$row2["amount"]+($amount[$key]*$radio) ;
                    
                    if($current_amount!=0)
                    {
                        $current_price=$row2["price"]+($row2["amtprice"]*($amount[$key]*$radio));                
                        $current_amtprice=$current_price/$current_amount;
                    }
                    else
                    {
                        $current_price=0;
                        $current_amtprice=0;
                    }
                    
                    
                

                $sql = "UPDATE stock_level SET amount = ".$current_amount." ,price = ".$current_price.",amtprice= ".$current_amtprice." ";
                $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places[$key] ."' ";
                $query = mysqli_query($conn,$sql);

                if(!$query) 
                {
                    $code .= $stcode[$key].' error';
                    $check = 0;
                }
            }
        

        //     //เพิ่มสต๊อกของแถม
            if($check)   
            {
                
                foreach ($stcode2 as $key2=> $value2) {
                    if($stcode2[$key2]!='')
                    {
                        $radio=1;
                        
                            $sql = "SELECT ratio,amount,price,amtprice FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) INNER join stock_level as c on (a.stcode=c.stcode)";
                            $sql .= " WHERE a.stcode = '". $stcode2[$key2] ."' and c.places = '". $places2[$key2] ."'";
                            $query = mysqli_query($conn,$sql);
                            $row2 = $query->fetch_assoc();
                            if($unit2[$key2]=='ลัง')
                            $radio=$row2["ratio"];
                            $current_amount=$row2["amount"] + ($amount2[$key2]*$radio) ;

                            if($current_amount!=0)
                                {              
                                    $current_price=$row2["price"]+($row2["amtprice"]*($amount2[$key2]*$radio));
                                    $current_amtprice=$current_price/$current_amount;
                                }
                            else
                                {
                                    $current_price=0;
                                    $current_amtprice=0;
                                }      


                        $sql = "UPDATE stock_level SET amount = ".$current_amount." ,price = ".$current_price.",amtprice= ".$current_amtprice." ";
                        $sql .= " WHERE stcode = '". $stcode2[$key2] ."' and places = '". $places2[$key2] ."' ";
                        $query = mysqli_query($conn,$sql);

                        if(!$query) 
                        {
                            $code .= $stcode2[$key2].' ';
                            $check = 0;
                        }
                    }
                }
            }
        }

            if($check)   
            {
                $so_code = $_POST["editsocode"];
                $StrSQL = "UPDATE sodetail SET supstatus = '$status' WHERE socode = '$so_code'";
                $query = mysqli_query($conn,$StrSQL);  
            }

        if($check) {            
            echo json_encode(array('status' => '1','message'=> $flg . 'ใบสั่งขาย '. $_POST['editsocode'].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
        exit;
?>