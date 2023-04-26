<table>
    <tr>
        <?php foreach ($keys as $key=>$value){
            echo "<th>$key</th>";
        }
        ?>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($items)){
        ?>
        <tr>
            <?php
            foreach ($row as $key => $value){
                echo "<td>$value</td>";
            }
            if($table == 'products'){
                ?>
                <td><img src="./<?=$value?>" alt="<?=$value?>" width="100" height="100"></td>
                <td><a href="update.php?id=<?=mysqli_real_escape_string($connect,$row['id'])?>">Update</a></td>
        <td><a href="vendor/delete.php?id=<?=mysqli_real_escape_string($connect, $row['id'])?>">Delete</a> </td>
        <td><a href="product_stats.php?id=<?=$row['id']?>">Stats by product</a></td>
            <?php
            }
            if ($table == 'users'){?>
                <td><img src="/auth/<?=$value?>" alt="img" width="100" height="100"></td>
            <td><a href="user_orders.php?email=<?=$row['email']?>&id=<?=$row['id']?>">User orders</a></td>
            <td><a href="vendor/delete_user.php?id=<?=mysqli_real_escape_string($connect, $row['id'])?>">Delete</a></td>
            <?php
            }
            if($table == 'orders'){
 ?>
                <td><a href="order_details.php?id=<?=$row['id']?>">Details</a></td>
            <td><a href="vendor/delete_order.php?id=<?=$row['id']?>">Delete</a></td>
            <td><a href="changestatus.php?id=<?=$row['id']?>&action=on_work">Take to work </a></td>
            <td><a href="changestatus.php?id=<?=$row['id']?>&action=finish">Finish</a></td>
            <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>


