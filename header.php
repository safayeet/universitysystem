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

        <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">UnivX</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Our Campus</a></li>
                    <li><a href="#">Departments</a></li>
                    <li><a href="#">Facilities</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (empty($_SESSION['user'])) { ?>
                        <li><a href="home.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>                        
                    <?php } else { ?>
                        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    <?php } ?>
                        
                        <li><a href="blog/"><span class="glyphicon glyphicon-blackboard"></span>BLOG</a></li>
                </ul>
            </div>
        </nav>

