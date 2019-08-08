<?php
require 'header.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';
//check user role..if TEACHER then let access else return to login page
if ($_SESSION['role'] !== 'teacher') {
    header('location:home.php');
} else {

//course offering id 
    $offeredid = $_GET['offerid'];
//    date of execution
    $date1 = date('m/d');

//when new assignment is created
    if (isset($_POST['submit'])) {
//        assignment last submission date
        $date2 = date('m/d', strtotime($_POST['date']));
//assignment details
        $assignment = $_POST['assignment'];
//        assignment creating query
        $sql = "insert into assignment (ofrid,assignment,lastsubmission,declarationdate) "
                . "values ('$offeredid','$assignment','$date2','$date1')";
//        check query execution
        if ($conn->query($sql)) {
            echo "<script>alert('Assignment assigned');</script>";
//            updating the offeredcourse table assignment status
            $sql = "update offeredcourse set assignmentstatus='1' where offerid='" . $offeredid . "'";
            if ($conn->query($sql)) {
//             echo "<br> assignment status updated";
//             
                //create notice for the offering
                $message = "Dear, you have an assignment which must be submitted by " . $date2 . " Otherwise you will not be able to submit.";
//notice destroy date
                $destroy = date('m/d', strtotime($date2 . '+1 days'));
                echo "<script>alert('" . $message . " on " . $date2 . "  will be destroyed on" . $destroy . "')</script>";
                $sql = "INSERT INTO `notice`( `noticeto`, `noticefrom`, `message`, `noticedate`, `destroydate`)
                   VALUES ('" . $offeredid . "','teacher','$message','$date1','$destroy')";


                if ($conn->query($sql)) {
                    echo "<script>alert('New notice enetered " . $message . "')</script>";
                } else {
                    echo "<script>alert('Error occured in inserting the notive " . $message . " at " . $date . " <br>"
                    . $conn->error . "')</script>";
                }


                header("location:teacherpanel.php");
            } else {
                echo "there was an error" . $conn->error;
            }
        } else {
            echo "there was an error" . $conn->error;
        }
    }
//    when old assignment is deleted
    if (isset($_POST['delete'])) {
//        query for deleting the assignment 
        $sql = "DELETE FROM `assignment` WHERE ofrid='" . $_GET['offerid'] . "'";
//        executing the delete query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Assignment deleted')</script>";
//            query for deleting the notice
            $sql = "DELETE FROM `notice` WHERE noticeto='" . $_GET['offerid'] . "' and noticefrom='teacher'";
//            execute the query
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Notice deleted')</script>";
//                update the offered course table assignment status
                $sql = "UPDATE `offeredcourse` SET `assignmentstatus`=0 WHERE `offerid`='" . $_GET['offerid'] . "'";
//                execute the query
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('updated offered course')</script>";
                } else {
                    echo "<script>alert('Error occured in updating the offercourse <br>"
                    . $conn->error . "')</script>";
                }
            } else {
                echo "<script>alert('Error occured in deleting the notice <br>"
                . $conn->error . "')</script>";
            }
        } else {
            echo "<script>alert('Error occured in deleting the assignment <br>"
            . $conn->error . "')</script>";
        }
    }
//    count assignment
    $sql = "select count(*) from assignment where ofrid='$offeredid'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    if ($row[0] > 0) {
        echo "<h2 class='text-danger'>You have already assigned an assignment please wait until the submission date is expired</h2>";
        $sql = "select * from assignment where ofrid='$offeredid'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            ?>
            <!--preview old assignments-->
            <div class="container">
                <form class="form-group" action="" method="post">
                    <table class="" style="width: 100%">
                        <th class="text-center"><br><h3>ASSIGNMENT</h3></th>
                        <tr>
                            <td>Assignment Question</td>
                            <td>:</td>
                            <td><textarea class="form-control" name="assignment"><?php echo $row['assignment']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Assignment Last Submission Date</td>
                            <td>:</td>
                            <td><b><?php echo date('d M', strtotime($row['lastsubmission'])); ?></b></td>
                        </tr>     
                        <tr>
                            <td>Assignment Declaration Date</td>
                            <td>:</td>
                            <td><b><?php echo date('d M', strtotime($row['declarationdate'])); ?></b></td>
                        </tr>     
                    </table>
                    <br>
                    <!--<input class="btn btn-warning" type="submit" name="update" value="Update" style="float: right">-->
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete" style="float: right;margin-right: 5px">
                </form>
            </div>
            <?php
        }
    } else {
        ?>
        <!--styling for table-->
        <style>
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                border-top: 1px solid white;
            }
        </style>
        <!--set new assignment-->
        <div class="container">
            <form class="form-group" action="" method="post">
                <table class="table" style="width: 100%">
                    <th class="text-center">ASSIGNMENT</th>
                    <tr>
                        <td>Assignment Question</td>
                        <td>:</td>
                        <td><textarea class="form-control" name="assignment"></textarea></td>
                    </tr>
                    <tr>
                        <td>Assignment Submission Date</td>
                        <td>:</td>
                        <td><input type="date" name="date" min="<?php echo date("Y-m-d"); ?>" max="<?php
//                        $month=date("m");
//                        $year=date("Y");
//                        if(intval($month)<5)$month=4;
//                        else if(intval($month)<9)$month=8;
//                        else if(intval($month)<13)$month=12;
//                        
//                        $date=date("Y-m-d", strtotime($month."/"."05/".$year));
//                        echo $date;
                        ?>" required></td>
                    </tr> 
<!--                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">*Can't set assignments after 5th of the last month of the semester*</td>
                    </tr>-->
                </table>
                <br>
                <input class="btn btn-success" type="submit" name="submit" value="Assign" style="float: right">
            </form>
        </div>
        <?php
    }
}
?>