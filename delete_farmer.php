<html>
<head>
    <meta charset="utf-8">
    <title>Видалити</title>
</head>

<body>
<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "farmers";

// Створити з'єднання
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

$id = $_GET["id"];

$db->query("DELETE FROM $table WHERE farmer_id = '$id';");

print "<b>Успішно видалено</b><p>";
print "<meta http-equiv='refresh' content='0; url=farmers.php'>";
die();
?>
</body>
</html>
