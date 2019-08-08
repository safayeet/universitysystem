
<?php if (!isset($_SESSION)) session_start();
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link rel="stylesheet" href="../../css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../../css/style.css"/>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">UnivX</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (empty($_SESSION['role'])) { ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span>  LOGIN
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../student/">Student</a></li>
                                <li><a href="../teacher/">Teacher</a></li>
                                <li><a href="../admin/">Administration</a></li>
                            </ul>
                        </li>


                        <li><a href="blog/">BLOG</a></li>
                        <!--                                         -->
                    <?php } else { ?>
                        <li><a href="<?php
                            if ($_SESSION['role'] === "admin" || $_SESSION['role'] === "admission")
                                echo"../../admin";
                            else if ($_SESSION['role'] === "student")
                                echo "../studentpanel.php";
                            else if ($_SESSION['role'] === "teacher")
                                echo "../../teacher";
                            ?>
                            "><span class="glyphicon glyphicon-backward"></span> Return</a></li>
                        <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
<?php } ?>
                </ul>
            </div>
        </nav>

