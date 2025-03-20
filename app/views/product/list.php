<?php 
include_once __DIR__ . '/../shares/header.php'; 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/ProductModel.php';

$db = (new Database())->getConnection();
$productModel = new ProductModel($db);
$products = $productModel->getProducts();
?>

<div class="container mt-4">
    <h2>Danh Sách Sản Phẩm</h2>
    <a href="/webbanhang/app/views/product/add.php" class="btn btn-primary mb-3">Thêm Sản Phẩm</a>

    <?php if (!empty($products)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product->id) ?></td>
                        <td><?= htmlspecialchars($product->name) ?></td>
                        <td><?= nl2br(htmlspecialchars($product->description)) ?></td>
                        <td><?= number_format($product->price, 0, ',', '.') ?> đ</td>
                        <td><?= htmlspecialchars($product->category_name) ?></td>
                        <td>
                            <a href="/webbanhang/app/views/product/show.php?id=<?= $product->id ?>" class="btn btn-info btn-sm">Xem</a>
                            <a href="/webbanhang/app/views/product/edit.php?id=<?= $product->id ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/webbanhang/app/views/product/delete.php?id=<?= $product->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">Không có sản phẩm nào!</div>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>
