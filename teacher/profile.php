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
//    echo $teacherid;
//calling the dbcon files inside this file for fetching required configurations
    require '../dbcon.php';
    ?>
    <style>
        .col-sm-8 tr th,.col-sm-4 tr th{
            border-top: unset;
        }
    </style>
    <div class="container">
        <div class="col-sm-7">
            <br>
            <h1 class="text-center">Teacher Profile</h1>
            <br>
            <table class="table table-responsive">
                <?php
                $sql = "select * from teacherdetails where teacherid = '$teacherid'";
                $result1 = $conn->query($sql);
                if ($row1 = $result1->fetch_assoc()) {
//                echo "<br> paise";
                    ?>
                    <tr>
                        <th>Name</th>
                        <th>:</th>
                        <th><?php echo strtoupper($row1['name']); ?></th>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <th>:</th>
                        <th><?php echo strtoupper($row1['position']); ?></th>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <th>:</th>
                        <th><?php echo strtoupper($row1['department']); ?></th>
                    </tr>
                    <tr>
                        <th>Maximum Credit Hour</th>
                        <th>:</th>
                        <th><?php echo strtoupper($row1['maxcredit']); ?></th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>:</th>
                        <th><?php echo $row1['teacherid']; ?></th>
                    </tr>
                    <tr>
                        <th>PassWord</th>
                        <th>:</th>
                        <th><?php echo $row1['password']; ?></th>
                    </tr>
                    <tr>
                        <th>Contact No</th>
                        <th>:</th>
                        <th><?php echo $row1['contact']; ?></th>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <th>:</th>
                        <th><?php echo $row1['location']; ?></th>
                    </tr>

                    <?php
                } else {
                    echo $conn->error;
                    ?>
                    <h1 class="text-center text-danger">No Data Found</h1>
                <?php } ?>

            </table>
        </div>
        <div class="col-sm-5">
            <br><br>
            <div class="container-fluid">
                <div class="well">

                    <h3 class="text-center">Average Rating</h3>
                    <?php
                    $sql = "select feedback from teacherdetails where teacherid='$teacherid'";
                    $result = $conn->query($sql);
                    $row1 = $result->fetch_array();
                    $feedbackarr = explode(',', $row1[0]);
                    
                    $quality = floatval($feedbackarr[0]);
                    $teacher_attendance = floatval($feedbackarr[1]);
                    $teacher_grade = floatval($feedbackarr[2]);
                    $behavior = floatval($feedbackarr[3]);
                    $classmaterial = floatval($feedbackarr[4]);
                    $recommendation = floatval($feedbackarr[5]);

                    if ($quality !== 0)
                        $quality = (($quality / 5) * 100);
                    if ($teacher_attendance !== 0)
                        $teacher_attendance = (($teacher_attendance / 5) * 100);
                    if ($teacher_grade !== 0)
                        $teacher_grade = (($teacher_grade / 5) * 100);
                    if ($behavior !== 0)
                        $behavior = (($behavior / 5) * 100);
                    if ($classmaterial !== 0)
                        $classmaterial = (($classmaterial / 5) * 100);
                    if ($recommendation !== 0)
                        $recommendation = (($recommendation / 5) * 100);

//                    echo $quality . $teacher_attendance . $teacher_grade . $behavior . $classmaterial . $recommendation;
                    ?>
                    <table class="table table-responsive">
                        <tr>
                        <th>
                            <p class="text-center"><i class="fa fa-thumbs-o-up" style="color:#ff0000;font-size: 6em;"></i></p>
                            <p class="text-center">Recommended <b style="font-size: 1.5em;"><?php echo $recommendation . "%" ?></b></p>
                        </th>
                        <th>
                            <?php
                            echo "<br>Teaching Quality : " . $quality . "%" . "<br>"
                            . "Teacher Attendance : " . $teacher_attendance . "%" . "<br>" .
                            "Teacher Grading : " . $teacher_grade . "%" . "<br>" .
                            "Teacher's Behavior : " . $behavior . "%" . "<br>" .
                            "Class Material : " . $classmaterial . "%";
                            ?>
                        </th>
                    </tr>
                    </table>
                </div>
            </div>

            <br><br>
            <h3 class="text-center">Course Reviews</h3>
            <table class="table table-responsive table-striped">
                <tr class="text-center">
                    <th>SL</th>
                    <th>No. of Students</th>
                    <th>Student FeedBack</th>
                </tr>
                <?php
//              echo '<script>alert("Got Teacher ID : '.$teacherid.'")</script>';
                $sql = "select * from offeredcourse where teacher='$teacherid'";
                $result = $conn->query($sql);
                $cnt = 0;
                $quality = $teacher_attendance = $teacher_grade = $behavior = $classmaterial = $recommendation = $students = 0;

                while ($row = $result->fetch_array()) {
//              echo '<script>alert("Got offerid : ' . $row['offerid'] . '")</script>';
                    $query = "select feedback from $row[0] order by feedback DESC";
                    $result1 = $conn->query($query);
                    while ($row1 = $result1->fetch_Array()) {
                        if ($row1[0] > '') {
                            $students++;
                            $feedbackarr = explode(',', $row1[0]);
                            $quality += intval($feedbackarr[0]);
                            $teacher_attendance += intval($feedbackarr[1]);
                            $teacher_grade += intval($feedbackarr[2]);
                            $behavior += intval($feedbackarr[3]);
                            $classmaterial += intval($feedbackarr[4]);
                            $recommendation += intval($feedbackarr[5]);
                        }
                    }
                    ?>  
                    <tr>

                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $students; ?></td>
                        <td>
                            <?php
                            if ($quality !== 0)
                                $quality = ((($quality / $students) / 5) * 100);
                            if ($teacher_attendance !== 0)
                                $teacher_attendance = ((($teacher_attendance / $students) / 5) * 100);
                            if ($teacher_grade !== 0)
                                $teacher_grade = ((($teacher_grade / $students) / 5) * 100);
                            if ($behavior !== 0)
                                $behavior = ((($behavior / $students) / 5) * 100);
                            if ($classmaterial !== 0)
                                $classmaterial = ((($classmaterial / $students) / 5) * 100);
                            if ($recommendation !== 0)
                                $recommendation = ((($recommendation / $students) / 5) * 100);
                            echo "Teaching Quality : " . $quality . "%" . "<br>"
                            . "Teacher Attendance : " . $teacher_attendance . "%" . "<br>" .
                            "Teacher Grading : " . $teacher_grade . "%" . "<br>" .
                            "Teacher's Behavior : " . $behavior . "%" . "<br>" .
                            "Class Material : " . $classmaterial . "%" . "<br>" .
                            "Recommendation : " . $recommendation . "%";
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>

    <?php
    require 'footer.php';
}
?>