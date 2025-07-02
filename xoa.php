<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chỉnh sửa thông tin cá nhân</title>
        <link rel="stylesheet" href="./css/styleform.css">
    </head>
    <body>
        <?php 
            require 'connect.php';
            session_start();
            if(isset($_SESSION['username']) ){
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = $conn->query($sql);
                $user = $result->fetch_assoc();  
            }
            else{
                echo "<script>
                        alert('Bạn cần đăng nhập để sử dụng chức năng này .');
                        window.location.href = 'dangnhap.php';
                    </script>";
            }
            $sql = "DELETE FROM users WHERE username = '$username'";

            if ($conn->query($sql) === TRUE) {
                echo "Tài khoản đã được xóa thành công!";
                session_unset();
                session_destroy();
                echo "<script>
                        alert('Tài khoản đã xóa thành công !');
                        window.location.href = 'home.php';
                    </script>";
            } else {
                echo "Xóa tài khoản thất bại: " . $conn->error;
            }

$conn->close();
        ?>
    </body>
</html>