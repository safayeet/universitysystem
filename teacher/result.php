<?php
require 'header.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();

$offeredid = $_GET['offerid'];

$_SESSION['link'] = "result.php";

//storing session variable user value in teacherid variable
$teacherid = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';
if (isset($_POST['submit'])) {
    $studentid = $_POST['studentid'];
    $assignment = $_POST['assignment'];
    $first = $_POST['first'];
    $mid = $_POST['mid'];
    $final = $_POST['final'];
    $cnt = $_POST['count'];

    for ($i = 0; $i < intval($cnt); $i++) {

        echo "<br>" . $studentid[$i] . " " . $assignment[$i] . " " . $first[$i] . " " . $mid[$i] . " " . $final[$i] . "<br>";

        $sql = "update " . $offeredid . " set assignment='" . floatval($assignment[$i]) . "', first='" . floatval($first[$i]) . "',
          mid='" . floatval($mid[$i]) . "',final='" . floatval($final[$i]) . "' where studentid='" . $studentid[$i] . "'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['link'] = "offeredcourses.php";
            header("location:teacherpanel.php");
        } else {
            echo $studentid[$i] . " Result update error<br>" . $conn->error;
        }
    }
}
$sql = "select * from $offeredid";
$result = $conn->query($sql);
?>


<div class="container">
    <div class="col-sm-2">
        <h1 class="text-center">Evaluation</h1>
        <table class="table">
            <tr>
                <th>First</th>
                <th>20%</th>
            </tr>
            <tr>
                <th>Mid</th>
                <th>25%</th>
            </tr>
            <tr>
                <th>Final</th>
                <th>40%</th>
            </tr>
            <tr>
                <th>Attendance</th>
                <th>10%</th>
            </tr>
            <tr>
                <th>Assignment</th>
                <th>5%</th>
            </tr>
            <tr>
                <th>Total</th>
                <th>100%</th>
            </tr>
        </table>
        
        <p class="text-danger text-center">***<b>Please put the marks as the table</b>***</p>
    </div>
    <div class="col-sm-10">
        <h1 class="text-center">Student List</h1>
        <form class="" action="" method="post">
            <table class="table">
                <tr>
                    <th>Serial</th>
                    <th>Student ID</th>
                    <th>Student name</th>
                    <th>Assignment</th>
                    <th>First Term</th>
                    <th>Mid Term</th>
                    <th>Final Term</th>
                </tr>
                <?php
                $counter = 0;
                while ($row = $result->fetch_assoc()) {
                    $counter++;
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><input  type='text' name='studentid[]' value='<?php echo $row['studentid']; ?>'></td>
                        <td><?php echo $row['studentname']; ?></td>
                        <td><input type='text' name='assignment[]' value='<?php echo $row['assignment']; ?>' ></td>
                        <td> <input type='text' name='first[]' value='<?php echo $row['first']; ?>' ></td>
                        <td> <input type='text' name='mid[]' value='<?php echo $row['mid']; ?> ' ></td>
                        <td> <input  type='text' name='final[]' value="<?php echo $row['final']; ?>" ></td>
                    </tr>


                    <?php
                }
                ?>
            </table>
            <input style="display: none"  type="text" name="count" value="<?php echo $counter; ?>" >
            <input type="submit" name="submit" value="Submit" style="float: right">
            <input type="submit" name="fsubmit" value="Final Submit" style="float: right">
        </form>
    </div>
</div>