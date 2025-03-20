<?php 
include_once __DIR__ . '/../shares/header.php'; 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/ProductModel.php';

$db = (new Database())->getConnection();
$productModel = new ProductModel($db);
$product = $productModel->getProductById($_GET['id']);
?>

<div class="container mt-4">
    <h2>Chi Tiết Sản Phẩm</h2>

    <?php if (isset($product) && $product): ?>
        <div class="card">
            <div class="card-body text-center">
                <!-- Hiển thị hình ảnh sản phẩm -->
                <img src="<?= !empty($product->image) ? htmlspecialchars($product->image) : '/path/to/default-image.jpg' ?>" 
                     class="img-fluid rounded" 
                     style="max-width: 400px; height: auto;" 
                     alt="<?= htmlspecialchars($product->name) ?>">

                <h4 class="card-title mt-3"><?= htmlspecialchars($product->name) ?></h4>
                <p class="card-text"><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($product->description)) ?></p>
                <p class="card-text"><strong>Giá:</strong> <?= number_format($product->price, 0, ',', '.') ?> đ</p>
                <p class="card-text"><strong>Danh mục:</strong> <?= htmlspecialchars($product->category_name) ?></p>

                <a href="/webbanhang/app/views/product/edit.php?id=<?= $product->id ?>" class="btn btn-warning">Sửa</a>
                <a href="/webbanhang/app/views/product/delete.php?id=<?= $product->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Không tìm thấy sản phẩm!</div>
    <?php endif; ?>
</div>


<?php include_once __DIR__ . '/../shares/footer.php'; ?>
