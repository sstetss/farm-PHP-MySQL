<html>
<head>
    <meta charset="utf-8">
    <title>Продукт відредагований</title>
</head>

<body>
<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "products";

$id = $_POST['id'];
$name = $_POST['name'];
$type = $_POST['type'];
$description = $_POST['description'];
$price = $_POST['price'];

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$statement = $db->prepare("UPDATE $table SET name = :name, type = :type, description = :description ,price = :price  WHERE product_id = :id");
$statement->bindParam(':name', $name);
$statement->bindParam(':type', $type);
$statement->bindParam(':description', $description);
$statement->bindParam(':price', $price);
$statement->bindParam(':id', $id);
$statement->execute();

echo "<b>Успішно відредаговано</b><p><a href='products.php'>Продукти</a>";
echo "<meta http-equiv='refresh' content='0; url=products.php'>";
?>
</body>
</html>
