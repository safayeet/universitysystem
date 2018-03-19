<?php

session_start();

if (($_SESSION['role']==="admin")) {
    session_destroy();
    header('location: admin/home.php');
} else if (($_SESSION['role']==="teacher")) {
    session_destroy();
    header('location: teacher/home.php');
}
?>