<?php
require '../dbcon.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<br><br>
<table class="table">
    <tr>
        <td>Course Code</td>
        <td>Course Name</td>
        <td>Department</td>
        <td>Credit Hour</td>
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
        </tr>

        <?php
    }
    ?>
</table>