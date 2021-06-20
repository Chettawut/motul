<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MOTUL by KM5AUTO
    </title>

    <?php include_once('css.php'); ?>

    <style>
    * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
        font-size: 16px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    @media screen and (max-width: 480px) {
        .login {
            width: 200px;
        }
    }

    @media (min-width:1025px) {
        .login {
            width: 200px;
        }
    }

    .login {
        width: 380px;
        background-color: #ffffff;
        box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
        margin: 100px auto;
    }

    .login h1 {
        text-align: center;
        color: #5b6574;
        font-size: 26px;
        padding: 15px 0 10px 0;
        border-bottom: 1px solid #dee0e4;
    }

    .login form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 20px;
    }

    .login form label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #e6001a;
        color: #ffffff;
    }

    .login form input[type="password"],
    .login form input[type="text"] {
        width: 290px;
        height: 50px;
        border: 1px solid #dee0e4;
        margin-bottom: 20px;
        padding: 0 15px;
    }

    .login form input[type="submit"] {
        width: 100%;
        padding: 15px;
        margin-top: 20px;
        background-color: #e6001a;
        border: 0;
        cursor: pointer;
        font-weight: bold;
        color: #ffffff;
        transition: background-color 0.2s;
    }

    .login form input[type="submit"]:hover {
        background-color: #e6551a;
        transition: background-color 0.2s;
    }

    .modal-css {
        pointer-events: auto;
        width: 100%;
    }
    </style>
</head>

<body>

    <?php include_once('header.php'); ?>

    <?php 
    if(isset($_GET['log']))
    {
        if($_GET['log']=='username')
        $message = "Username ไม่ถูกต้อง";
        else if($_GET['log']=='password')
        $message = "Password ไม่ถูกต้อง";
        else if($_GET['log']=='disable')
        $message = "คุณไม่ได้เป็นพนักงานบริษัทนี้แล้ว";
        echo "<script type='text/javascript'>alert('$message');</script>";
        // header( "Location: index.php");
        echo "<script type='text/javascript'>window.location.replace('..');</script>";

    }
    ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">
                    <a href="<?php echo PATH; ?>/contact.php">
                        <h2 class="post-title">
                            ติดต่อเรา
                        </h2>
                    </a>
                    <h5 class="post-subtitle">
                        บริษัท เคเอ็ม.5 ออโต้ จำกัด<br>
                        เบอร์โทรศัพท์ 
                        082-556-6594,
                        066-149-9223<br>
                        ที่อยู่ 51/33 หมู่ที่ 7 ต.พลูตาหลวง อ.สัตหีบ จ.ชลบุรี 2018<br>
                        KM5AUTO2020@hotmail.com<br>
                        FACEBOOK : KM.5 Auto Thailand<br>
                        LINE@ : @km5auto
                    </h5>
                    <p class="post-meta">Posted by
                        <a href="#">Admin</a>
                        on 20 มิถุนายน , 2021
                    </p>
                </div>


            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-css">
                <div class="login">

                    <h1> <img src="img/logo.jpg" width="90px;"></h1>
                    <form action="login_result.php" method="post">
                        <label for="username">
                            <i class="fas fa-user"></i>
                        </label>
                        <input type="text" name="username" placeholder="Username" id="username" required>
                        <label for="password">
                            <i class="fas fa-lock"></i>
                        </label>
                        <input type="password" name="password" placeholder="Password" id="password" required>
                        <input type="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php include_once('footer.php'); ?>


</body>

</html>