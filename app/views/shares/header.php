<?php
// Đặt biến này ở tệp config của bạn
$BASE_URL = "/webbanhang/app";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    
    <!-- Bootstrap 5 CSS và Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #5a5c69;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #224abe);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
        }
        
        .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }
        
        .navbar-nav .nav-item {
            margin: 0 0.25rem;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.6rem 1rem;
            border-radius: 0.35rem;
            transition: all 0.2s;
        }
        
        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link.active {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .navbar-nav .nav-link i {
            margin-right: 0.4rem;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            color: var(--dark-color);
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }
        
        .dropdown-item i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }
        
        .navbar-toggler {
            border: none;
            color: white;
            padding: 0.5rem;
        }
        
        @media (max-width: 992px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .navbar-nav .nav-item {
                margin: 0.2rem 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/webbanhang/">
                <i class="fas fa-store"></i> Quản lý sản phẩm
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $BASE_URL; ?>/views/product/list.php">
                        <i class="fas fa-list"></i>Danh sách sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $BASE_URL; ?>/views/category/list.php">
                        <i class="fas fa-list"></i>Danh sách loại sản phẩm
                    </a>
                </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="views/product/add.php">
                            <i class="fas fa-plus"></i>Thêm sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/product/edit.php">
                            <i class="fas fa-edit"></i>Sửa sản phẩm
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tags"></i>Danh mục
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="/controllers/categorycontroller.php">
                                    <i class="fas fa-folder"></i>Quản lý danh mục
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="/views/category/add.php">
                                    <i class="fas fa-plus-circle"></i>Thêm danh mục mới
                                </a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Nội dung trang -->
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>