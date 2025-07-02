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
            $full_name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $pw = $_POST['password'];
            $update_sql = "UPDATE users SET name = '$full_name', email = '$email', phone_number = '$phone', address = '$address', password = '$pw' WHERE username = '$username'";
            if ($conn->query($update_sql) === TRUE) {
                echo "Cập nhật thành công!";
                header("location: userInfo.php");
            } else {
                echo "Cập nhật thất bại: " . $conn->error;
            }
        ?>
        
    </body>
</html>