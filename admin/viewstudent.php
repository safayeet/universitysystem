<?php

if(!isset($_SESSION))session_start ();
$_SESSION['link']='viewstudent.php';
require '../dbcon.php';

if(isset($_GET['delid'])){
    $studentid=$_GET['delid'];
    $tablename='s'.$studentid;
    $sql="DELETE FROM `studentdetails` WHERE `studentdetails`.`id` = $studentid";
    if($conn->query($sql)){
        echo "<script>alert(".$tablename.")</script>";
        $sql="DROP TABLE $tablename";
        if($conn->query($sql))echo"<script>alert('student table deleted')</script>";
        else echo"<script>alert('student not deleted".$conn->error."')</script>";
    }else
        echo"<script>alert('student not deleted".$conn->error."')</script>";
}
?>
<br><br>
<table class="table">
    <tr>
        <td>ID</td>
        <td>Password</td>
        <td>Studet Name</td>
        <td>Location</td>
        <td>Contact</td>
        <td>Admission Year</td>
        <td>Admission Semester</td>
        <td>Current Semester</td>
        <td>CGPA</td>
        <td>Action</td>
    </tr>


    <?php
    require '../dbcon.php';

    $query = "select * from studentdetails;";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['admissionyear']; ?></td>
            <td><?php echo $row['admissionsemester']; ?></td>
            <td><?php echo $row['currentsemester']; ?></td> 
            <td><?php echo $row['cgpa']; ?></td> 
            <td><a class="btn btn-danger" href="adminpanel.php?delid=<?php echo $row['id']; ?>">Delete Student</a></td> 
        </tr>

        <?php
    }
    ?>

</table>

