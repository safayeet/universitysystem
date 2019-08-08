<?php
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
include '../delnotice.php';
require '../dbcon.php';
$sql = "Select * from studentdetails where id = '" . $_SESSION['user'] . "'";
if ($conn->query($sql)) {

    $result1 = $conn->query($sql);
    $row1 = $result1->fetch_assoc();
//    echo"<script>alert('2 ".$row1['department'].$row1['currentsemester']."');</script>";
} else {
    echo $conn->error;
}
?>
<h1 class="text-center">Student Panel Home page </h1>
<br>
<div class="col-sm-8">
    <table class="table table-responsive">
        <tr>
            <td>Student Name</td>
            <td>:</td>
            <td><?php echo $row1['name'] ?></td>
        </tr>
        <tr>
            <td>Department</td>
            <td>:</td>
            <td><?php echo $row1['department'] ?></td>
        </tr>
        <tr>
            <td>CGPA</td>
            <td>:</td>
            <td><?php
//                call all the values from students gradelist
                $sql = "select * from s" . $_SESSION['user'] . "";
                if ($result = $conn->query($sql)) {
//                store the grade and credit hour in integer arrays
                    $credit = 0;
                    $grade = 0;

                    while ($row = $result->fetch_assoc()) {
                        $grade = $grade + (intval($row['credit']) * intval($row['grade']));
                        $credit = $credit + intval($row['credit']);
//                        echo $grade . " " . $credit . "<br>";
                    }
                    if ($grade !== 0 || $credit !== 0)
                        echo floatval($grade / $credit);
                    else
                        echo 'No Course Complete yet';
                } else {
                    echo $conn->error;
                }
                ?></td>
        </tr>
    </table>
</div>
<div class="col-sm-4">
    <?php
    ?>
    <h2>Notice Board</h2>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">System</a></li>
        <li><a data-toggle="tab" href="#menu1">Administration</a></li>
        <li><a data-toggle="tab" href="#menu2">Course</a></li>
    </ul>

    <div class="tab-content">
        <!--system notice area-->
        <div id="home" class="tab-pane fade in active">
            <table class="table table-responsive">
                <?php
                $system = "select * from notice where (noticefrom='system' and noticeto='everyone') or"
                        . " (noticefrom='system' and noticeto='student') order by sl DESC";
                if ($result = $conn->query($system)) {
                    while ($row = $result->fetch_assoc()) {
                        ?> <tr>
                            <td><?php echo $row['noticedate'] . "<br>" . $row['noticefrom']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    
                }
                ?>
            </table>
        </div>

        <div id="menu1" class="tab-pane fade">
            <table class="table table-responsive">
                <?php
                $s = "select offerid from offeredcourse where  department='" . $row1['department'] . "' and semester='" . $row1['currentsemester'] . "'";
                if ($x = mysqli_query($conn, $s)) {
                    while ($z = mysqli_fetch_array($x)) {
                        $admin = "select * from notice where (noticefrom='admin' and noticeto='everyone') or"
                                . " (noticefrom='admin' and noticeto='student')or"
                                . " (noticefrom='admin' and noticeto='$z[0]') order by sl DESC";
                        if ($result = $conn->query($admin)) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['noticedate'] . "<br>" . $row['noticefrom']; ?>
                                    </td>
                                    <td><?php echo $row['message']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo"<script>alert(' " . $conn->error . "');</script>";
                        }
                    }
                }
                ?>
            </table>
        </div>

        <div id="menu2" class="tab-pane fade">
            <table class="table table-responsive">
                <?php
                $s = "select offerid from offeredcourse where  department='" . $row1['department'] . "' and semester='" . $row1['currentsemester'] . "'";
                if ($x = mysqli_query($conn, $s)) {
                    while ($z = mysqli_fetch_array($x)) {
//                            echo"<script>alert('2 ".$z[0]."');</script>";
                        $course = " select * from notice where (noticefrom='system' or noticefrom='teacher') and noticeto='" . $z[0] . "' order by sl DESC";
                        if ($result = $conn->query($course)) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['noticedate'] . "<br>" . $row['noticefrom']; ?>
                                    </td>
                                    <td><?php echo $row['message']; ?></td>
                                </tr>
                                <?php
                            }
                        } else
                            echo"<script>alert('1 " . mysqli_error($conn) . "');</script>";
                    }
                } else
                    echo"<script>alert('2 " . mysqli_error($conn) . "');</script>";
                ?>
            </table>
        </div>
    </div>
</div>
