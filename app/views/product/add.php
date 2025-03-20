<?php 
include_once __DIR__ . '/../shares/header.php'; 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/CategoryModel.php';

$db = (new Database())->getConnection();
$categoryModel = new CategoryModel($db);
$categories = $categoryModel->getCategories();
?>

<div class="container mt-4">
    <h2>Thêm Sản Phẩm</h2>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>


    <form action="/webbanhang/index.php?controller=product&action=save" method="POST">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm (URL)</label>
            <input type="text" name="image" class="form-control" placeholder="Nhập URL ảnh sản phẩm (ví dụ: https://example.com/image.jpg)" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>
