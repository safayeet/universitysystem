<?php
if(!isset($_SESSION))session_start ();
$_SESSION['link']="viewcourses.php";
require '../dbcon.php';
if(isset($_GET['delcourse'])){
    $courseid=$_GET['delcourse'];
    $sql="delete from courselist where courseid='$courseid'";
    if($conn->query($sql)) {echo "<script>alert('course deleted')</script>";}
    else echo "<script>alert('course not deleted')</script>";
}

?>

<br><br>
<table class="table">
    <tr>
        <td>Course Code</td>
        <td>Course Name</td>
        <td>Department</td>
        <td>Credit Hour</td>
        <td>Action</td>
    </tr>
<?php
    $query = "select * from courselist;";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['courseid']; ?></td>
            <td><?php echo $row['coursename']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['credithour']; ?></td>
            <td><a class="btn btn-danger" href="adminpanel.php?delcourse=<?php echo $row['courseid']; ?>">delete</a></td>
        </tr>

        <?php
    }
    ?>
</table>