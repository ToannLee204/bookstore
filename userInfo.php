<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thông tin người dùng</title>
        <link rel="stylesheet" href="./css/userInfo.css">
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
        <div class="user-profile">
        <h2>Thông tin cá nhân</h2>
        <table>
            <tr>
                <th>Họ và tên:</th>
                <td><?php echo $user['name']; ?></td>
            </tr>
            <tr>
                <th>Tên đăng nhập:</th>
                <td><?php echo $user['username']; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $user['email']; ?></td>
            </tr>
            <tr>
                <th>Số điện thoại:</th>
                <td><?php echo $user['phone_number']; ?></td>
            </tr>
            <tr>
                <th>Địa chỉ:</th>
                <td><?php echo $user['address']; ?></td>
            </tr>
            <tr>
                <th>Ngày tạo tài khoản:</th>
                <td><?php echo $user['created_at']; ?></td>
            </tr>
        </table>

        <div class="hanh_dong">
            <a href="home.php">Trang chủ</a>
            <a href="chinh_sua.php" class="chinh_sua">Chỉnh sửa thông tin</a>
            <?php 
                if(isset($_SESSION['username'])){
                    if($_SESSION['username']=='admin'){
                        echo '<a href="themsach.html">Thêm sách</a>';
                    }
                }
                else{
                    echo '<a href="xoa.php" class="xoa">Xóa tài khoản</a>';
                }
            ?>
            
            
            
        </div>
    </div>
    </body>
</html>