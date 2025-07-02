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
            $id = ($_POST['id']);
            $sql_xoa_chi_tiet = "DELETE FROM chi_tiet_don_hang WHERE order_id = $id";
            if ($conn->query($sql_xoa_chi_tiet) === TRUE) {
                echo "Đã xóa dữ liệu trong bảng chi_tiet_don_hang thành công.<br>";
            } else {
                echo "Lỗi khi xóa dữ liệu trong bảng chi_tiet_don_hang: " . $mysqli->error . "<br>";
            }
            $sql_xoa_don_hang = "DELETE FROM don_hang WHERE id = $id";
            if ($conn->query($sql_xoa_don_hang) === TRUE) {
                echo "Đã xóa dữ liệu trong bảng don_hang thành công.";
            } else {
                echo "Lỗi khi xóa dữ liệu trong bảng don_hang: " . $mysqli->error;
            }
            header("Location: donhang.php");
        ?>
        
    </body>
</html>