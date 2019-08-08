<?php

//selects all departments
require '../dbcon.php';

//selects teacher details
if ($_POST['serial'] === '1') {
    $deptid = $_POST['deptid'];
    $query = "select teacherid,name from teacherdetails where department='" . $deptid . "';";
    $result = $conn->query($query);
    echo '<option value="">Select Teacher</option>';
    while ($row = $result->fetch_assoc()) {
        $sql="";
        echo "<option value='" . $row['teacherid'] . "'>" . $row['name'] . "</option>";
    }
    $conn->close();
}
//selects course by passed deptid
if ($_POST['serial'] === '2') {
    $deptid = $_POST['deptid'];
    $query = "select courseid,coursename from courselist where department='" . $deptid . "';";
    $result = $conn->query($query);
    echo '<option value="">Select a course</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['courseid'] . "'>" . $row['coursename'] . "</option>";
    }
    $conn->close();
}
//selects course credit hour
if ($_POST['serial'] === '3') {
    $courseid = $_POST['courseid'];
    $query = "select credithour from courselist where courseid='" . $courseid . "';";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo $row['credithour'];
    $conn->close();
}
//selects distinct semester
if ($_POST['serial'] === '4') {
    $deptid = $_POST['deptid'];
    $query = "select distinct currentsemester from studentdetails where department='" . $deptid . "';";
    $result = $conn->query($query);
    echo '<option value="">Select semester</option>';
    while ($row = $result->fetch_assoc()){
        echo "<option value='" . $row['currentsemester'] . "'>" . $row['currentsemester'] . "</option>";
    }
    $conn->close();
}
//counts the number of student
if($_POST['serial']==='5'){
    $semester = $_POST['semester'];
     $deptid = $_POST['deptid'];
    $query = "SELECT * FROM studentdetails where department='" . $deptid . "'and currentsemester=" . $semester . ";";
    $result = $conn->query($query);
    $row = $result->num_rows;
    echo $row;
    $conn->close();
}
?>
