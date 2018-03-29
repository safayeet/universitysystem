<?php 

if(!isset($_SESSION))session_start ();
$_SESSION['link']='viewteacher.php';
require '../dbcon.php';

if(isset($_GET['delid'])){
    $deptid=$_GET['delid'];
    $sql="DELETE FROM teacherdetails WHERE teacherid = '$deptid'";
    if($conn->query($sql)){
        echo "<script>alert('teacher details deleted')</script>";
    }else
        echo"<script>alert('teacher details not deleted".$conn->error."')</script>";
}

?>
<br><br>
<table class="table">
    <tr>
        <td>Teacher ID</td>
        <td>Password</td>
        <td>Teacher Name</td>
        <td>Location</td>
        <td>Contact</td>
        <td>Department</td>
        <td>Maximum Credit Allowance</td>
        <td>Taken Credit</td>
        <td>Position</td>
        <td>Action</td>
    </tr>


    <?php
    $query = "select * from teacherdetails;";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['teacherid']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['maxcredit']; ?></td>
            <td><?php echo $row['takencredit']; ?></td> 
            <td><?php echo $row['position']; ?></td> 
            <td><a class="btn btn-danger" href="adminpanel.php?delid=<?php echo $row['teacherid']; ?>">Delete</a></td> 
        </tr>

        <?php
    }
    $conn->close();
    ?>

</table>

