<?php 
include_once __DIR__ . '/../shares/header.php'; 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/ProductModel.php';
require_once __DIR__ . '/../../models/CategoryModel.php';

$db = (new Database())->getConnection();
$productModel = new ProductModel($db);
$categoryModel = new CategoryModel($db);

$product = $productModel->getProductById($_GET['id']);
$categories = $categoryModel->getCategories();
?>

<div class="container mt-4">
    <h2 class="mb-4">🛠 Chỉnh Sửa Sản Phẩm</h2>

    <?php if (!isset($product)): ?>
        <div class="alert alert-danger">Sản phẩm không tồn tại!</div>
    <?php else: ?>
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

        <form action="/webbanhang/index.php?controller=product&action=update" method="POST" class="shadow p-4 rounded bg-light">
            <input type="hidden" name="id" value="<?= htmlspecialchars($product->id) ?>">

            <div class="mb-3">
                <label class="form-label fw-bold">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product->name) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($product->description) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Giá</label>
                <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($product->price) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Danh mục</label>
                <select name="category_id" class="form-select">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id ?>" <?= ($category->id == $product->category_id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Trường nhập URL hình ảnh -->
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh sản phẩm (URL)</label>
                <input type="text" name="image" class="form-control" value="<?= htmlspecialchars($product->image) ?>" placeholder="Nhập URL hình ảnh">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($product->image) ?>">
                <div class="mt-2">
                    <img src="<?= !empty($product->image) ? htmlspecialchars($product->image) : '/images/no-image.png' ?>" 
                         alt="Ảnh sản phẩm" class="img-thumbnail" width="200">
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Cập nhật</button>
            <a href="/webbanhang/index.php?controller=product&action=index" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
        </form>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>
