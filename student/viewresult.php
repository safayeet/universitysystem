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

if (isset($_POST['submit'])) {
    $feedback = $_POST['feedback'];
    $offeredid = $_POST['offerid'];
    $sql = "update $offeredid set feedback='$feedback' where studentid='$id'";
    if ($conn->query($sql)) {
//        course details table search for grade
        $sql = "select * from $offeredid where studentid='$id'";
        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
            $g = $row['grade'];
            $grade = intval(intval($g) / 10);
            switch ($grade) {
                case 6: $g = 1;
                    break;
                case 7: $g = 2;
                    break;
                case 8: $g = 3;
                    break;
                case 9:$g = 4;
                    break;
                case 10:$g = 4;
                    break;
                default :$g = 0;
                    break;
            }
//offeredcourse table search
            $sql = "select * from offeredcourse where offerid='$offeredid'";
            if ($result = $conn->query($sql)) {
                $row = $result->fetch_assoc();
                $courseid = $row['courseid'];
                $semester = $row['semester'];
//                courselist table search
                $sql = "select * from courselist where courseid='$courseid'";
                if ($result = $conn->query($sql)) {
                    $row = $result->fetch_assoc();
                    $coursename = $row['coursename'];
                    $credit = $row['credithour'];
                }
            }
        }
        echo "<br>" . $courseid . "<br>" . $coursename . "<br>" . $credit . "<br>" . $g . "<br>" . $semester . "<br>" . date('y');
        $sql = "INSERT INTO `$id`(`courseid`, `coursename`, `credit`, `grade`, `semester`, `year`)
                VALUES ($courseid,$coursename,$credit,$g,$semester,'" . date('Y') . "')";
        if ($conn->query($sql)) {
            header('refresh:5; url=studentpanel.php');
        } else
            echo $conn->error . " error occured insert";
    } else {
        echo $conn->error . " error occured";
    }
} else {
    $sql = "select * from offeredcourse where semester ='$semester' and department ='$dept'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $offeredid = $row['offerid'];
    $results = $row['resultstatus'];
    $courseid = $row['courseid'];
    $sql = "select * from '" . $row['offerid'] . "' where studentid='$id'";
    $result1 = $conn->query($sql);
    $row1 = $result->fetch_assoc();
    if (empty($row1['feedback'])) {
        ?>
        <div class="container">
            <h1 class="text-center">Result Sheet</h1>
            <form method="post">
                <table class="table table-responsive">
                    <?php ?>
                    <tr>
                        <?php if ($results === '1') { ?>
                            <td>Please fillup the Feedback area to see the result</td>
                            <td>:</td>
                            <td><textarea name="feedback" rows="5" cols="50" required ></textarea></td>
                        <input style="display: none" type="text" value="<?php echo $offeredid ?>" name="offerid">
                        <input type="submit" name="submit" value="submit">
                        <?php
                    } else {
                        echo"Result isn't processed yet.";
                    }
                    ?>                        
                    </tr>
                </table>

            </form>
        </div>
        <?php
    } else {
        ?>

        <div class="container">
            <h1 class="text-center">Result Sheet</h1>
            <?php
            $sql = "SELECT * FROM `$id`";
            if ($result = mysqli_query($conn, $sql)) {
                ?>
                <table class="table table-responsive">
                    <tr>
                        <td>Course ID</td>
                        <td>Course Name</td>
                        <td>Credit Hour</td>
                        <td>Grade</td>
                        <td>Semester</td>
                        <td>Year</td>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['courseid']; ?></td>
                            <td><?php echo $row['coursename']; ?></td>
                            <td><?php echo $row['credit']; ?></td>
                            <td><?php echo $row['grade']; ?></td>
                            <td><?php echo $row['semester']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                        </tr>
                        <?php
                    }
                } else
                    echo $conn->error;
                ?>
            </table>
        </div>


        <?php
    }
}
?>