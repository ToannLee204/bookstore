<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BookStore</title>
        <link rel="stylesheet" href="./css/taskbar.css">
        <link rel="stylesheet" href="./css/card_sach.css">
        <link rel="stylesheet" href="./css/sort-bar.css">
        <link rel="stylesheet" href="./css/adminoption.css">
        <link rel="stylesheet" href="./css/nutbam.css">
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
                <a href="giohang.php">Giỏ hàng  </a>
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

        <div class="main">
            <section class="banner">
                <h1>Chào mừng đến với cửa hàng sách của chúng tôi!</h1>
                <p>Cung cấp các loại sách đa dạng và phong phú cho mọi lứa tuổi!</p>
            </section>

            <section class="danh_muc_sach">
                <h2>Thể loại sách</h2>
                <div class="list_danh_muc">
                    <?php  
                        require 'connect.php';
                        $sql = "SELECT DISTINCT the_loai from sach";
                        $result = $conn->query($sql);
                        for($i=0;$i<$result->num_rows;$i++){
                            $row = $result->fetch_assoc();
                            echo '<a href="ketQuaTimKiem.php?tu_khoa=' .$row["the_loai"].  '">' .$row["the_loai"]. '</a>';
                        }
                    ?>
                </div>
            </section>
                      
            <section class="sach_noi_bat">
                <h2>Danh mục sản phẩm</h2>
                <form method="GET" action="" class="sort-bar">
                    Giá : 
                    <select id="sort" name="sort">
                        <option value="under_150000" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'under_150000') ? 'selected' : ''; ?>>Dưới 150,000</option>
                        <option value="150000_200000" <?php echo (isset($_GET['sort']) && $_GET['sort'] == '150000_200000') ? 'selected' : ''; ?>>150,000 - 200,000</option>
                        <option value="200000_250000" <?php echo (isset($_GET['sort']) && $_GET['sort'] == '200000_250000') ? 'selected' : ''; ?>>200,000 - 250,000</option>
                        <option value="above_250000" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'above_250000') ? 'selected' : ''; ?>>Trên 250,000</option>
                    </select>
                    <input type="submit" value="Lọc">
                </form>
                <div class="book-list">
                    <?php 
                        $filter = ''; 
                        if (isset($_GET['sort'])) {
                            switch ($_GET['sort']) {
                                case 'under_150000':
                                    $filter = 'WHERE gia < 150000';
                                    break;
                                case '150000_200000':
                                    $filter = 'WHERE gia BETWEEN 150000 AND 200000';
                                    break;
                                case '200000_250000':
                                    $filter = 'WHERE gia BETWEEN 200000 AND 250000';
                                    break;
                                case 'above_250000':
                                    $filter = 'WHERE gia > 250000';
                                    break;
                            }
                        }

                        $sql1 = "SELECT * FROM sach $filter";
                        $result1 = $conn->query($sql1);
                        for($i=0; $i<$result1->num_rows; $i++){
                            $row = $result1->fetch_assoc();
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
                    ?>
                </div>
            </section>

        </div>

    </body>
</html>