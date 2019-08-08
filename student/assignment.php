
<?php
require 'header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
//        echo"<script>alert('You must login as a Teacher to access.You will be redirected to your " . $_SESSION['link'] . " panel within 5 seconds');</script>";
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../teacher/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
    }else{
        header("location:../index.php");
    }
}
require '../dbcon.php';
$dept = $_SESSION['department'];
$semester = $_SESSION['semester'];
$offeredid = $_GET['offerid'];
//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';

if (isset($_POST['submit'])) {

    $q = "select * from " . $offeredid . " where studentid='$id'";
    if ($ass = $conn->query($q)) {
        echo '<script>alert("check assignment");</script>';
        $row = $ass->fetch_assoc();
        if ($row['assignmentlink'] === NULL || $row['assignmentlink'] === '') {
            echo '<script>alert("no assignment submitted. please submit by the last date");</script>';
            if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                die("Upload failed with error " . $_FILES['file']['error']);
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
            if ($mime === 'application/pdf') {
                $target = "../assignment/" . $_FILES["file"]["name"];
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target)) {
                    echo "file uploaded";
                    $sql = "update $offeredid set assignmentlink='$target' where studentid='$id'";
                    if ($conn->query($sql)) {
                        echo "<br>link stored";
                        $_SESSION['link'] = "courses.php";
                        header('location:studentpanel.php');
                    } else {
                        echo "<br>link update error " . $conn->error;
                    }
                }
            } else {
                die("Unknown/not permitted file type");
            }
        } else {
            echo '<script>alert("assignment already submitted.");</script>';
        }
    }
} else {

    $sql = "select * from assignment where ofrid = '$offeredid' order by lastsubmission desc";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        
    } else {
        echo $conn->error;
    }
    $q = "select * from " . $offeredid . " where studentid='$id'";
    if ($ass = $conn->query($q)) {
        echo '<script>alert("check assignment");</script>';
        $row1 = $ass->fetch_assoc();
        ?>

        <div class="container">
        <?php if (mysqli_num_rows($result) > 0) { ?>
                <div class="">
                    <h2 class="text-center">Assignment Topic</h2>
                    <h3><?php echo $row['assignment']; ?></h3>
                    <p>Last Submission date : <b><?php echo date('jS M, Y', strtotime($row['lastsubmission'])); ?></b></p>
                </div>

                <h1 class="text-center"> Upload Assignment</h1>
                <form class="form-groupo" method="post" enctype="multipart/form-data">
                    <p class="text-center">***
                        <b class="text-danger">Only PDFs are allowed and should have courseid followed by student id as file name</b>
                        ***</p>
                    <p class="text-center">For example : 
                        <b class="text-danger">ENG10118100000</b>
                    </p>
                    <?php
                    if ($row1['assignmentlink'] === NULL || $row1['assignmentlink'] === '') {
                        echo '<script>alert("no assignment submitted. please submit by the last date");</script>';
                        ?>
                        <input class="form-control" type="file" name="file"><br>
                        <input class="btn btn-success" type="submit" name="submit">
                        <?php
                    } else {
                        echo "<h2 class='text-danger'>You have already submited  assignment</h2>";
                    }
                }
                ?>
            </form>
            <?php
        } else {
            echo "<h2 class='text-danger'>No Assignment</h2>";
        }
        ?>
    </div>
<?php } ?>