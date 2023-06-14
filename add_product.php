<html>
<head>
    <meta charset="utf-8">
    <title>Додати продукт</title>
</head>

<body>
<?php
print "<h1>Додати продукт</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "products";

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$type = $_POST['type'];
$description = $_POST['description'];
$price = $_POST['price'];

$db->query("INSERT INTO $table VALUES ($product_id, '$name', '$type','$description','$price');");
print "<b>Успішно додано</b><p>";
print "<meta http-equiv='refresh' content='0; url=products.php'>";


die();
?>
</body>
