<?php
//will start session if it's not started
if (!isset($_SESSION))
session_start();

$_SESSION['link'] = "courses.php";

//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';
?>

<table class="table">
    <tr>
        <th>Course Code</th>
        <th>Offered (Department)</th>
        <th>Offered (semester)</th>
        <th>Attendance</th>
        <th>Assignment</th>
        <th>Result Submit</th>
    </tr>
    <?php
    $sql = "select department,currentsemester from studentdetails where  = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $dept=$row['department'];
    $semester=$row['currentsemester'];
    
    $sql="select * from offeredcourse where semester = '$semester' and department='$department'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    ?>
    <tr>
        <th><?php echo $row1['courseid']; ?></th>
        <th><?php echo $row1['department']; ?></th>
        <th><?php echo $row1['semester']; ?></th>
        <th><a href="attendance.php?offerid=<?php echo $row1['offerid']; ?>" >click here</a></th>
        <th><a href="assignment.php?offerid=<?php echo $row1['offerid']; ?>" >click here</a></th>
        <th><a href="result.php?offerid=<?php echo $row1['offerid']; ?>" >click here</a></th>
    </tr>
    <?php } ?>

</table>
