<?php
require_once('connect.php');

mysqli_query($connect, "SELECT * FROM orders");
if(isset($_GET['filter_list'])){
    $column = $_GET['filter_list'];
    $sort_order = 'asc';
}else {
    $columns = array('id', 'full_name', 'number', 'city', 'address', 'order_date', 'order_status', 'email');
    $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
}
if ($result = mysqli_query($connect, 'SELECT * FROM orders ORDER BY ' .  $column . ' ' . $sort_order)) {
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
<form action="test.php" id="filter_by" method="get">
    <input type="submit" name="submit_filter">
</form>
<br>

<label for="drop_filter">Choose a filter:</label>
<select id="drop_filter" name="filter_list" form="filter_by">
    <option value="id">id</option>
    <option value="full_name">Name</option>
    <option value="number">Number</option>
    <option value="city">City</option>
    <option value="address">Address</option>
    <option value="order_date">Order Date</option>
    <option value="order_status">Order Status</option>
    <option value="email">Email</option>
</select>

<br><br>
<table>
<tr>
    <th><a href="test.php?column=id&order=<?php echo $asc_or_desc; ?>">Id<i class="fas fa-sort<?php echo $column == 'id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=full_name&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=number&order=<?php echo $asc_or_desc; ?>">Number<i class="fas fa-sort<?php echo $column == 'number' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=city&order=<?php echo $asc_or_desc; ?>">CIty<i class="fas fa-sort<?php echo $column == 'city' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=address&order=<?php echo $asc_or_desc; ?>">Address<i class="fas fa-sort<?php echo $column == 'address' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=order_date&order=<?php echo $asc_or_desc; ?>">Order Date<i class="fas fa-sort<?php echo $column == 'order_date' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=order_status&order=<?php echo $asc_or_desc; ?>">Order Status<i class="fas fa-sort<?php echo $column == 'order_status' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="test.php?column=email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'email' ? '-' . $up_or_down : ''; ?>"></i></a></th>


</tr>
<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td<?php echo $column == 'id' ? $add_class : ''; ?>><?php echo $row['id']; ?></td>
        <td<?php echo $column == 'full_name' ? $add_class : ''; ?>><?php echo $row['full_name']; ?></td>
        <td<?php echo $column == 'number' ? $add_class : ''; ?>><?php echo $row['number']; ?></td>
        <td<?php echo $column == 'city' ? $add_class : ''; ?>><?php echo $row['city']; ?></td>
        <td<?php echo $column == 'address' ? $add_class : ''; ?>><?php echo $row['address']; ?></td>
        <td<?php echo $column == 'order_date' ? $add_class : ''; ?>><?php echo $row['order_date']; ?></td>
        <td<?php echo $column == 'order_status' ? $add_class : ''; ?>><?php echo $row['order_status']; ?></td>
        <td<?php echo $column == 'email' ? $add_class : ''; ?>><?php echo $row['email']; ?></td>
    </tr>
<?php endwhile; ?>
</table>
</body>
</html>
    <?php
    $result->free();
}
?>