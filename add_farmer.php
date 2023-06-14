<html>
<head>
    <meta charset="utf-8">
    <title>Додати запис фермера</title>
</head>

<body>
<?php
print "<h1>Додати запис фермера</h1>";

$user = "root";
$password = "27112003";
$database = "farm";
$table = "farmers";

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$farmer_id = $_POST['farmer_id'];
$full_name = $_POST['full_name'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$address = $_POST['address'];

$db->query("INSERT INTO $table VALUES ($farmer_id, '$full_name', '$contact_number','$email','$address');");
print "<b>Успішно додано</b><p>";
print "<meta http-equiv='refresh' content='0; url=farmers.php'>";


die();
?>
</body>
