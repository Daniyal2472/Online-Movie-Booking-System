<?php
//unset($_SESSION['user_id']);
session_start();
session_unset();
session_destroy();
echo "<script>location.assign('signin.php')</script>";
?>