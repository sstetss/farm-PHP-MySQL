<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Замовлення</title>
    <script>
        function sortTable(column) {
            window.location.href = 'merged_order.php?sort=' + column;
        }
    </script>
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
<div class="box-box">
    <h1>Об'єднані таблиці</h1>
    <a class="btn btn-secondary" href='index.php'>На Головну</a>


    <?php
    $user = "root";
    $password = "27112003";
    $database = "farm";
    $table = "orders";

    // Створити з'єднання
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

    // Отримати стовпець для сортування (якщо вказано)
    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : '';

    // Формування SQL-запиту з об'єднанням і сортуванням
    $query = "SELECT orders.order_id, clients.full_name, clients.contact_number, clients.address, products.name, products.type, products.description, products.price, orders.number, orders.date 
              FROM orders 
              JOIN clients ON orders.client_id = clients.client_id 
              JOIN products ON orders.product_id = products.product_id";
    if (!empty($sortColumn)) {
        $query .= " ORDER BY $sortColumn";
    }

    print "<table style='width: 95%' class='table '>";
    print "<thead>";
    print "<tr>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"clients.client_id\")'>ID</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"clients.full_name\")'>Повне ім'я клієнта</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"clients.contact_number\")'>Контактний номер</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"clients.address\")'>Адреса</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"products.name\")'>Назва продукту</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"products.type\")'>Тип продукту</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"products.description\")'>Опис</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"products.price\")'>Ціна</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"orders.number\")'>Кількість</a></th>";
    print "<th scope='col'><a href='#' style='text-decoration: underline; font-size: 18px' onclick='sortTable(\"orders.date\")'>Дата</a></th>";

    print "</tr>";
    print "</thead>";
    print "<tbody>";

    foreach($db->query($query) as $row) {
        print "<tr>";
        print "<th scope='row'>" . $row['order_id'] . "</th>";
        print "<td>" . $row['full_name'] . "</td>";
        print "<td>" . $row['contact_number'] . "</td>";
        print "<td>" . $row['address'] . "</td>";
        print "<td>" . $row['name'] . "</td>";
        print "<td>" . $row['type'] . "</td>";
        print "<td>" . $row['description'] . "</td>";
        print "<td>" . $row['price'] . "</td>";
        print "<td>" . $row['number'] . "</td>";
        print "<td>" . $row['date'] . "</td>";

        print "</tr>";
    }

    print "</tbody>";
    print "</table>";
    ?>

</div>
</body>
</html>
