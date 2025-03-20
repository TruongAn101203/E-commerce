<?php 
include_once __DIR__ . '/../shares/header.php';
?>

<div class="container mt-4">

    <h2 class="text-center mb-4">📱 Danh Sách Sản Phẩm</h2>

    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="/webbanhang/index.php?controller=product&action=show&id=<?= $product->id ?>">
                            <img src="<?= htmlspecialchars($product->image) ?>" class="card-img-top p-3" alt="<?= htmlspecialchars($product->name) ?>" style="height: 200px; object-fit: contain;">
                        </a>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary"><?= htmlspecialchars($product->category_name) ?></span>
                            </div>
                            <h5 class="card-title"><?= htmlspecialchars($product->name) ?></h5>
                            <p class="card-text text-truncate"><?= htmlspecialchars($product->description) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold"><?= number_format($product->price, 0, ',', '.') ?> đ</span>
                            
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">«</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">»</a>
                </li>
            </ul>
        </nav> -->
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-triangle"></i> Không có sản phẩm nào!
        </div>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../shares/footer.php'; ?> 