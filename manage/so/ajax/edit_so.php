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
    
    $editplaces = 0;
    
    if($_POST["editvat"]=='Y')
         $editplaces = 1;    
    else if($_POST["editvat"]=='N')
         $editplaces = 2;
     

    $check=1;
        //แก้ไขสต๊อกของขาย
        foreach ($stcode as $key=> $value) {

            $sql = "SELECT amount,unit FROM `sodetail` ";
            $sql .= " WHERE socode='".$_POST["editsocode"]."' and sono = '". ($key+1) ."' and giveaway = '0' ";
            $query = mysqli_query($conn,$sql);
            $row2 = $query->fetch_assoc();

            $amount_dif=0;
            $amount_old=$row2["amount"]; 
            $unit_old=$row2["unit"]; 
         
                    $radio=1;
                    $radio_old=1;                    

                    $sql = "SELECT ratio,amount,price,amtprice FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) INNER join stock_level as c on (a.stcode=c.stcode) ";
                    $sql .= " WHERE a.stcode = '". $stcode[$key] ."' and c.places = '".$editplaces."'";
                    $query = mysqli_query($conn,$sql);
                    $row2 = $query->fetch_assoc();

                    $amount_stock=$row2["amount"];
                    
                    if($unit[$key]=='ลัง')
                    $radio=$row2["ratio"];
                    if($unit_old=='ลัง')
                    $radio_old=$row2["ratio"];
                    
                    $amount_dif=($amount[$key]*$radio)-($amount_old*$radio_old);

                if(($amount_stock-$amount_dif)>=0)
                {
                    $current_amount=$amount[$key]*$radio;

                    if($current_amount!=0)
                    {
                        $current_price=$price[$key]*$radio;               
                    }
                    else
                    {
                        $current_price=0;
                        $current_amtprice=0;
                    }    

                    if($editplaces!=$places[$key])
                    {
                        if($current_amount<$amount_stock)
                        {                        
                        $sql = "UPDATE stock_level SET amount = amount+".$current_amount." ,price = price+".($current_price).",amtprice= price/amount ";
                        $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places[$key] ."' ";
                        $query = mysqli_query($conn,$sql);
                        
                        $sql = "UPDATE stock_level SET amount = amount-".$current_amount." ,price = price-".$current_price.",amtprice= price/amount ";
                        $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $editplaces ."' ";
                        $query = mysqli_query($conn,$sql);
                        }
                        else
                        {
                            $error = 'ยอดสต๊อก'.$stcode[$key].'ไม่เพียงพอ ไม่สามารถย้ายคลัง Vat ได้';
                            $check = 0;
                        }   
                    } 
                    else  
                    {                        
                        $current_price=$row2["price"]+($row2["amtprice"]*($amount_dif*$radio)); 

                        $sql = "UPDATE stock_level SET amount = amount-".$amount_dif." ,price = ".$current_price.",amtprice= price/amount ";
                        $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places[$key] ."' ";
                        $query = mysqli_query($conn,$sql);
                    }
                        if(!$query) 
                        {
                            $code .= $stcode[$key].' error';
                            $check = 0;
                        }
                }
                else
                {
                    ///////////////////////////////////////
                    $error = 'ยอดสต๊อก'.$stcode[$key].'ไม่เพียงพอ';
                    $check = 0;
                }                
                
            if($check) 
                {

                    $StrSQL = "UPDATE sodetail SET places ='". $editplaces ."', price ='". $price[$key] ."', unit ='". $unit[$key] ."', amount ='". $amount[$key] ."', discount = '". $discount[$key] ."' ";
                    $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' and sono= '". ++$key ."' and giveaway = '0' ";
                    
                    $query = mysqli_query($conn,$StrSQL);                             
                    
                    
                }
                
        }

    if($check) 
    {
        foreach ($stcode2 as $key2=> $value2) {
            if($stcode2[$key2]!='')
            {
                $sql = "SELECT amount,unit FROM `sodetail` ";
                $sql .= " WHERE socode='".$_POST["editsocode"]."' and sono = '". ($key2+1) ."' and giveaway = '1' ";
                $query = mysqli_query($conn,$sql);
                $row2 = $query->fetch_assoc();

                $amount_dif=0;
                $amount_old=$row2["amount"]; 
                $unit_old=$row2["unit"];                 
            
                    $radio=1;
                    $radio_old=1;                    

                    $sql = "SELECT ratio,amount,price,amtprice FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) INNER join stock_level as c on (a.stcode=c.stcode) ";
                    $sql .= " WHERE a.stcode = '". $stcode2[$key2] ."' and c.places = '". $places2[$key2] ."'";
                    $query = mysqli_query($conn,$sql);
                    $row2 = $query->fetch_assoc();

                    $amount_stock=$row2["amount"];
                    
                    if($unit2[$key2]=='ลัง')
                    $radio=$row2["ratio"];
                    if($unit_old=='ลัง')
                    $radio_old=$row2["ratio"];
                    
                    $amount_dif=($amount2[$key2]*$radio)-($amount_old*$radio_old);

                if(($amount_stock-$amount_dif)>0)
                {

                    $current_amount=$row2["amount"]-($amount_dif) ;
                    
                    if($current_amount!=0)
                    {
                        $current_price=$row2["price"]+($row2["amtprice"]*($amount_dif*$radio));                
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
                        $code .= $stcode2[$key2].' error';
                        $check = 0;
                    }
                }
                else
                {
                    ///////////////////////////////////////
                    $error = 'ยอดสต๊อก'.$stcode2[$key2].'ไม่เพียงพอ';
                    $check = 0;
                }


                if($check) 
                {
                    $StrSQL = "UPDATE sodetail SET stcode='". $stcode2[$key2] ."' , unit ='". $unit2[$key2] ."', amount ='". $amount2[$key2] ."' ";
                    $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' and sono= '". ++$key2 ."' and giveaway = '1' ";
                    $query = mysqli_query($conn,$StrSQL);

                    

                }
            }
        }
    }

    if($check)
    {
        $StrSQL = "UPDATE somaster SET date = '".date("Y-m-d")."', time='".date("H:i:s")."' ";
        $StrSQL .= ",deldate='".$_POST["editdeldate"]."' ,sodate='".$_POST["editsodate"]."',payment='".$_POST["editpayment"]."' ,paydate='".$_POST["editpaydate"]."',currency='".$_POST["editcurrency"]."' ,vat='".$_POST["editvat"]."',remark='".$_POST["editremark"]."' ";
        $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' ";
        $query = mysqli_query($conn,$StrSQL);
            if($query) {
                echo json_encode(array('status' => '1','message'=> 'แก้ไขใบแจ้งซื้อเรียบร้อยแล้ว '. $_POST["editsocode"].' สำเร็จ','sql'=> $StrSQL));
            }
            else
            {
                echo json_encode(array('status' => '0','message'=> $StrSQL));
            }
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $error));
    }
    
    
        // mysqli_close($conn);
?>