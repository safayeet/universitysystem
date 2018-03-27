<?php
//will start session if it's not started
if (!isset($_SESSION))
    session_start();

$_SESSION['link'] = "viewresult.php";
$dept = $_SESSION['department'];
$semester = $_SESSION['semester'];
//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';

$sql = "select * from offeredcourse where semester ='$semester' and department ='$dept'";
$result = $conn->query($sql);
$courses = [];
$results = [];
$courseid = [];
while ($row = $result->fetch_assoc()) {
    $courses = $row['offerid'];
    $results = $row['resultstatus'];
    $courseid = $row['courseid'];
}
?>
<div class="container">
    <h1 class="text-center">Result Sheet</h1>
    <form>
        <table class="table table-responsive">
            <?php
            for ($cnt = 0; $cnt < count($courses); $cnt++) {
                $sql = "select * from '$courses' where studentid=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <tr>
                    <?php if ($results[$cnt] === '1' && $row['feedback'] === NULL) { ?>
                        <td>Please fillup the Feedback area to see the result</td>
                        <td>:</td>
                    <textarea name="feedback"></textarea>
                    <?php
                } else {
                    echo"Result isn't processed yet.";
                }
                ?>
                </tr>
                <?php
            }
            ?>
        </table>
    </form>
</div>