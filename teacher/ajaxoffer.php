

<?php

$attendance = $_POST['attendance'];
//    $attendance = intval($attendance);
$tname = $_POST['tname'];
$studentid = $_POST['studentid'];
//    $studentid = intval($studentid);
require '../dbcon.php';
$query = "select * from '$tname' where 'studentid'= $studentid";

$result = $conn->query($query);
$row = $result->fetch_assoc();
$present = $row['present'];
$absent = $row['absent'];
$totalclass = $row['totalclass'];
if ($attendance === 1) {
    $attendance = $attendance + $present;
} else {
    $absent = $absent . ',' . $date;
}
$query = "UPDATE " . $tname . " SET 'totalclass' = " . $totalclass . ", 'present' =" . $present . ", 'absent' = '" . $absent . ",'lastupdate'='"
        . $date . "' WHERE 'studentid'='" . $studentid . "'";

if ($conn->query($query) === TRUE)
    echo "attendance for " . $studentid . " updated";
else
    echo "attendance not updated";
?>