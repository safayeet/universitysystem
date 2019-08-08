<?php
require 'header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
//        echo"<script>alert('You must login as a Teacher to access.You will be redirected to your " . $_SESSION['link'] . " panel within 5 seconds');</script>";
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../teacher/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
    }else {
        header("location:../index.php");
    }
}

$dept = $_SESSION['department'];
$semester = $_SESSION['semester'];
//storing session variable user value in teacherid variable
$id = $_SESSION['user'];
$id1 = "s" . $id;
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';


// when feedback is submitted triggered
if (isset($_POST['submit'])) {
//    echo " submit hoise ";
//    $feedback = trim($_POST['feedback']);
    $offeredid = $_POST['ofrid'];

//    check if feedback submitted already or not
    $sql = "select * from $offeredid where studentid='$id'";
    if ($conn->query($sql)) {
//        echo "<script>alert('got offered id details');</script>";
        $result1 = $conn->query($sql);
    } else
        echo $conn->error;

    $row1 = $result1->fetch_assoc();
    if ($row1['feedback'] !== '' && $row1['feedback'] !== NULL) {
        echo "<script>alert('feedback submitted already');</script>";
    } else {
        
//        feedback form field values
        $quality = intval($_POST['quality']);
        $teacher_attendance = intval($_POST['attendance']);
        $teacher_grade = intval($_POST['grade']);
        $behavior = intval($_POST['behavior']);
        $classmaterial = intval($_POST['classmaterial']);
        $recommendation = intval($_POST['recommendation']);
        
        $feedback=$quality.",".$teacher_attendance.",".$teacher_grade.",".$behavior.",".$classmaterial.",".$recommendation;
        
        $sql = "update " . $offeredid . " set feedback='" . $feedback . "' where studentid=" . $id;

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
//                echo"<script>alert('offered course searched')</script>";
                    $row = $result->fetch_assoc();
                    $courseid = $row['courseid'];
                    $semester = $row['semester'];
//                courselist table search
                    $sql = "select * from courselist where courseid='$courseid'";
                    if ($result = $conn->query($sql)) {
//                    echo"<script>alert('course list searched')</script>";
                        $row = $result->fetch_assoc();
                        $coursename = $row['coursename'];
                        $credit = $row['credithour'];
                    }
                }
            } else {
               // echo $conn->error;
            }
            $rowcount = $conn->query("select count(*) from " . $id1);
            $rows = $rowcount->fetch_array();
            $sl = intval($rows[0]) + 1;

            //echo "<br>" . $sl . "<br>" . $courseid . "<br>" . $coursename . "<br>" . $credit . "<br>"
            //. $g . "<br>" . $semester . "<br>" . date('y') . "<br>";

//            inserting result in student table
            $sql = "INSERT INTO $id1 (`sl`, `courseid`, `coursename`, `credit`, `grade`, `semester`, `year`)
                VALUES ($sl,'$courseid','$coursename','$credit','$g','$semester','" . date('Y') . "')";
            if ($conn->query($sql)) {
               // echo "result recieved";
            } else{}
               // echo $conn->error . " error occured insert";
        }
    }
}
//if feedback is not submitted
else if (isset($_GET['offerid'])) {

    $offerid = $_GET['offerid'];
    $sql = "select * from $offerid where studentid=$id";
    if ($conn->query($sql)) {
//        echo "<script>alert('got offered id details');</script>";
        $result1 = $conn->query($sql);
    } else
        echo $conn->error;

    $row1 = $result1->fetch_assoc();
//    echo $row1['feedback'] . " paialsi";
    if ($row1['feedback'] === '' || $row1['feedback'] === NULL) {
        ?>
        <div class="container">
            <h1 class="text-center">Instructor Feedback</h1>
            <form method="post" id="feedback">
                <table class="table table-responsive">
                    <?php
                    ?>
                    <!--quality-->
                    <tr>
                        <td>Quality of teaching</td>
                        <td> : </td>
                        <td>
                            <select name="quality" required >
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Moderate</option>
                                <option value="1">Poor</option>
                            </select>
                        </td>                                           
                    </tr>
                    <!--attendance-->
                    <tr>
                        <td>Class Attendance</td>
                        <td> : </td>
                        <td>
                            <select name="attendance" required >
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Moderate</option>
                                <option value="1">Poor</option>
                            </select>
                        </td>                                           
                    </tr>
                    <!--grade-->
                    <tr>
                        <td>Grade</td>
                        <td> : </td>
                        <td>
                            <select name="grade" required >
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Moderate</option>
                                <option value="1">Poor</option>
                            </select>
                        </td>                                           
                    </tr>
                    <!--behavior-->
                    <tr>
                        <td>Behavior</td>
                        <td> : </td>
                        <td>
                            <select name="behavior" required >
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Moderate</option>
                                <option value="1">Poor</option>
                            </select>
                        </td>                                           
                    </tr>
                    <!--classmaterial-->
                    <tr>
                        <td>Class Materials</td>
                        <td> : </td>
                        <td>
                            <select name="classmaterial" required >
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Moderate</option>
                                <option value="1">Poor</option>
                            </select>
                        </td>                                           
                    </tr>
                    <!--recommendation-->
                    <tr>
                        <td>Recommendation</td>
                        <td> : </td>
                        <td>
                            <select name="recommendation" required >
                                <option value="5">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </td>                                           
                    </tr>


                    <tr>
                        <td><input style="display: none" type="text" value="<?php echo $offerid; ?>" name="ofrid"></td>
                        <td></td>
                        <td><input type="submit" class="btn btn-success" name="submit" value="submit"></td>
                    </tr>
                </table>

            </form>

        </div>
        <?php
    }
}
?>

<!--view result sheet-->
<div class="container">
    <h1 class="text-center">Result Sheet</h1>

    <?php
    $sql = "SELECT * FROM `$id1`";
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
                    <td><?php
                        switch (intval($row['grade'])) {
                            case 1:echo "D";
                                break;
                            case 2:echo "C";
                                break;
                            case 3:echo "B";
                                break;
                            case 4:echo "A";
                                break;
                        }
                        ?></td>
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


