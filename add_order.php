<html>
<head>
    <meta charset="utf-8">
    <title>Додати запис замовлення</title>
</head>

<body>
<?php
print "<h1>Додати запис замовлення</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "orders";

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$order_id = $_POST['order_id'];
$client_id = $_POST['client_id'];
$product_id = $_POST['product_id'];
$number = $_POST['number'];
$date = $_POST['date'];

$db->query("INSERT INTO $table VALUES ($order_id, '$client_id', '$product_id','$number','$date');");
print "<b>Успішно додано</b><p>";
print "<meta http-equiv='refresh' content='0; url=orders.php'>";


die();
?>
</body>
