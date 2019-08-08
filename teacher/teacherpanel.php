<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== 'teacher') {
    header('location:home.php');
} else {
    require'header.php';

    ?>

    <div class="container">
            <?php require 'base.php'; ?>
    </div>
    <?php require'footer.php';
} ?> 
