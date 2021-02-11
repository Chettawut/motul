<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");


    $sql = "SELECT a.sono,a.places,b.unit,b.sellprice,a.amount FROM `sodetail` as a inner join stock as b on (a.stcode=b.stcode) inner join somaster as c on (a.socode=c.socode) ";
    $sql .= " WHERE a.socode='".$_POST["socode"]."' and a.giveaway = '1' order by a.sono desc LIMIT 1 ";
    $query = mysqli_query($conn,$sql);
    $row2 = $query->fetch_assoc();

    $sql = "SELECT amount from stock_level  ";
    $sql .= " WHERE stcode = '". $_POST["stcode"] ."' and places = '3'";
    $query = mysqli_query($conn,$sql);
    $row3 = $query->fetch_assoc();

    $amount_stock=$row3["amount"];

    if($amount_stock>$row2["amount"])
    {
       
        $StrSQL = "INSERT INTO sodetail (socode , stcode , price , unit , amount , supstatus, giveaway, places  ";
                
       //sono ต้องอยู่ท้ายตลอด
        $StrSQL .= ", sono)";
        $StrSQL .= "VALUES (";
        $StrSQL .= "'".$_POST['socode']."', '". $_POST['stcode'] ."', '0', '".$row2["unit"]."' , '1', '01', '1', '3' ";            
        $StrSQL .= ", '".($row2["sono"]+1)."' ) ";
        $query = mysqli_query($conn,$StrSQL);

        
        //ตัดสต๊อก
        $sql = "UPDATE stock_level SET amount = amount - 1 ,price = price-".$row2["sellprice"].",amtprice= price/amount ";
        $sql .= " WHERE stcode = '". $_POST['stcode'] ."' and places = '3' ";
        $query = mysqli_query($conn,$sql);

        
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มรายการของแถมรหัส '. $_POST['stcode'].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
                    
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> 'จำนวนสินค้ารหัส '. $_POST['stcode'].' ไม่เพียงพอ'));
    }
               

    
    // echo $StrSQL;

    
        
?>