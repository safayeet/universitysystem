
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
    </tr>


    <?php
    require '../dbcon.php';
    
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
        </tr>

        <?php
    }
    $conn->close();
    ?>

</table>

