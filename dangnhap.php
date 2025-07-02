<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="./css/styleform.css">
    </head>
    <body>
        <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo "<script>
                        alert('Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại.');
                    </script>";
            }
        ?>
        <?php
            session_start();
            if(isset($_SESSION['username'])==false) {
        ?>
        <form action="dangnhap2.php" method="post">
            <h2>Đăng nhập</h2>
            Tài khoản : <input type="text" name="tai_khoan" class="info" >
            Mật khẩu : <input type="text" name="mat_khau"class="info">
            <input type="submit" value="Đăng nhập" class="btn">
            <br>
            Chưa có tài khoản ? <a href="dangky.html">Đăng ký</a>
        </form>
        <?php 
            }
            else{
                header("location: home.php");
            }
        ?>
    </body>
</html>