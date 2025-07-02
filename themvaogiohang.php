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
            if (isset($_POST['them_vao_gio'])){
                $ma_sach = $_POST['ma_sach'];
                $so_luong = 1;
                $sql_check = "SELECT * FROM don_hang WHERE username = '$username' AND trang_thai = 'Chưa đặt'";
                $result_check = $conn->query($sql_check);
                if ($result_check->num_rows == 0) {
                    $sql1 = "INSERT INTO don_hang (username, gia_tong, trang_thai) 
                                        VALUES ('$username', 0, 'Chưa đặt')";
                    $conn->query($sql1);
                    $order_id = $conn->insert_id;
                } else {
                    $order_id = $result_check->fetch_assoc()['id'];
                }
                $sql2 = "SELECT * FROM sach WHERE ma_sach = '$ma_sach'";
                $result2 = $conn->query($sql2);
                $product = $result2->fetch_assoc();
                $gia = $product['gia'];

                $sql_ktra_ctdh = "SELECT * FROM chi_tiet_don_hang WHERE order_id = '$order_id' AND ma_sach = '$ma_sach'";
                $result_ktra_ctdh = $conn->query($sql_ktra_ctdh);

                if ($result_ktra_ctdh->num_rows == 0) {
                    $sql_them_vao_gio_hang = "INSERT INTO chi_tiet_don_hang (order_id, ma_sach, so_luong, gia) 
                                        VALUES ('$order_id', '$ma_sach', '$so_luong', '$gia')";
                    $conn->query($sql_them_vao_gio_hang);
                } else {
                    $row = $result_ktra_ctdh->fetch_assoc();
                    $so_luong_moi = $row['so_luong'] + $so_luong;
                    $sql_capnhap = "UPDATE chi_tiet_don_hang SET so_luong = '$so_luong_moi' WHERE order_id = '$order_id' AND ma_sach = '$ma_sach'";
                    $conn->query($sql_capnhap);
                }
                $sql_capnhap_tong = "UPDATE don_hang SET gia_tong = (SELECT SUM(so_luong * gia) FROM chi_tiet_don_hang WHERE order_id = '$order_id') WHERE id = '$order_id'";
                $conn->query($sql_capnhap_tong);

                header("Location: home.php");
                exit();
            }
        ?>
        
    </body>
</html>