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
            $ma_sach = intval($_POST['ma_sach']);
            $so_luong = intval($_POST['so_luong']);
            $order_id = $_POST['order_id'];

            $sql_cap_nhat = "UPDATE chi_tiet_don_hang 
                            SET so_luong = so_luong + $so_luong 
                            WHERE ma_sach = '$ma_sach' AND order_id = '$order_id'" ;  

            if ($conn->query($sql_cap_nhat) === TRUE) {
                echo "Cập nhật thành công!";
            } else {
                echo "Lỗi: " . $mysqli->error;
            }
            $sql_update_total = "UPDATE don_hang SET gia_tong = (SELECT SUM(so_luong * gia) FROM chi_tiet_don_hang WHERE order_id = '$order_id') WHERE id = '$order_id'";
            $conn->query($sql_update_total);
        
            header("Location: giohang.php");
        
        ?>
    </body>
</html>