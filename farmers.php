<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Фермери</title>
</head>

<body>
<nav>
    <h1><a style="font-size: 50px" class="li-style" href='index.php'>Farm</a></h1>
    <ul class="ul-header">
        <li><a class="li-style" href='clients.php'>клієнти</a></li>
        <li><a class="li-style" href='orders.php'>замовлення</a></li>
        <li><a class="li-style" href='sales.php'>продажі</a></li>
        <li><a class="li-style" href='products.php'>продукти</a></li>
        <li><a class="li-style" href='farmers.php'>фермери</a></li>
        <li><a class="li-style" href='storages.php'>склад</a></li>
    </ul>
</nav>
<hr/>
<div class="box-box">
    <h1>Фермери</h1>
    <a class="btn btn-secondary" href='index.php'>На Головну</a>
    <p>
        <a  class="btn btn-outline-info" href='add_farmer.html'>Додати Фермера</a>
        <a class="btn btn-outline-info" href='search_farmer.php'>Пошук Фермера</a>

        <?php
        $user = "root";
        $password = "27112003";
        $database = "farm";
        $table = "farmers";

        // Створити з'єднання
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

        print "<table class='table '>";
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

        foreach($db->query("SELECT * FROM $table") as $row) {
            print "<tr>";
            print "<th scope='row'>" . $row['farmer_id'] . "</th>";
            print "<td>" . $row['full_name'] . "</td>";
            print "<td>" . $row['contact_number'] . "</td>";
            print "<td>" . $row['email'] . "</td>";
            print "<td>" . $row['address'] . "</td>";
            print "<td><a style='color: #fff; font-weight: 500; background-color: #B69465; border: none' class='btn btn-info' href='edit_farmer.php?id=" . $row['farmer_id'] . "'>Редагувати</td>";
            print "<td><a style='color: #fff; font-weight: 500' class='btn btn-danger' href='delete_farmer.php?id=" . $row['farmer_id'] . "'>Видалити</td>";
            print "</tr>";
        }

        print "</tbody>";
        print "</table>";
        die();
        ?>
    <div/>
</body>
</html>
