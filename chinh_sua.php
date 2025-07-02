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
        ?>
        <div class="chinh_sua">
            <h2>Chỉnh sửa thông tin cá nhân</h2>
            <form method="POST" action="xulychinhsua.php">
                Họ và tên:
                <input type="text"  class="info" name="name" value="<?php echo $user['name']; ?>" required><br><br>
                Email:
                <input type="text" class="info" name="email" value="<?php echo $user['email']; ?>" required><br><br>
                Số điện thoại:
                <input type="text"  class="info" name="phone" value="<?php echo $user['phone_number']; ?>" required><br><br>
                Địa chỉ:
                <input  name="address" class="info" value="<?php echo $user['address']; ?>" required><br><br>
                Mật khẩu:
                <input  name="password" class="info" value="<?php echo $user['password']; ?>" required><br><br>
                <input type="submit" class="btn" value="Cập nhật">
            </form>
        </div>
    </body>
</html>