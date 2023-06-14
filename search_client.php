<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <?php
    $contact_number = isset($_GET['contact_number']) ? $_GET['contact_number'] : '';
    $column = isset($_GET['column']) ? $_GET['column'] : '';

    if ($contact_number == '') {
        print "<title>Пошук Аспіранта</title>";
    } else {
        print "<title>$contact_number - Пошук</title>";
    }
    ?>
</head>

<body>
<h1>Пошук Клієнтів</h1>
<a style="margin-left: 80px" class="btn btn-secondary" href='clients.php'>Назад</a>

<p>

<form style="margin-left: 80px" action='search_client.php'>
    <b>Пошук</b><br>
    <input style='width: 60%; margin-top: 10px' class='form-control' name='contact_number' placeholder='<?php echo $contact_number; ?>' size="30">
    <select style='width: 60%;margin-top: 10px' class='form-select' name='column'>
        <option value='client_id' <?php if ($column == 'client_id') echo 'selected'; ?>>ID</option>
        <option value='full_name' <?php if ($column == 'full_name') echo 'selected'; ?>>ПІБ</option>
        <option value='contact_number' <?php if ($column == 'contact_number') echo 'selected'; ?>>Контактний телефон</option>
        <option value='address' <?php if ($column == 'address') echo 'selected'; ?>>Адреса</option>
    </select>
    <input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='Пошук'>
</form>

<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "clients";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($contact_number != '' && $column != '') {
        $stmt = $db->prepare("SELECT * FROM $table WHERE $column = :contact_number");
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            print "<table style='margin-left: 80px' class='table '>";
            print "<thead>";
            print "<tr>";
            print "<th scope='col'>ID</th>";
            print "<th scope='col'>ПІБ</th>";
            print "<th scope='col'>Контактний телефон</th>";
            print "<th scope='col'>Адреса</th>";
            print "<th scope='col'>Редагувати</th>";
            print "<th scope='col'>Видалити</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";

            foreach ($results as $row) {
                print "<tr>";
                print "<th scope='row'>" . $row['client_id'] . "</th>";
                print "<td>" . $row['full_name'] . "</td>";
                print "<td>" . $row['contact_number'] . "</td>";
                print "<td>" . $row['address'] . "</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-info' href='#" . $row['client_id'] . "'>Редагувати</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-danger' href='#" . $row['client_id'] . "'>Видалити</td>";
                print "</tr>";
            }

            print "</table>";
        } else {
            print "Вказаний параметр не правильний";
        }
    }
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>
</body>
</html>
