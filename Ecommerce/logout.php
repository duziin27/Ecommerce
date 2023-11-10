<?php
session_start();

session_destroy();

header("Location: ./Cadastro E Login/Login.php");
exit;
?>
