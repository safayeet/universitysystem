
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
            <td><?php echo $row['cgpa']; ?></td> 
        </tr>

        <?php
    }
    ?>

</table>

