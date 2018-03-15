<?php
require '../dbcon.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
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
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
        </tr>

        <?php
    }
    ?>

</table>

