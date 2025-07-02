<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chỉnh sửa thông tin sách</title>
        <link rel="stylesheet" href="./css/styleform.css">
    </head>
    <body>
        <?php 
            require 'connect.php';
            session_start();
            if(isset($_SESSION['username'])){
                $masach = $_POST['ma_sach'];
            }
            else{
                echo "<script>
                        alert('Bạn cần đăng nhập để sử dụng chức năng này .');
                        window.location.href = 'dangnhap.php';
                    </script>";
            }
            $sql = "DELETE FROM sach WHERE ma_sach = '$masach'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Cuốn sách đã xóa thành công !');
                        window.location.href = 'home.php';
                    </script>";
            } else {
                echo "Xóa sách thất bại: " . $conn->error;
            }

        ?>
        
    </body>
</html>