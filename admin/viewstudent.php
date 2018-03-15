
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
    </tr>


    <?php
    require '../dbcon.php';
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }

    $query = "select * from studentdetails;";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            <td><?php echo $row[7]; ?></td> 
            <td><?php echo $row[8]; ?></td> 

        </tr>

        <?php
    }
    ?>

</table>

