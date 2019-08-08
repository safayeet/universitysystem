<?php
if(!isset($_SESSION))session_start ();
require '../dbcon.php';
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--bootstrap css library files--> 
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <!--custom css file--> 
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/chat.css" type="text/css" media="screen" />
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>


    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">UnivX</a>
                </div>
                <?php if(!isset($_SESSION['user'])){?>
                <ul class="nav navbar-nav">
                   <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Our Campus</a></li>
                    <li><a href="#">Departments</a></li>
                    <li><a href="facilities.php">Facilities</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="../blog/index.php"><span class="glyphicon glyphicon-blackboard"></span>BLOG</a></li>
                </ul>
                <?php }?>
                <?php if(isset($_SESSION['user']) && $_SESSION['role']==="student"){?>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="studentpanel.php">Home</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="viewresult.php">Result</a></li>
                    <li><a href="versitycalendar.php">Versity Calendar</a></li>
                    <li><a href="chat/index.php">Online Support</a></li>
                    <li><a href="../blog/index.php"><span class="glyphicon glyphicon-blackboard"></span>BLOG</a></li>
                </ul>
                <?php }?>
                

                    
                <ul class="nav navbar-nav navbar-right">
                    <?php if (empty($_SESSION['user'])) { ?>
                        <li><a href="home.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>                        
                    <?php } else { ?>
                        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

