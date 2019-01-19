<?php
session_start();
session_destroy();
unset($_SESSION['Loged']);
session_unset();
header("Location: index.php");
?>
