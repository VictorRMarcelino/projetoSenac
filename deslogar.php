<?php
session_start();
unset($_SESSION["usuario"]);
unset($_SESSION["usuario_nome"]);
session_unset();
session_destroy();
header("location:log.php");

?>