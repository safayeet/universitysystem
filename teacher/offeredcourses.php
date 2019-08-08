<?php
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
if ($_SESSION['role'] !== 'teacher') {
    header('location:home.php');
} else {
    require 'header.php';

//storing session variable user value in teacherid variable
    $teacherid = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
    require '../dbcon.php';
    ?>
    <div class="container">
        <table class="table">
            <tr>
                <th>Course Code</th>
                <th>Offered (Department)</th>
                <th>Offered (semester)</th>
                <th>Attendance</th>
                <th>Set Assignment</th>
                <th>View Assignment</th>
                <th>Mark Submit</th>
            </tr>
            <?php
            $sql = "select * from offeredcourse where teacher = '$teacherid'";
            $result1 = $conn->query($sql);
            while ($row1 = $result1->fetch_assoc()) {
                ?>
                <tr>
                    <th><?php echo $row1['courseid']; ?></th>
                    <th><?php echo $row1['department']; ?></th>
                    <th><?php echo $row1['semester']; ?></th>
                    <th><a href="attendance.php?offerid=<?php echo $row1['offerid']; ?>&">click here</a></th>
                    <th><a href="assignment.php?offerid=<?php echo $row1['offerid']; ?>&course=<?php echo $row1['courseid']; ?>" >click here</a></th>
                    <th><a href="download.php?offerid=<?php echo $row1['offerid']; ?>&course=<?php echo $row1['courseid']; ?>" >click here</a></th>
                    <th><a href="result.php?offerid=<?php echo $row1['offerid']; ?>" >click here</a></th>
                </tr>
            <?php } ?>

        </table>
    </div>
    <?php require 'footer.php';
} ?>