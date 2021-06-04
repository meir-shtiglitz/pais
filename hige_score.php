<?php
 include 'db_con.php';
 $query = "SELECT points FROM users WHERE id = '".$_SESSION['id_login']."'";
    $go_query = mysqli_query($conected, $query);
    $points = mysqli_fetch_assoc($go_query);

    $query = "SELECT * FROM users order by points DESC LIMIT 5";
    $go_query = mysqli_query($conected, $query);
    $hige = mysqli_fetch_assoc($go_query);
    
?>

<table border='1' style="text-align:center; display: none;">
    <thead>
        <tr>
            <th>סכום הזכיה</th>
            <th>שם הזוכה</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($go_query as $key){
            echo "<tr><td>".$key['points']."</td><td>".$key['username']."</td></tr>";
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="direction: rtl;"><span><?php echo $points['points']; ?></span> <span> מיליון </span></td>
            <th>השיא שלך</td>
        </tr>
    </tfoot>
</table>
