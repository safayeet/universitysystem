<?php
if (!isset($_SESSION))
    session_start();
if ($_SESSION['role'] !== 'teacher') {
    header('location:home.php');
} else {
    require 'header.php';
//will start session if it's not started
    $offeredid = $_GET['offerid'];
//storing session variable user value in teacherid variable
    $teacherid = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
    require '../dbcon.php';
    
    if (isset($_POST['fsubmit'])) {
        $studentid = $_POST['studentid'];
        $assignment = $_POST['assignment'];
        $first = $_POST['first'];
        $mid = $_POST['mid'];
        $final = $_POST['final'];
        $totalclass = $_POST['totalclass'];
        $present = $_POST['present'];
        $cnt = $_POST['count'];

        $sql = "update offeredcourse set resultstatus='1' where offerid = '$offeredid'";
        if ($conn->query($sql)) {
            //echo 'Result Status Updated<br>';
            for ($i = 0; $i < intval($cnt); $i++) {
                if ($totalclass[$i] > 0)
                    $attendance = floatval(intval($present[$i]) / intval($totalclass[$i])) * .05;
                else
                    $attendance = 0;

                $grade = intval($attendance) + floatval($first[$i]) + floatval($final[$i]) + floatval($mid[$i]) + floatval($assignment[$i]);
                $grade = ceil($grade);
                $sql = "update $offeredid set grade = $grade where studentid = '$studentid[$i]'";
                if ($conn->query($sql)) {
                    //echo "grade updated";

                    header("localhost:result.php?offerid=".$offeredid);
                } else {
                    echo "grade not updated. Error " . $conn->error;
                }
            }
        } else {
            echo 'Result Status not Updated. Error ' . $conn->error;
        }
    } else if (isset($_POST['submit'])) {
        $studentid = $_POST['studentid'];
        $assignment = $_POST['assignment'];
        $first = $_POST['first'];
        $mid = $_POST['mid'];
        $final = $_POST['final'];
        $cnt = $_POST['count'];

        for ($i = 0; $i < intval($cnt); $i++) {

//            echo "<br>" . $studentid[$i] . " " . $assignment[$i] . " " . $first[$i] . " " . $mid[$i] . " " . $final[$i] . "<br>";

            $sql = "update " . $offeredid . " set assignment='" . floatval($assignment[$i]) . "', first='" . floatval($first[$i]) . "',
          mid='" . floatval($mid[$i]) . "',final='" . floatval($final[$i]) . "' where studentid='" . $studentid[$i] . "'";
            if ($conn->query($sql) === TRUE) {
                header("localhost:result.php?offerid=".$offeredid);
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
        <div class="col-sm-9">
            <h1 class="text-center">Student List</h1>
            <form class="form-group" action="" method="post">
                <table class="table table-responsive">
                    <tr>
                        <th>Serial</th>
                        <th>Student ID</th>
                        <th>Student name</th>
                        <th>Assignment</th>
                        <th>First Term</th>
                        <th>Mid Term</th>
                        <th>Final Term</th>
                        <th>Attendance</th>
                    </tr>
                    <?php
                    $counter = 0;
                    while ($row = $result->fetch_assoc()) {
                        $counter++;
                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><input class="form-control"  type='text' name='studentid[]' value='<?php echo $row['studentid']; ?>' readonly></td>
                            <td><?php echo $row['studentname']; ?></td>
                            <td><input class="form-control" type='text' name='assignment[]' value='<?php echo $row['assignment']; ?>' ></td>
                            <td> <input class="form-control" type='text' name='first[]' value='<?php echo $row['first']; ?>' ></td>
                            <td> <input  class="form-control" type='text' name='mid[]' value='<?php echo $row['mid']; ?> ' ></td>
                            <td> <input class="form-control"  type='text' name='final[]' value="<?php echo $row['final']; ?>" ></td>
                            <td> <input class="form-control"  type='text' value="<?php
                                if (intval($row['totalclass']) > 0){
                                $attendance= floatval(intval($row['present']) / intval($row['totalclass'])) * .1;     
                                echo $attendance;
                                }
                                else{
                                echo 0;                                
                                }
                                ?>" ></td>
                        </tr>
                        <td style="display: none"> <input type='text' name='totalclass[]' value='<?php echo $row['totalclass']; ?>' ></td>
                        <td style="display: none"> <input type='text' name='present[]' value='<?php echo $row['present']; ?> ' ></td>
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
    <?php
}
?>