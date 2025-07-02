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
            if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
                $masach = $_POST['ma_sach']; 
                $ten_sach = $_POST['ten_sach'];
                $tac_gia = $_POST['tac_gia'];
                $gia = $_POST['gia'];
                $so_luong_ton = $_POST['so_luong_ton'];
                $anh_bia = $_POST['anh_bia'];
                $the_loai = $_POST['the_loai'];
                $update_sql = "UPDATE sach  SET ten_sach = '$ten_sach', tac_gia = '$tac_gia', gia = $gia, so_luong_ton = $so_luong_ton, anh_bia = '$anh_bia',the_loai = '$the_loai' WHERE ma_sach = $masach";
                if ($conn->query($update_sql) === TRUE) {
                    echo "Cập nhật thành công!";
                    header("location: home.php");
                } else {
                    echo "Cập nhật thất bại: " . $conn->error;
                }
            }
            else{
                echo "<script>
                        alert('Bạn cần đăng nhập và là admin để sử dụng chức năng này .');
                        window.location.href = 'dangnhap.php';
                    </script>";
            }
        ?>
        
    </body>
</html>