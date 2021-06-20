<?php
	header('Content-Type: application/json');
	include('../../conn.php');
	
    $strSQL = "SELECT username,firstname,lastname,money,bankcode,bankname,type FROM `user` where username = '".$_POST['username']."' and `password` = '".$_POST['password']."' ";
    // $strSQL = "SELECT username,firstname,lastname,money,bankcode,bankname FROM `User` where username = 'user' and password = 'user' ";
    $query = mysqli_query($conn,$strSQL);
    $row = $query->fetch_assoc();

        if($query) {
            echo json_encode(array('status' => '1','firstname' => $row["firstname"],'lastname' => $row["lastname"],'money' => $row["money"],'username' => $row["username"],'bankcode' => $row["bankcode"],'bankname' => $row["bankname"],'type' => $row["type"]));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }



		mysqli_close($conn);
?>