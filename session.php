<?php 

session_start();

/*timeout in seconds*/
$inactive = 900;

if(!issst($_SESSION["user_id"])) {
    header("Location: index.html");
    exit();
}

$_SESSION['last_activity'] = time();
?>