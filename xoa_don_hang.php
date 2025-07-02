<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
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
            $ma_sach = $_GET['ma_sach']; 

            $sql = "DELETE FROM chi_tiet_don_hang 
                    WHERE order_id in
                        (SELECT id FROM don_hang WHERE username = '$username' AND trang_thai = 'Chưa đặt') 
                    AND ma_sach = $ma_sach LIMIT 1";
            $conn->query($sql);

            header("Location: giohang.php");
            exit();
        ?>
        
    </body>
</html>