<html>
<head>
    <meta charset="utf-8">
    <title>Фермер відредагований</title>
</head>

<body>
<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "farmers";

$id = $_POST['id'];
$full_name = $_POST['full_name'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$address = $_POST['address'];

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$statement = $db->prepare("UPDATE $table SET full_name = :full_name, contact_number = :contact_number,email = :email, address = :address WHERE farmer_id = :id");
$statement->bindParam(':full_name', $full_name);
$statement->bindParam(':contact_number', $contact_number);
$statement->bindParam(':email', $email);
$statement->bindParam(':address', $address);
$statement->bindParam(':id', $id);
$statement->execute();

echo "<b>Успішно відредаговано</b><p><a href='farmers.php'>Клієнти</a>";
echo "<meta http-equiv='refresh' content='0; url=farmers.php'>";
?>
</body>
</html>
