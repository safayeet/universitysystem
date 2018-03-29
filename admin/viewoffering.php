<?php
require '../dbcon.php';
if(!isset($_SESSION))session_start ();
$_SESSION['link'] = "viewoffering.php";

if (isset($_GET['delofr'])) {
    $offerid = $_GET['delofr'];

    $sql = "drop table $offerid";
    if ($conn->query($sql)) {
         echo '<script>alert("Removed offering table")</script>';
        $sql = "delete from `offeredcourse` where offerid = '$offerid'";
        if ($conn->query($sql))
           echo '<script>alert("Removed offering")</script>';
        else
            echo '<script>alert("'. $conn->error.'")</script>';
    }else {
        echo '<script>alert("'. $conn->error.'")</script>';
    }
}
?>

<br><br>
<table class="table">
    <tr>
        <td>Offering ID</td>
        <td>Course ID</td>
        <td>Semester</td>
        <td>Department</td>
        <td>Teacher ID</td>
        <td>Action</td>
    </tr>
    <?php
    $query = "select * from offeredcourse;";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['offerid']; ?></td>
            <td><?php echo $row['courseid']; ?></td>
            <td><?php echo $row['semester']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['teacher']; ?></td>
            <td><a class="btn btn-danger" href="adminpanel.php?delofr=<?php echo $row['offerid']; ?>">Delete</a></td>
        </tr>

        <?php
    }
    ?>
</table>