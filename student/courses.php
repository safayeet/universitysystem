<?php
//including the header file
require 'header.php';
//check the user type
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
//    if role set than redirect the user to his own panel 
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../teacher/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
    }else{
        header("location:../index.php");
    }
}
//including the database configuration file
require '../dbcon.php';
$dept = $_SESSION['department'];
$semester = $_SESSION['semester'];
//storing session variable user value in teacherid variable

?>
<!--table container area-->
<div class="container">
<table class="table">
    <tr>
        <th>Course Code</th>
        <th>Instructor</th>
        <th>Assignment</th>
        <th>Course Performance</th>
        <th>Feedback</th>
    </tr>
    <?php
//   query for fetching course details from offered table
    $sql = "select * from offeredcourse where semester = '$semester' and department='$dept'";
//    executing the query
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <th><?php echo $row['courseid']; ?></th>
            <th><?php 
            $sql="select name from teacherdetails where teacherid='".$row['teacher']."'";
            $name= mysqli_query($conn, $sql);
            $x= mysqli_fetch_array($name);
            echo $x[0];
            ?></th>
            <th><a href=" <?php
                if ($row['assignmentstatus'] === '1') {
                    echo 'assignment.php?offerid=' . $row['offerid'];
                } else
                    echo "#"
                    ?>"
                   >
                       <?php
                       if ($row['assignmentstatus'] === '1') {                          
                           echo 'Submit Assignment';
                       } else
                           echo 'No Assignment';
                       ?>
                </a></th>
            <th><a href="coursedetails.php?offerid=<?php echo $row['offerid']; ?>">Course Details</a></th>
            <th>
              <?php 
              if($row['resultstatus']==='1'){
                $_SESSION['link'] = "viewresult.php";
                ?>
                <a href="viewresult.php?offerid=<?php echo $row['offerid'];?>">Click Here</a>
              <?php
              }else
              echo "<a href='#'>Not Available</a>"
              ?>
            </th>
        </tr>
    <?php } ?>

</table>
</div>
