<?php
session_start();
require_once ('../vendor/autoload.php');
require_once('../funcs/funcs.php');

if (!isset($_COOKIE['login'])) {
    $_SESSION['message'] = 'Немає прав доступу';
    header("location:javascript:history.go(-1)");
}
if (isset($_COOKIE['login'])) {
    if ($_COOKIE['role'] !== 'admin') {
        $_SESSION['denyaccess'] = 'Недостатньо прав доступу';
        header("location:javascript:history.go(-1)");
    }
}
if ($_COOKIE['token'] !== takeToken($_COOKIE['login'])) {
    $_SESSION['missing_token'] = 'Відмовлено в доступі';
    header('Location: ../index.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<?php require_once('../view/table_style.php') ?>
<header>
    <?php
    if (isset($_COOKIE['login'])) { ?>
        <a href="vendor/logout.php" class="logout"> Log Out </a>
        <?php
    }
    $table = 'products';
    $admin = new \MyApp\db();
    $admin->select("products", 'id, title, price,description, photo', 'status', 'active');
    $items = $admin->sql;
    ?>
    <h3><?= $_COOKIE['name'] ?></h3>
</header>
<body>
<h2><a href="create_product.php">Create new product</a></h2>
<h1><a href="orders.php" class="link-primary">Orders</a></h1>
<h2><a href="users.php">Users</a></h2>

<a href="../index.php">Products page</a>

<?php require_once('../view/td_table.php') ?>
</body>
</html>
