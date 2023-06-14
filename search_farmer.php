<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <?php
    $contact_number = isset($_GET['contact_number']) ? $_GET['contact_number'] : '';
    if ($contact_number == '') {
        print "<title>Пошук Аспіранта</title>";
    } else {
        print "<title>$contact_number - Пошук</title>";
    }
    ?>
</head>

<body>
<h1>Пошук Фермерів</h1>
<a style="margin-left: 80px" class="btn btn-secondary" href='farmers.php'>Назад</a>

<p>

<form style="margin-left: 80px" action='search_farmer.php?=contact_number'>
    <?php
    if ($contact_number == '') {
        $contact_number = 'Введіть номер телефону';
    }
    ?>
    <b>Пошук</b><br>
    <input style='width: 60%; margin-top: 10px' class='form-control' name='contact_number' placeholder='<?php echo $contact_number; ?>' size="30">
    <input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='Пошук'>
</form>

<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "farmers";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($contact_number != 'Введіть номер телефону' && $contact_number != '') {
        $stmt = $db->prepare("SELECT * FROM $table WHERE contact_number = :contact_number");
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
            print "<th scope='col'>E-mail</th>";
            print "<th scope='col'>Адрес</th>";
            print "<th scope='col'>Редагувати</th>";
            print "<th scope='col'>Видалити</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";

            foreach ($results as $row) {
                print "<tr>";
                print "<th scope='row'>" . $row['farmer_id'] . "</th>";
                print "<td>" . $row['full_name'] . "</td>";
                print "<td>" . $row['contact_number'] . "</td>";
                print "<td>" . $row['email'] . "</td>";
                print "<td>" . $row['address'] . "</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-info' href='#" . $row['farmer_id'] . "'>Редагувати</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-danger' href='#" . $row['farmer_id'] . "'>Видалити</td>";
                print "</tr>";
            }

            print "</table>";
        } else {
            print "Номер телефон не знайдено";
        }
    }
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>
</body>
</html>
