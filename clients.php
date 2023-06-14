<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Клієнти</title>
</head>

<body>
<nav>
    <h1><a style="font-size: 50px" class="li-style" href='index.php'>Farm</a></h1>
    <ul class="ul-header">
        <li><a class="li-style" href='clients.php?sort=client_id'>клієнти</a></li>
        <li><a class="li-style" href='orders.php?sort=order_id'>замовлення</a></li>
        <li><a class="li-style" href='sales.php?sort=sale_id'>продажі</a></li>
        <li><a class="li-style" href='products.php?sort=product_id'>продукти</a></li>
        <li><a class="li-style" href='farmers.php?sort=farmer_id'>фермери</a></li>
        <li><a class="li-style" href='storages.php?sort=product_id'>склад</a></li>
    </ul>
</nav>
<hr/>
<div class="box-box">
    <h1>Клієнти</h1>
    <a class="btn btn-secondary" href='index.php'>На Головну</a>
    <p>
        <a  class="btn btn-outline-info" href='add_client.html'>Додати клієнта</a>
        <a class="btn btn-outline-info" href='search_client.php'>Пошук клієнта</a>

        <?php
        $user = "root";
        $password = "27112003";
        $database = "farm";
        $table = "clients";

        // Створити з'єднання
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

        // Отримати параметр сортування з URL
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'client_id';

        // Перевірити валідність параметра сортування
        $validColumns = ['client_id', 'full_name', 'contact_number', 'address'];
        if (!in_array($sort, $validColumns)) {
            $sort = 'client_id'; // За замовчуванням сортувати за client_id
        }

        // Скласти SQL-запит з параметром сортування
        $query = "SELECT * FROM $table ORDER BY $sort";

        print "<table class='table '>";
        print "<thead>";
        print "<tr>";
        print "<th scope='col'><a class='btn btn-link' style='color: #453E2E' href='clients.php?sort=client_id'>ID</a></th>";
        print "<th scope='col'><a class='btn btn-link' style='color: #453E2E' href='clients.php?sort=full_name'>ПІБ</a></th>";
        print "<th scope='col'><a class='btn btn-link' style='color: #453E2E' href='clients.php?sort=contact_number'>Контактний телефон</a></th>";
        print "<th scope='col'><a class='btn btn-link' style='color: #453E2E' href='clients.php?sort=address'>Адрес</a></th>";
        print "<th scope='col'>Редагувати</th>";
        print "<th scope='col'>Видалити</th>";
        print "</tr>";
        print "</thead>";
        print "<tbody>";

        foreach ($db->query($query) as $row) {
            print "<tr>";
            print "<th scope='row'>" . $row['client_id'] . "</th>";
            print "<td>" . $row['full_name'] . "</td>";
            print "<td>" . $row['contact_number'] . "</td>";
            print "<td>" . $row['address'] . "</td>";
            print "<td><a style='color: #fff; font-weight: 500; background-color: #B69465; border: none' class='btn btn-info' href='edit_client.php?id=" . $row['client_id'] . "'>Редагувати</td>";
            print "<td><a style='color: #fff; font-weight: 500' class='btn btn-danger' href='delete_client.php?id=" . $row['client_id'] . "'>Видалити</td>";
            print "</tr>";
        }

        print "</tbody>";
        print "</table>";

        die();
        ?>
    <div/>
</body>
</html>
