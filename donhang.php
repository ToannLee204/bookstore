<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đơn hàng </title>
        <link rel="stylesheet" href="./css/taskbar.css">
        <link rel="stylesheet" href="./css/giohang.css">
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
                $sql1 = "SELECT id FROM don_hang WHERE username = '$username' ";
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                    echo "<h2>Đơn hàng của bạn</h2>";
                    for($j = 0 ; $j < $result1->num_rows ; $j++){
                        $row1 = $result1->fetch_assoc();
                        $id = $row1['id'];
                        $sql = "SELECT dh.id, dh.gia_tong, dh.ngay_dat_hang, dh.trang_thai, ctdh.ma_sach, ctdh.so_luong, ctdh.gia, s.ten_sach,ctdh.order_id,dh.gia_tong
                                FROM don_hang dh
                                JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.order_id
                                JOIN sach s ON ctdh.ma_sach = s.ma_sach
                                WHERE dh.username = '$username' AND dh.trang_thai = 'Đã đặt' AND dh.id = $id ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<table><tr><th>ID đơn hàng</th><th>Sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Tổng</th></tr>";
                            echo "<tr><td rowspan='" .$result->num_rows. "'>" . $id. "</td>";
                            for($i = 0; $i < $result->num_rows;$i++){
                                $row = $result->fetch_assoc();
                                $tong = $row['so_luong'] * $row['gia'];
                                echo "
                                        <td>" . $row['ten_sach'] . "</td>
                                        <td>" . $row['so_luong'] . "</td>
                                        <td>" . $row['gia'] . " VND</td>
                                        <td>" . $tong . " VND</td>
                                    </tr>";
            
                            }
                            echo "<tr>
                                    <td>
                                        <form action='chinhsuadonhang.php' method='post'>
                                            <input type='hidden' name='id' value='".$id."'>
                                            <button type='submit'>Chỉnh sửa đơn hàng</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='xoadonhangdadat.php' method='post'>
                                            <input type='hidden' name='id' value='".$id."'>
                                            <button type='submit' style='background-color:red;'>Xóa đơn hàng</button>
                                        </form>
                                    </td>
                                    <td colspan='2'>Tổng tiền</td><td>" . $row['gia_tong'] . " VND</td>
                                </tr>";
                            echo "</table>";
                        }
                        // else {
                        //     echo "<p>Đơn hàng của bạn đang trống.</p>";
                        // }
                    }
                } 
                else {
                    echo "<p>Đơn hàng của bạn đang trống.</p>";
                }
            ?>
        </div>
        
    </body>
</html>