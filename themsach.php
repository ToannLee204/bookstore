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
            $ma_sach = $_POST['ma_sach'];
            $ten_sach = $_POST['ten_sach'];
            $tac_gia = $_POST["tac_gia"];
            $gia = $_POST['gia'];
            $so_luong_ton = $_POST['so_luong_ton'];
            $anh_bia = $_POST["anh_bia"];
            $the_loai = $_POST['the_loai'];
            $sql1 = "SELECT ma_sach from sach where ma_sach = '$ma_sach'";
            $result = $conn->query($sql1);
            if($result->num_rows != 0 ){
                echo "<script>
                        alert('Đã tồn tại mã sách . Vui lòng thử mã khác .');
                        window.location.href = 'themsach.html';
                    </script>";
                // header("location: dangky.html");
                
            }
            $sql = "INSERT INTO sach (ma_sach,ten_sach,tac_gia,gia,so_luong_ton,anh_bia,the_loai) 
                    VALUES ('$ma_sach','$ten_sach','$tac_gia',$gia,$so_luong_ton,'$anh_bia','$the_loai')";
            if ($conn->query($sql) === TRUE) {
                header("location: home.php");
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

        ?>
    </body>
</html>