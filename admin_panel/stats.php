<?php
require_once ('../connect.php');
////$columns = implode(",", $columns);
//mysqli_query($connect, "SELECT '$columns'  FROM orders")
$sql = "SELECT * FROM orders";


if (!empty($_POST['search_by'])) {
    $search = $_POST['search_by'];
    $column = $_POST['column'];
}
if (!empty($_POST['start']) or !empty($_POST['to'])){
$from_date = $_POST['start'];
$to_date = $_POST['to'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stats</title>
    <style>
        html {
            font-family: Tahoma, Geneva, sans-serif;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 500px;
        }
        th {
            background-color: #54585d;
            border: 1px solid #54585d;
        }
        th:hover {
            background-color: #64686e;
        }
        th a {
            display: block;
            text-decoration:none;
            padding: 10px;
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
        }
        th a i {
            margin-left: 5px;
            color: rgba(255,255,255,0.4);
        }
        td {
            padding: 10px;
            color: #636363;
            border: 1px solid #dddfe1;
        }
        tr {
            background-color: #ffffff;
        }
        tr .highlight {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
<h3>
    <p>Filter by</p>
</h3>
<form action="stats.php" method="post" id="filter_by">
    <input type="search" name="search_by"><br><br>
    <label>Date from</label>
    <input type="date" name="start" min="2023-01-01">
    <label>To:</label>
    <input type="date" name="to" min="2023-01-02">
    <br>
    <input type="submit">
</form>
<br>

<label for="columns">Choose a value for search: </label>
<select name="column" id="column" form="filter_by">
    <option value=""></option>
    <option value="id">ID</option>
    <option value="full_name">Name</option>
    <option value="number">Number</option>
    <option value="order_status">Orders Status</option>
    <option value="email">Email</option>
</select>
<br><br>
<?php
print_r($_POST);
?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number</th>
        <th>City</th>
        <th>Address</th>
        <th>Orders Date</th>
        <th>Order Status</th>
        <th>Email</th>
    </tr>
    <?php

    function findQuery(){
        if(!empty($_POST['search_by'] && !empty($_POST['column']))){
            $sql = "SELECT * FROM orders where $column like '%$search%'";
        }
        if (!empty($_POST['start']) && !empty($_POST['to'])){
            $sql = "SELECT * FROM orders where order_date between '$from_date' and '$to_date'";
        }elseif (!empty($_POST['start']) && empty($_POST['to'])){
            $sql = "SELECT * FROM orders where order_date > '$from_date'";
        }elseif (empty($_POST['start']) && !empty($_POST['to'])){
            $sql = "SELECT * FROM orders where order_date < '$to_date'";

        }
        return $sql;
    }


        $sql = mysqli_query($connect, $sql);
        $result = mysqli_fetch_all($sql);
    if (mysqli_num_rows($sql)== 0){
        $not_find = 'Елементів з Ввашим запитом не знайдено, ввиедено всі замовлення';
    }
        foreach ($result as $value){
    ?>
    <tr>
        <td><?=$value[0]?></td>
        <td><?=$value[1]?></td>
        <td><?=$value[2]?></td>
        <td><?=$value[3]?></td>
        <td><?=$value[4]?></td>
        <td><?=$value[5]?></td>
        <td><?=$value[6]?></td>
        <td><?=$value[7]?></td>
    </tr>
    <?php
    }
    if (isset($not_find)){
        echo "<h3 style='color: red'>$not_find</h3>";
    }
    ?>
</table>

</body>
</html>
