<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <?php
    $selectedColumn = isset($_GET['column']) ? $_GET['column'] : '';
    $searchValue = isset($_GET['search']) ? $_GET['search'] : '';

    if ($searchValue == '') {
        print "<title>Пошук Аспіранта</title>";
    } else {
        print "<title>$searchValue - Пошук</title>";
    }
    ?>
</head>

<body>
<h1>Пошук Продуктів</h1>
<a style="margin-left: 80px" class="btn btn-secondary" href='products.php'>Назад</a>

<p>

<form style="margin-left: 80px" action='search_product.php'>
    <?php
    if ($searchValue == '') {
        $searchValue = 'Введіть значення';
    }
    ?>
    <b>Пошук</b><br>
    <input style='width: 60%; margin-top: 10px' class='form-control' name='search' placeholder='<?php echo $searchValue; ?>' size="30">
    <select class="form-select" name="column" style='width: 60%; margin-top: 10px'>
        <option value="product_id" <?php if ($selectedColumn == 'product_id') echo 'selected'; ?>>ID продукту</option>
        <option value="name" <?php if ($selectedColumn == 'name') echo 'selected'; ?>>Назва</option>
        <option value="type" <?php if ($selectedColumn == 'type') echo 'selected'; ?>>Тип</option>
        <option value="price" <?php if ($selectedColumn == 'price') echo 'selected'; ?>>Ціна</option>
    </select>
    <input style='margin-top: 30px' class='btn btn-outline-info' type='submit' value='Пошук'>
</form>

<?php
$user = "root";
$password = "27112003";
$database = "farm";
$table = "products";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($searchValue != 'Введіть значення' && $searchValue != '') {
        $query = "SELECT * FROM $table WHERE $selectedColumn = :searchValue";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':searchValue', $searchValue);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            print "<table style='margin-left: 80px' class='table '>";
            print "<thead>";
            print "<tr>";
            print "<th scope='col'>ID</th>";
            print "<th scope='col'>Назва</th>";
            print "<th scope='col'>Тип</th>";
            print "<th scope='col'>Опис</th>";
            print "<th scope='col'>Ціна</th>";
            print "<th scope='col'>Редагувати</th>";
            print "<th scope='col'>Видалити</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";

            foreach ($results as $row) {
                print "<tr>";
                print "<th scope='row'>" . $row['product_id'] . "</th>";
                print "<td>" . $row['name'] . "</td>";
                print "<td>" . $row['type'] . "</td>";
                print "<td>" . $row['description'] . "</td>";
                print "<td>" . $row['price'] . "</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-info' href='#" . $row['product_id'] . "'>Редагувати</td>";
                print "<td><a style='color: #fff; font-weight: 500' class='btn btn-danger' href='#" . $row['product_id'] . "'>Видалити</td>";
                print "</tr>";
            }

            print "</table>";
        } else {
            print "Записів не знайдено";
        }
    }
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>
</body>
</html>
