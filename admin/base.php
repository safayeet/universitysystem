<?php
//calling database connection page
require '../dbcon.php';

$sql="select count(id) from studentdetails";
$result=$conn->query($sql);
$students=$result->fetch_array();
//echo $students[0]."<br>";

$sql="select count(deptid) from departments";
$result=$conn->query($sql);
$depts=$result->fetch_array();
//echo $depts[0];

$sql="select count(courseid) from  courselist";
$result=$conn->query($sql);
$courses=$result->fetch_array();
//echo $courses[0];

$sql="select count(teacherid)from  teacherdetails";
$result=$conn->query($sql);
$faculties=$result->fetch_array();
//echo $faculties[0];

?>

<h1 class="text-center">Admin Panel Home page </h1>
<br>
<table class="table table-responsive">
     <tr>
        <td>Total Departments</td>
        <td>:</td>
        <td><?php echo $depts[0]; ?></td>
    </tr>
    <tr>
        <td>Total Course</td>
        <td>:</td>
        <td><?php echo $courses[0];?></td>
    </tr>
    <tr>
        <td>Faculty Members</td>
        <td>:</td>
        <td><?php echo $faculties[0]; ?></td>
    </tr>
    <tr>
        <td>Total Students</td>
        <td>:</td>
        <td><?php echo $students[0];?></td>
    </tr>
   
    
</table>

<?php 

if (!isset($_SESSION)){ session_start();}$_SESSION['link'] = "home.php" ?>