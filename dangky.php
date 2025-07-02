<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng Ký</title>
    </head>
    <body>
        <?php 

            require 'connect.php';
            $tai_khoan = $_POST['username'];
            $mat_khau = $_POST['password'];
            $email = $_POST["email"];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone_number = $_POST["phone_number"];
            $sql1 = "SELECT username from users where username = '$tai_khoan'";
            $result = $conn->query($sql1);
            if($result->num_rows != 0 ){
                echo "<script>
                        alert('Đã tồn tại tài khoản . Vui lòng thử tên khác .');
                        window.location.href = 'dangky.html';
                    </script>";
                // header("location: dangky.html");
                
            }
            $sql = "INSERT INTO users (username,password,email,name,address,phone_number) 
                    VALUES ('$tai_khoan','$mat_khau','$email','$name','$address','$phone_number')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Đăng ký thành công !');
                        window.location.href = 'home.php';
                    </script>";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

        ?>
    </body>
</html>