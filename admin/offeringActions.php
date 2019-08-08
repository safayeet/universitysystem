<?php

if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
} else {

    require '../dbcon.php';
//    sending warning about completing all course related activities to teacher and student
    if (isset($_GET['warn'])) {
        $offeredid = htmlentities(mysqli_real_escape_string($conn, trim($_GET['warn'])));
        $message = "Please complete all course activities within 25th instant otherwise all your performance details will be lost and you may "
                . "need to retake the course";
        $date = date('m/d');
        $destroy = date('m/d', strtotime($date . '+7 days'));

        $sql = "INSERT INTO `notice`( `noticeto`, `noticefrom`, `message`, `noticedate`, `destroydate`)
                   VALUES ('" . $offeredid . "','admin','$message','$date','$destroy')";
        if ($conn->query($sql)) {
            echo "<script>alert('New notice enetered " . $message . "')</script>";
            header("location:viewoffering.php");
        } else {
            echo "<script>alert('Error occured in inserting the notive " . $message . " at " . $date . " <br>"
            . $conn->error . "')</script>";
        }
    }
//    deleting offered course without saving any data
    if (isset($_GET['delofr'])) {
        $offeredid = htmlentities(mysqli_real_escape_string($conn, trim($_GET['delofr'])));

        $sql = "drop table $offeredid";
        if ($conn->query($sql)) {
            echo '<script>alert("Removed offering table")</script>';
            $sql = "delete from `offeredcourse` where offerid = '$offeredid'";
            if ($conn->query($sql)) {
                echo '<script>alert("Removed offering")</script>';
                $sql = "delete from notice where noticeto = '$offeredid' and noticefrom= 'system'";
                if ($conn->query($sql)) {
                    echo '<script>alert("Removed notice")</script>';
                    header("location:viewoffering.php");
                } else {
                    echo '<script>alert("' . $conn->error . '")</script>';
                }
            } else {
                echo '<script>alert("' . $conn->error . '")</script>';
            }
        } else {
            echo '<script>alert("' . $conn->error . '")</script>';
        }
    }
//    end the course for the semester and store the details
    if ($_GET['end']) {
        $quality = $teacher_attendance = $teacher_grade = $behavior = $classmaterial = $recommendation = $students = 0;
        $offeredid = htmlentities(mysqli_real_escape_string($conn, trim($_GET['end'])));
        $sql = "select * from offeredcourse where offerid='$offeredid'";
        if ($r = mysqli_query($conn, $sql)) {
            $offerdetails = mysqli_fetch_assoc($r);
            echo "course instructor " . $offerdetails['teacher'] . "<br>";
//           fetch feedbacks and calculate them
            $sql1 = "select feedback from $offeredid";
            if ($f = mysqli_query($conn, $sql1)) {
                while ($row1 = mysqli_fetch_array($f)) {
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

//count average feedback of a specific course                
                if ($quality !== 0)
                    $quality = floatval($quality / $students);
                if ($teacher_attendance !== 0)
                    $teacher_attendance = floatval($teacher_attendance / $students);
                if ($teacher_grade !== 0)
                    $teacher_grade = floatval($teacher_grade / $students);
                if ($behavior !== 0)
                    $behavior = floatval($behavior / $students);
                if ($classmaterial !== 0)
                    $classmaterial = floatval($classmaterial / $students);
                if ($recommendation !== 0)
                    $recommendation = floatval($recommendation / $students);
//                fetch teacher feedbackss
                $sql1 = "SELECT feedback,lastfeedback FROM `teacherdetails` where teacherid='" . $offerdetails['teacher'] . "'";
                if ($t = mysqli_query($conn, $sql1)) {
//                    value calculation for feedback
                    $feedbackzz = mysqli_fetch_array($t);
                    $average = explode(",", $feedbackzz[0]);
                    if ($feedbackzz[1] !== '')
                        $last = explode(",", $feedbackzz[1]);

                    $average[0] = (floatval($average[0]) + $quality) / 2;
                    $average[1] = (floatval($average[1]) + $teacher_attendance) / 2;
                    $average[2] = (floatval($average[2]) + $teacher_grade) / 2;
                    $average[3] = (floatval($average[3]) + $behavior) / 2;
                    $average[4] = (floatval($average[4]) + $classmaterial) / 2;
                    $average[5] = (floatval($average[5]) + $recommendation) / 2;

                    if (intval($last[0]) > 0) {
                        $last[0] = (floatval($last[0]) + $quality) / 2;
                        $last[1] = (floatval($last[1]) + $teacher_attendance) / 2;
                        $last[2] = (floatval($last[2]) + $teacher_grade) / 2;
                        $last[3] = (floatval($last[3]) + $behavior) / 2;
                        $last[4] = (floatval($last[4]) + $classmaterial) / 2;
                        $last[5] = (floatval($last[5]) + $recommendation) / 2;
                    } else {
                        $last[0] = $quality;
                        $last[1] = $teacher_attendance;
                        $last[2] = $teacher_grade;
                        $last[3] = $behavior;
                        $last[4] = $classmaterial;
                        $last[5] = $recommendation;
                    }
                    $av = implode(",", $average);
                    $lst = implode(",", $last);
                    $sql = "UPDATE `teacherdetails` SET  `feedback`='$av', `lastfeedback`='$lst',`takencredit`=0 where teacherid='" . $offerdetails['teacher'] . "'";
                    if (mysqli_query($conn, $sql)) {
                        echo "feedback updated successfully";
                    } else
                        echo $conn->error;
//                    }deleting every notice and data related to the course
                    $s = "drop table $offeredid";
                    if (mysqli_query($conn, $s)) {
                        $del = "delete from offeredcourse where offerid = '$offeredid'";
                        if (mysqli_query($conn, $del)) {
                            $not = "DELETE FROM `notice` WHERE noticefrom='$offeredid' or noticeto='$offeredid'";
                            if (mysqli_query($conn, $not)) {
                                echo "cleared everything about the offered course";
                            } else {
                                echo "6" . $conn->error;
                            }
                        } else {
                            echo "5" . $conn->error;
                        }
                    } else {
                        echo "4" . $conn->error;
                    }
                } else {
                    echo '3' . $conn->error;
                }
            } else {
                echo '2' . $conn->error;
            }
//            update students semester
            $s = "select * from offeredcourse";
            if ($z = mysqli_query($conn, $s)) {
                if (mysqli_num_rows($z) == 0) {
                    $sql = "UPDATE `studentdetails` SET `currentsemester`=`currentsemester`+1 where `sgpa`>0";
                    if (mysqli_query($conn, $sql)) {
                        echo"<br>updated student details<br>wait 5 seconds you'll be redirected";
                        header("refresh=5;url=home.php");
                    } else
                        echo "4" . $conn->error;
                } else
                    echo "3" . $conn->error;
            }else {
                echo "2" . $conn->error;
            }
        } else {
            echo '<script>alert("1' . $conn->error . '")</script>';
        }
    }
}
?>

