<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php 
            require 'connect.php';
            $tai_khoan = $_POST['tai_khoan'];
            $mat_khau = $_POST['mat_khau'];
            $sql = "SELECT *  FROM users WHERE username = '$tai_khoan' ";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                header("location: dangnhap.php?error=1");
                exit;
            }
            $row = $result->fetch_assoc();
            if($mat_khau != $row['password']){
                header("location: dangnhap.php?error=1");
                exit;
            }
            session_start();
            $_SESSION['username'] = $tai_khoan;
            echo "<script>
                        alert('Đăng nhập thành công !');
                        window.location.href = 'home.php';
                    </script>";

        ?>
    </body>
</html>