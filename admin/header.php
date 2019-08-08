<?php if (!isset($_SESSION))
    session_start();
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
                <ul class="nav navbar-nav">
                    <?php if (empty($_SESSION['user'])) { ?>                        
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Our Campus</a></li>
                        <li><a href="#">Departments</a></li>
                        <li><a href="facilities.php">Facilities</a></li>
                        <li><a href="contact.php">Contact</a></li>               
                        <li><a href="../blog/index.php"><span class="glyphicon glyphicon-book"></span> BLOG</a></li>
                        <?php
                    } else {
                        if ($_SESSION['role'] === "admin" || $_SESSION['role'] === "admission") {
                            ?>
                            <li class="active"><a href="adminpanel.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>                        
                            <li><a href="../blog/index.php"><span class="glyphicon glyphicon-book"></span> BLOG</a></li>
                            <?php if ($_SESSION['role'] === 'admission') { ?>

                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-list-alt"></span> Add New
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">                           
                                        <li class=""><a href="addteacher.php" >Add Teacher</a></li>
                                        <li class=""><a href="addstudent.php" >Add Student</a></li>
                                    </ul>
                                </li>
                            <?php } if ($_SESSION['role'] === 'admin') { ?>
                                <li class=""><a href="addcourse.php" >Course</a></li>
                                <li class=""><a href="adddepartment.php" >Department</a></li>
                                <li class=""><a href="offeredcourse.php" >Course Offering</a></li>
                            <?php } ?>
                            <li class=""><a href="versitycalendar.php" >Versity Calendar</a></li>                    
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-list-alt"></span> View List
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">                           
                                    <li><a href="viewdepartment.php">Departments</a></li>
                                    <li><a href="viewcourses.php">Courses</a></li>
                                    <li><a href="viewoffering.php">Offered Courses</a></li>
                                    <li><a href="viewstudent.php">Students</a></li>
                                    <li><a href="viewteacher.php">Teachers</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (empty($_SESSION['user'])) { ?>
                    <li><a href="home.php" class="active"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>                        
                    <?php
                    } else {
                    if ($_SESSION['user'] !== "admin" || $_SESSION['user'] !== "admission") {
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php">My Profile</a></li>
                            <?php if ($_SESSION['role'] === "admin") {
                            ?>
                            <li class=""><a href="chat/" >Live Chat</a></li>
                            <?php } ?>
                            <li><a href="../logout.php"> <span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                        </ul>
                    </li>
                    <?php } else { ?>
                        <li><a href="home.php" class="active"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>  
                            <?php
                        }
                        }
                        ?>
                </ul>

            </div>
        </nav>

