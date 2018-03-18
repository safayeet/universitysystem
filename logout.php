<?php

session_start();

if (!empty($_SESSION['role'])) {
    session_destroy();
    header('location: admin/home.php');
} else {
    session_destroy();
    header('location: ../index.php');
}
?>