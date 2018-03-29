<?php
require 'header.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();

$_SESSION['link'] = "assignment.php";
$dept = $_SESSION['department'];
$semester = $_SESSION['semester'];
$offeredid = $_GET['offerid'];
//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';

if (isset($_POST['submit'])) {


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
            if($conn->query($sql)) {
                echo "<br>link stored";
                header('location:studentpanel.php');
            } else {
                echo "<br>link update error ".$conn->error;
            }
        }
    } else {
        die("Unknown/not permitted file type");
    }
} else {
    ?>

    <div class="container">
        <h1 class="text-center"> Upload Assignment</h1>
        <form class="form-groupo" method="post" enctype="multipart/form-data">
            <p class="text-center">***
                <b class="text-danger">Only PDFs are allowed and should have courseid followed by student id as file name</b>
                ***</p>
            <p class="text-center">For example : 
                <b class="text-danger">ENG10118100000</b>
            </p>

            <input class="form-control" type="file" name="file"><br>
            <input class="btn btn-success" type="submit" name="submit">
        </form>
    </div>
<?php } ?>