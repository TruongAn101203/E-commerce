<?php 
include_once __DIR__ . '/../shares/header.php';
?>

<div class="container mt-4">
    <h2>Sửa Loại Sản Phẩm</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="/webbanhang/index.php?controller=category&action=edit&id=<?= $category->id ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên Loại Sản Phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category->name) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($category->description) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>
