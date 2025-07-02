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
            if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
                $masach = $_POST['ma_sach'];
                $sql = "SELECT * FROM sach WHERE ma_sach = '$masach'";
                $result = $conn->query($sql);
                $book = $result->fetch_assoc();  
        ?>
        <div class="chinh_sua">
            <h2>Chỉnh sửa thông tin sách</h2>
            <form method="POST" action="xulychinhsuasach.php">
                Mã sách :
                <input type='text' name='ma_sach'  class="info" value=' <?php echo $book['ma_sach'] ?>' readonly>
                Tên sách : 
                <input type="text"  class="info" name="ten_sach" value="<?php echo $book['ten_sach']; ?>" required><br><br>
                Tác giả :
                <input type="text" class="info" name="tac_gia" value="<?php echo $book['tac_gia']; ?>" required><br><br>
                Giá :
                <input type="number"  class="info" name="gia" value="<?php echo $book['gia']; ?>" required><br><br>
                Số lượng tồn :
                <input  name="so_luong_ton" type="number" class="info" value="<?php echo $book['so_luong_ton']; ?>" required><br><br>
                Ảnh bìa : 
                <input  name="anh_bia" class="info" value="<?php echo $book['anh_bia']; ?>" required><br><br>
                Thể loại : 
                <input  name="the_loai" class="info" value="<?php echo $book['the_loai']; ?>" required><br><br>
                <input type="submit" class="btn" value="Cập nhật">
            </form>
        </div>

        <?php
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