<html>
<head>
    <meta charset="utf-8">
    <title>Додати Клієнта</title>
</head>

<body>
<?php
print "<h1>Додати запис клієнта</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "clients";

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$client_id = $_POST['client_id'];
$full_name = $_POST['full_name'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];

$db->query("INSERT INTO $table VALUES ($client_id, '$full_name', '$contact_number','$address');");
print "<b>Успішно додано</b><p>";
print "<meta http-equiv='refresh' content='0; url=clients.php'>";


die();
?>
</body>
