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
            session_start();
            if(isset($_SESSION['username'])){
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
            $username = $_SESSION['username']; 
            $sql = "UPDATE don_hang 
                    SET trang_thai = 'Đã đặt' 
                    WHERE trang_thai = 'Chưa đặt' AND username = '$username'";
            if ($conn->query($sql) === TRUE) {
                echo "Cập nhật thành công!";
            } else {
                echo "Lỗi: " . $conn->error;
            }
            

            header("Location: donhang.php");

        ?>
    </body>
</html>