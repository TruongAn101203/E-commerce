<?php
class ProductModel
{
    private $conn;
    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts()
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductById($id)
    {
        $query = "SELECT p.*, c.name as category_name FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id 
                  WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addProduct($name, $description, $price, $category_id, $image)
    {
        try {
            $errors = [];

            if (empty($name)) {
                $errors['name'] = 'Tên sản phẩm không được để trống';
            }
            if (!is_numeric($price) || $price < 0) {
                $errors['price'] = 'Giá sản phẩm không hợp lệ';
            }

            if (count($errors) > 0) {
                return $errors;
            }

            $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) 
                      VALUES (:name, :description, :price, :category_id, :image)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':image', $image);

            $result = $stmt->execute();
            
            if (!$result) {
                $errorInfo = $stmt->errorInfo();
                $_SESSION['error'] = "Lỗi SQL: " . $errorInfo[2];
                return false;
            }
            
            return $result;

        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi database: " . $e->getMessage();
            return false;
        }
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $image)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET name=:name, description=:description, price=:price, category_id=:category_id, image=:image 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
