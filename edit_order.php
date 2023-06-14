<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Редагувати Замовлення</title>
</head>
<body>
<?php
print "<h1>Редагувати Замовлення</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "orders";


$id = isset($_GET["id"]) ? $_GET["id"] : "";
$client_id = "";
$product_id = "";
$number = "";
$date = "";

if (!empty($id)) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        $statement = $db->prepare("SELECT * FROM $table WHERE order_id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $client_id = $row['client_id'];
            $product_id = $row['product_id'];
            $number = $row['number'];
            $date = $row['date'];
        }
    } catch (PDOException $e) {
        die("Помилка підключення до бази даних: " . $e->getMessage());
    }
}

print "<form style='margin-left: 80px' method='post' action='edited_order.php'><br>";

print "<p><b>ID Замовлення</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control' type='text' name='id' value='$id' size='30'><p>";

print "<p><b>ID Клієнта</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'   type='text' name='client_id' value='$client_id' size='30'><p>";

print "<p><b>ID Продукту</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='product_id' value='$product_id' size='30'><p>";

print "<p><b>К-сть</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='number' value='$number' size='30'><p>";

print "<p><b>Дата</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='date' value='$date' size='30'><p>";

print "<input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='OK'><p>";
print "<a class='btn btn-secondary'href='orders.php'>Замовлення</a>";

?>
</body>
</html>
