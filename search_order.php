<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <?php
    $number = isset($_GET['number']) ? $_GET['number'] : '';
    if ($number == '') {
        print "<title>Пошук Аспіранта</title>";
    } else {
        print "<title>$number - Пошук</title>";
    }
    ?>
</head>

<body>
<h1>Пошук Замовлень</h1>
<a style="margin-left: 80px" class="btn btn-secondary" href='orders.php'>Назад</a>

<p>

<form style="margin-left: 80px" action='search_order.php?=number'>
    <?php
    if ($number == '') {
        $number = 'Введіть номер телефону';
    }
    ?>
    <b>Пошук</b><br>
    <input style='width: 60%; margin-top: 10px' class='form-control' name='number' placeholder='<?php echo $number; ?>' size="30">
    <input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='Пошук'>
</form>

<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "orders";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($number != 'Введіть номер телефону' && $number != '') {
        $stmt = $db->prepare("SELECT * FROM $table WHERE number = :number");
        $stmt->bindParam(':number', $number);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            print "<table style='margin-left: 80px' class='table '>";
            print "<thead>";
            print "<tr>";
            print "<th scope='col'>ID замовлення</th>";
            print "<th scope='col'>ID клієнта</th>";
            print "<th scope='col'>ID продукта</th>";
            print "<th scope='col'>К-сть</th>";
            print "<th scope='col'>Дата</th>";
            print "<th scope='col'>Редагувати</th>";
            print "<th scope='col'>Видалити</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";

            foreach ($results as $row) {
                print "<tr>";
                print "<th scope='row'>" . $row['order_id'] . "</th>";
                print "<td>" . $row['client_id'] . "</td>";
                print "<td>" . $row['product_id'] . "</td>";
                print "<td>" . $row['number'] . "</td>";
                print "<td>" . $row['date'] . "</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-info' href='#" . $row['order_id'] . "'>Редагувати</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-danger' href='delete_order.php?id=" . $row['order_id'] . "'>Видалити</td>";
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
