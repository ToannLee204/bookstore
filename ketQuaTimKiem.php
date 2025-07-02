<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kết quả tìm kiếm</title>
        <link rel="stylesheet" href="./css/taskbar.css">
        <link rel="stylesheet" href="./css/card_sach.css">
        <link rel="stylesheet" href="./css/adminoption.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="home.php">BOOKSTORE</a>   
            </div>
            <div>
                <form action="ketQuaTimKiem.php" method="get">
                    <input type="text" name="tu_khoa" placeholder="Tìm kiếm sách,thể loại hoặc tên tác giả ...">
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
        <section class="sach_noi_bat">
            <h2>Kết quả tìm kiếm</h2>
            <div class="book-list">
                <?php 
                    require 'connect.php';
                    if(isset($_GET['tu_khoa'])){
                        $tu_khoa = $_GET['tu_khoa'];
                        $sql = "SELECT * 
                                FROM sach 
                                WHERE ten_sach COLLATE utf8mb4_unicode_ci LIKE '%$tu_khoa%' OR tac_gia COLLATE utf8mb4_unicode_ci LIKE '%$tu_khoa%' OR the_loai COLLATE utf8mb4_unicode_ci LIKE '%$tu_khoa%'";
                        $result = $conn->query($sql);

                        if($result->num_rows>0){
                            for($i=0; $i<$result->num_rows; $i++){
                                $row = $result->fetch_assoc();
                                echo "<div class='list-book-item'>";
                                echo '<img src="' .$row['anh_bia'] . '" width="450px" height="790px"><br>';
                                echo "<div class='book-title'>" . $row['ten_sach'] . "</div>";
                                echo "<div class='book-author'>Tác giả : " .$row['tac_gia']. "</div>";
                                echo "<div class='book-price'>" .$row['gia']. "vnđ </div>";
                                
                                if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
                                    echo "<div class='admin_option'>";
                                    echo "<form method='POST' action='suasach.php'>
                                                <input type='hidden' name='ma_sach' value='" . $row['ma_sach'] . "'>
                                                <button type='submit' name='sua_sach'>Chỉnh sửa thông tin</button>
                                            </form>";
                                    echo "<form method='POST' action='xoasach.php'>
                                            <input type='hidden' name='ma_sach' value='" . $row['ma_sach'] . "'>
                                            <button type='submit' name='sua_sach' style='background-color:red;'>Xóa sách</button>
                                        </form>";
                                    echo "</div>";
                                }
                                else{
                                    if($row['so_luong_ton']>0){
                                        echo "<form method='POST' action='themvaogiohang.php'>
                                                <input type='hidden' name='ma_sach' value='" . $row['ma_sach'] . "'>
                                                <button type='submit' name='them_vao_gio'>Thêm vào giỏ hàng</button>
                                            </form>";
                                    }
                                    else{
                                        echo"<button disabled style='background-color:red;'>Hết hàng</button>";
                                    }
                                }
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h2>Không có kết quả tìm kiếm như bạn cần tìm!</h2>";
                        }
                    }
                ?>
            </div>

        </section>
    </body>
</html>