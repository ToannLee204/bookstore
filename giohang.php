<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Giỏ hàng </title>
        <link rel="stylesheet" href="./css/giohang.css">
        <link rel="stylesheet" href="./css/taskbar.css">
        <link rel="stylesheet" href="./css/nutbam.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="home.php">BOOKSTORE</a>   
            </div>
            <div>
                <form action="ketQuaTimKiem.php" method="get">
                    <input type="text" name="tu_khoa" placeholder="Tìm kiếm sách hoặc tên tác giả ...">
                    <input type="submit" value="Tìm kiếm">
                </form>  
            </div>
            <div>
                <a href="donhang.php">Đơn hàng</a>
                <a href="giohang.php">Giỏ hàng </a>
            </div>
            <div class="user">
                <?php 
                    session_start();
                    if(isset($_SESSION['username'])){
                        echo '<a href="userInfo.php" class="userInfo">' .$_SESSION["username"]. '</a>';
                        echo '<a href="dangxuat.php" class="dangxuat">Đăng xuất</a>';
                    }
                    else{
                ?>
                <a href="dangky.html">Đăng ký</a>
                <a href="dangnhap.php">Đăng nhập</a>
                <?php 
                    
                    }
                ?>
            </div>
        </header>
        <div class="main" style="margin-top: 100px;">

            <?php 
                require 'connect.php';
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
                $username = $_SESSION['username'];
                $sql = "SELECT dh.id, dh.gia_tong, dh.ngay_dat_hang, dh.trang_thai, ctdh.ma_sach, ctdh.so_luong, ctdh.gia, s.ten_sach,ctdh.order_id
                        FROM don_hang dh
                        JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.order_id
                        JOIN sach s ON ctdh.ma_sach = s.ma_sach
                        WHERE dh.username = '$username' AND dh.trang_thai = 'Chưa đặt'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $tong_tien = 0;
                    echo "<h2>Giỏ hàng của bạn</h2>";
                    echo "<table><tr><th>Sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Tổng</th><th>Tăng giảm số lượng</th><th>Xóa</th></tr>";

                    for($i = 0; $i < $result->num_rows;$i++){
                        $row = $result->fetch_assoc();
                        $tong = $row['so_luong'] * $row['gia'];
                        $tong_tien += $tong;
                        echo "<tr>
                                <td>" . $row['ten_sach'] . "</td>
                                <td>" . $row['so_luong'] . "</td>
                                <td>" . $row['gia'] . " VND</td>
                                <td>" . $tong . " VND</td>
                                <td>
                                    <form method='post' action='capnhapsoluong.php'>
                                        <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                                        <input type='hidden' name='ma_sach' value='" . $row['ma_sach'] . "'>
                                        <button type='submit' name='so_luong' value='-1' " . ($row['so_luong'] <= 1 ? 'disabled' : '') . "> - </button>
                                        <button type='submit' name='so_luong' value='1'> + </button>
                                    </form>
                                </td>
                                <td>
                                    <a href='xoa_don_hang.php?ma_sach=" . $row['ma_sach'] . "'>Xóa</a>
                                </td>
                            </tr>";
                            $order_id = $row['order_id'];
                            $sql_capnhap_tong = "UPDATE don_hang SET gia_tong = (SELECT SUM(so_luong * gia) FROM chi_tiet_don_hang WHERE order_id = '$order_id') WHERE id = '$order_id'";
                            $conn->query($sql_capnhap_tong);
                    }
                    echo "<tr>
                            <td colspan='3'>Tổng tiền</td><td>" . $tong_tien . " VND</td>
                            <td colspan='2'>
                                <form method='post' action='dathang.php'>
                                    <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                                    <button type='submit'>Đặt hàng</button>
                                </form>
                            </td>
                        </tr>";
                    echo "</table>";
                } else {
                    echo "<p>Giỏ hàng của bạn đang trống.</p>";
                }
            ?>
        </div>
        
    </body>
</html>