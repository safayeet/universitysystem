<?php
require 'header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../teacher/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
    }else {
        header("location:../index.php");
    }
}
?>
<div class="container">
    <?php require 'base.php'; ?>
</div>


<?php require'footer.php'; ?>
