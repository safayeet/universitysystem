<?php
require '../dbcon.php';

?>
<br><br>
<table class="table">
    <tr>
        <td>Department ID</td>
        <td>Department Name</td>
        <td>Total Courses</td>
        <td>Total Credit Hours</td>
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
        </tr>

        <?php
    }
    ?>

</table>

