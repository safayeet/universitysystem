<h1 class="text-center">Student Panel Home page </h1>
<br>

<?php
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['link'] = "home.php";
require '../dbcon.php';
$sql = "Select * from studentdetails where id = '" . $_SESSION['user'] . "'";
if ($conn->query($sql)) {
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    echo $conn->error;
}
?>
<div class="col-sm-7">
        <table class="table table-responsive">
            <tr>
                <td>Student Name</td>
                <td>:</td>
                <td><?php echo $row['name'] ?></td>
            </tr>
            <tr>
                <td>Department</td>
                <td>:</td>
                <td><?php echo $row['department'] ?></td>
            </tr>
        </table>
</div>
<!--<div class="col-sm-4">
        <h2>Teacher Notice</h2>
        <h2>System Notice</h2>
</div>-->
