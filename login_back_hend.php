<?php
	include 'db_con.php';

// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';
// use PHPMailer\PHPMailer\PHPMailer;
/*//בדיקה אם חיבור תקין
if($conected){
    echo 'חיבור תקין';
} else{
    echo 'חיבור לא תקין '.mysqli_connect_error();
};
*/
/*
הצגת נתונים משאילתה
$query = "SELECT username FROM users WHERE email = 'm.stigel@gmail.com'";

$go_query = mysqli_query($conected, $query);
foreach ($go_query as $tt){
    print_r ($tt['username']);
}
*/

$code = '';
if ($_POST['step'] == 0){
    $login_username = $_POST['username_mail'];
    $login_pass = sha1($_POST['login_pass']);
    // echo $login_username . '---' . $login_pass . '----' . $_POST['login_pass'];
    $query = "SELECT * FROM users WHERE (username = '".$login_username."' OR email = '".$login_username."') AND password = '".$login_pass."'";
    $go_query = mysqli_query($conected, $query);
    $result = mysqli_fetch_assoc($go_query);
    if(mysqli_num_rows($go_query) > 0){
        echo '200';
        $_SESSION['id_login'] = $result['ID'];
    } else {
        echo '3';
    };
} else if ($_POST['step'] == 1){
    //שאילתה לבדיקה אם כבר קיים שם משתמש כזה
    $username = $_POST['username'];//לקיחת נתון מטופס לוגין
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE username = '".$username."'";

    $go_query = mysqli_query($conected, $query);
    if(mysqli_num_rows($go_query) > 0){
        echo '3';
    } else{//שליחת קוד אימות
        $username = $_POST['username'];
        $email = $_POST['email'];
        $birth_date = $_POST['birth_date'];
        $password = sha1($_POST['pass']);
        $query = "INSERT INTO users (username, email, birthday, password) VALUES ('". $username ."','". $email ."','". $birth_date ."', '". $password ."')";
        $go_query = mysqli_query($conected, $query);
        echo '200';
        $_SESSION['id_login'] = mysqli_insert_id($conected);
    };

   
};