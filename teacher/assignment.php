<?php
require 'header.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';
$offeredid = $_GET['offerid'];
$date1 = date('m/d');
if (isset($_POST['submit'])) {
    $date2 = date('m/d', strtotime($_POST['date']));
    $assignment = $_POST['assignment'];
    $sql="insert into assignment (ofrid,assignment,lastsubmission,declarationdate) values ('$offeredid','$assignment','$date2','$date1')";
    if($conn->query($sql)){
//        echo "assignment updated successfully";
        $sql="update offeredcourse set assignmentstatus='1' where teacher='".$_SESSION['user']."'";
         if($conn->query($sql)){
//             echo "<br> assignment status updated";
            header("location:adminpanel.php");
         }else {
        echo "there was an error".$conn->error;
    }
    }else {
        echo "there was an error".$conn->error;
    }
}
?>

<div class="container">
    <form class="form-group" action="" method="post">
        <table class="" style="width: 100%">
            <th class="text-center">ASSIGNMENT</th>
            <tr>
                <td>Assignment Question</td>
                <td>:</td>
                <td><textarea class="form-control" name="assignment"></textarea></td>
            </tr>

            <tr>
                <td>Assignment Submission Date</td>
                <td>:</td>
                <td><input type="date" name="date"></td>
            </tr>     
        </table>
        <br>
        <input class="btn btn-success" type="submit" name="submit" value="Assign" style="float: right">
    </form>
</div>