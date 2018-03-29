<?php
if(!isset($_SESSION))session_start ();
$_SESSION['link']='viewdepartment.php';
require '../dbcon.php';

if(isset($_GET['deldept'])){
    $deptid=$_GET['deldept'];
    $sql="DELETE FROM departments WHERE deptid = '$deptid'";
    if($conn->query($sql)){
        echo "<script>alert('dept deleted')</script>";
    }else
        echo"<script>alert('student not deleted".$conn->error."')</script>";
}

?>
<br><br>
<table class="table">
    <tr>
        <td>Department ID</td>
        <td>Department Name</td>
        <td>Total Courses</td>
        <td>Total Credit Hours</td>
        <td>Action</td>
    </tr>

    <?php
    $query = "select * from departments;";
    $result = $conn->query($query);
    while ($row =$result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['deptid']; ?></td>
            <td><?php echo $row['deptname']; ?></td>
            <td><?php echo $row['totalcourses']; ?></td>
            <td><?php echo $row['totalcredithour']; ?></td>
            <td><a class="btn btn-danger" href="adminpanel.php?deldept=<?php echo $row['deptid']; ?>">DELETE</a></td>
        </tr>

        <?php
    }
    ?>

</table>

