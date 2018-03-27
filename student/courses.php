<?php
//will start session if it's not started
if (!isset($_SESSION))
    session_start();

$_SESSION['link'] = "courses.php";
$dept = $_SESSION['department'];
$semester = $_SESSION['semester'];
//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';
?>

<table class="table">
    <tr>
        <th>Course Code</th>
        <th>Instructor</th>
        <th>Assignment</th>
        <th>Course Performance</th>
    </tr>
    <?php
    $sql = "select * from offeredcourse where semester = '$semester' and department='$dept'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <th><?php echo $row['courseid']; ?></th>
            <th><?php echo $row['teacher']; ?></th>
            <th><a href=" <?php
                if ($row['assignmentstatus'] === '1') {
                    echo 'assignment.php?offerid=' . $row['offerid'];
                } else
                    echo "#"
                    ?>"
                   >
                       <?php
                       if ($row['assignmentstatus'] === '1') {
                           echo 'Submit Assignment';
                       } else
                           echo 'No Assignment';
                       ?>
                </a></th>
            <th><a href="coursedetails.php?offerid=<?php echo $row['offerid']; ?>">Course Details</a></th>
        </tr>
    <?php } ?>

</table>
