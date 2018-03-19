<?php if(!isset($_SESSION)) session_start(); ?>

<h1 class="text-center">Teacher Panel </h1>
<br>

<?php
require '../dbcon.php';
$teacherid =$_SESSION['user'];
$sql="select * from teacherdetails where teacherid ='$teacherid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
?>
<table class="table table-responsive">
    
    <tr>
        <td>Full Name </td>
        <td>:</td>
        <td>         
            <?php echo $row['name'];?>
        </td>
    </tr>
    <tr>
        <td>Designation </td>
        <td>:</td>
        <td>         
            <?php echo $row['position'];?>
        </td>
    </tr>
    <tr>
        <td>Department </td>
        <td>:</td>
        <td>         
            <?php echo $row['department'];?>
        </td>
    </tr>
       
</table>

<?php 

if (!isset($_SESSION)){ session_start();}$_SESSION['link'] = "base.php" ?>