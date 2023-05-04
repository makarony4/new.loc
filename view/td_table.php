<?php

$result = [];
while($row = mysqli_fetch_assoc($items)){
    $result[]= $row;
}

?>
<table>
    <tr>
        <?php
        foreach ($result[0] as $key => $value) {
            echo "<th>$key</th>";
        }
        ?>
    </tr>
    <?php
        foreach ($result as $times){
        ?>
        <tr>
            <?php
            foreach ($times as $key => $value) {
                echo "<td>$value</td>";
            }
            if ($table == 'products') {
                ?>
                <td><img src="./<?= $value ?>" alt="<?= $value ?>" width="100" height="100"></td>
                <td><a href="update.php?id=<?= mysqli_real_escape_string($connect, $row['id']) ?>">Update</a></td>
                <form action="vendor/delete.php" method="post">
                    <td><input type="submit" value="Delete"></td>
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                </form>
                <td><a href="product_stats.php?id=<?= $row['id'] ?>">Stats by product</a></td>
                <?php
            }
            if ($table == 'users') {
                ?>
                <td><img src="/auth/<?= $value ?>" alt="img" width="100" height="100"></td>
                <td><a href="user_orders.php?email=<?= $row['email'] ?>&id=<?= $row['id'] ?>">User orders</a></td>
                <td>
                    <a href="vendor/delete_user.php?id=<?= mysqli_real_escape_string($connect, $row['id']) ?>">Delete</a>
                </td>
                <?php
            }
            if ($table == 'orders') {
                ?>
                <td><a href="order_details.php?id=<?= $row['id'] ?>">Details</a></td>
                <td><a href="vendor/delete_order.php?id=<?= $row['id'] ?>">Delete</a></td>
                <td><a href="changestatus.php?id=<?= $row['id'] ?>&action=on_work">Take to work </a></td>
                <td><a href="changestatus.php?id=<?= $row['id'] ?>&action=finish">Finish</a></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>


