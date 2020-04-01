<?php
session_start();
$_SESSION['mail'] = null;
session_destroy();
header('Location: ../index.php');
