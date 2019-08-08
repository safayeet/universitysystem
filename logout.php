<?php

session_start();

if (($_SESSION['role']==="admin" || $_SESSION['role']==="admission" )) {
    session_destroy();
    header('location: admin/home.php');
} else if (($_SESSION['role']==="teacher")) {
    session_destroy();
    header('location: teacher/home.php');
}
else if($_SESSION['role'] = "student"){
    session_destroy();
    header("location:student/home.php");
}
?>