<?php
require '../dbcon.php';
$_SESSION['link']="viewoffering.php";
?>

<br><br>
<table class="table">
    <tr>
        <td>Offering ID</td>
        <td>Course ID</td>
        <td>Semester</td>
        <td>Department</td>
        <td>Teacher ID</td>
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
        </tr>

        <?php
    }
    ?>
</table>