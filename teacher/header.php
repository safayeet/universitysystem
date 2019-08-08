<?php
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
//        echo"<script>alert('You must login as a Teacher to access.You will be redirected to your " . $_SESSION['link'] . " panel within 5 seconds');</script>";
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'student')
            header("location:../student/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
}

    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">

            <!--bootstrap css library files--> 
            <link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
            <link rel="stylesheet" href="../css/bootstrap.min.css"/>

            <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>

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
                            if ($_SESSION['role'] === "teacher") {
                                ?>
                                <li class="active"><a href="teacherpanel.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>                        
                                <li><a href="../blog/index.php"><span class="glyphicon glyphicon-book"></span> BLOG</a></li>                        
                                <li><a href="offeredcourses.php"><span class="glyphicon glyphicon-list-alt"></span> Offered Courses</a></li>                        
                                <li class=""><a href="versitycalendar.php" >Versity Calendar</a></li>                    

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
                                        <li class=""><a href="chat/" >Live Chat</a></li>
                                        <li><a href="../logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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

