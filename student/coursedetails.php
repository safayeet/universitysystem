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

$semester = $_SESSION['semester'];
$offeredid = $_GET['offerid'];
//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';

$sql = "select * from $offeredid where studentid ='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container">
    <div class="col-sm-8">
        <h2 class="text-center">Marks</h2>
        <table class="table table-responsive">
            <tr>
                <td>Assignment</td>
                <td> : </td>
                <td><?php echo $row['assignment']; ?></td>
            </tr>
            <tr>
                <td>Attendance</td>
                <td> : </td>
                <td><?php
                if(floatval($row['totalclass'])>0){
                    $att = (floatval($row['present']) / floatval($row['totalclass'])) * .05;
                }
                else {$att=0;}
                    echo $att;
                    ?></td>
            </tr>
            <tr>
                <td>First Term</td>
                <td> : </td>
                <td><?php echo $row['first']; ?></td>
            </tr>
            <tr>
                <td>Mid Term</td>
                <td> : </td>
                <td><?php echo $row['mid']; ?></td>
            </tr>
            <tr>
                <td>Final Term</td>
                <td> : </td>
                <td><?php echo $row['final']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <h2 class="text-center">Attendance</h2>
        <table class="table table-responsive">
            <tr>
                <td>Total Classes</td>
                <td>:</td>
                <td><?php echo $row['totalclass']; ?></td>
            </tr>
            <tr>
                <td>Present Classes</td>
                <td>:</td>
                <td><?php echo $row['present']; ?></td>
            </tr>
            <tr>
                <td>Absent Classes</td>
                <td>:</td>
                <td><?php                
                echo $row['absent'];                
                ?></td>
            </tr>
        </table>
    </div>
    <a href="studentpanel.php">Return</a>
</div>