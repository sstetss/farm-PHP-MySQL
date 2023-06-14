<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Редагувати Клієнта</title>
</head>
<body>
<?php
print "<h1>Редагувати клієнта</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "clients";


$id = isset($_GET["id"]) ? $_GET["id"] : "";
$full_name = "";
$contact_number = "";
$address = "";

if (!empty($id)) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        $statement = $db->prepare("SELECT * FROM $table WHERE client_id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $full_name = $row['full_name'];
            $contact_number = $row['contact_number'];
            $address = $row['address'];
        }
    } catch (PDOException $e) {
        die("Помилка підключення до бази даних: " . $e->getMessage());
    }
}

print "<form style='margin-left: 80px' method='post' action='edited_client.php'><br>";

print "<p><b>ID</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control' type='text' name='id' value='$id' size='30'><p>";

print "<p><b>ПІБ</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'   type='text' name='full_name' value='$full_name' size='30'><p>";

print "<p><b>Номер телефону</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='contact_number' value='$contact_number' size='30'><p>";

print "<p><b>Адрес</b></p>";
print "<input style='width: 60%; margin-top: 10px' class='form-control'  type='text' name='address' value='$address' size='30'><p>";

print "<input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='OK'><p>";
print "<a class='btn btn-secondary'href='clients.php'>Клієнти</a>";

?>
</body>
</html>
