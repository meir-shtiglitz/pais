<?php
	include 'db_con.php';
    $query = "SELECT points FROM users WHERE id = ".$_SESSION['id_login'];
    $go_query = mysqli_query($conected, $query);
    $score = mysqli_fetch_assoc($go_query);
    echo $score['points'];
    if ($score['points'] < $_POST['points']){
        $query = "UPDATE users SET points = '".$_POST['points']."' WHERE id = " . $_SESSION['id_login'];
        $go_query = mysqli_query($conected, $query);
    };