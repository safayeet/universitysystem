<?php
   if (!isset($_SESSION)) {
        session_start();
    }
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
} else {
 
    require'header.php';
    require '../dbcon.php';;

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
<div class="container">
    <h2 class="text-center">Student's List</h2>
<table class="table table-responsive">
    <tr>
        <th>ID</th>
        <th>Password</th>
        <th>Studet Name</th>
        <th>Location</th>
        <th>Contact</th>
        <th>Admission Year</th>
        <th>Admission Semester</th>
        <th>Current Semester</th>
        <th>CGPA</th>
        <th>Action</th>
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
            <td><?php echo $row['sgpa']; ?></td> 
            <td><a class="btn btn-danger" href="viewstudent.php?delid=<?php echo $row['id']; ?>">Delete Student</a></td> 
        </tr>

        <?php
    }
    ?>

</table>
</div>

<?php 
 require 'footer.php';
}
?>
