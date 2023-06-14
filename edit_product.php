<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Редагувати продукт</title>
</head>
<body>
<?php
print "<h1>Редагувати продукт</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "products";


$id = isset($_GET["id"]) ? $_GET["id"] : "";
$name = "";
$type = "";
$description = "";
$price = "";

if (!empty($id)) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        $statement = $db->prepare("SELECT * FROM $table WHERE product_id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['name'];
            $type = $row['type'];
            $description = $row['description'];
            $price = $row['price'];
        }
    } catch (PDOException $e) {
        die("Помилка підключення до бази даних: " . $e->getMessage());
    }
}

print "<form style='margin-left: 80px' method='post' action='edited_product.php'><br>";

print "<p><b>ID</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control' type='text' name='id' value='$id' size='30'><p>";

print "<p><b>Назва</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'   type='text' name='name' value='$name' size='30'><p>";

print "<p><b>Тип</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='type' value='$type' size='30'><p>";

print "<p><b>Опис</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='description' value='$description' size='30'><p>";

print "<p><b>Ціна</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='price' value='$price' size='30'><p>";

print "<input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='OK'><p>";
print "<a class='btn btn-secondary'href='products.php'>Продукти</a>";

?>
</body>
</html>
