<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/ProductModel.php';

$db = (new Database())->getConnection();
$productModel = new ProductModel($db);

if (isset($_GET['id'])) {
    $productModel->deleteProduct($_GET['id']);
    header('Location: /webbanhang/app/views/product/list.php');
} else {
    echo "Không thấy sản phẩm.";
}
?>
