<html>
<head>
    <meta charset="utf-8">
    <title>Замовлення відредаговане</title>
</head>

<body>
<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "orders";

$id = $_POST['id'];
$client_id = $_POST['client_id'];
$product_id = $_POST['product_id'];
$number = $_POST['number'];
$date = $_POST['date'];

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$statement = $db->prepare("UPDATE $table SET client_id = :client_id, product_id = :product_id, number = :number, date = :date WHERE order_id = :id");
$statement->bindParam(':client_id', $client_id);
$statement->bindParam(':product_id', $product_id);
$statement->bindParam(':number', $number);
$statement->bindParam(':date', $date);
$statement->bindParam(':id', $id);

if ($statement->execute()) {
    echo "<b>Успішно відредаговано</b><p><a href='orders.php'>Замовлення</a>";
    echo "<meta http-equiv='refresh' content='0; url=orders.php'>";
} else {
    echo "Помилка при редагуванні замовлення";
}
?>
</body>
</html>
