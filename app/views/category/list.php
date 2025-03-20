<?php 
include_once __DIR__ . '/../shares/header.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/CategoryModel.php';

$db = (new Database())->getConnection();
$categoryModel = new CategoryModel($db);
$categories = $categoryModel->getCategories();
?>

<div class="container mt-4">
    <h2>Danh Sách Loại Sản Phẩm</h2>
    <a href="/webbanhang/index.php?controller=category&action=add" class="btn btn-primary mb-3">Thêm Loại Sản Phẩm</a>

    <?php if (!empty($categories)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= htmlspecialchars($category->id) ?></td>
                        <td><?= htmlspecialchars($category->name) ?></td>
                        <td><?= nl2br(htmlspecialchars($category->description)) ?></td>
                        <td>
                            <a href="/webbanhang/index.php?controller=category&action=edit&id=<?= $category->id ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/webbanhang/index.php?controller=category&action=delete&id=<?= $category->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">Không có loại sản phẩm nào!</div>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>
