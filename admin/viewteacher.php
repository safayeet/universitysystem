<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
} else {

    require'header.php';
    require '../dbcon.php';

    if (isset($_GET['delid'])) {
        $deptid = $_GET['delid'];
        $sql = "DELETE FROM teacherdetails WHERE teacherid = '$deptid'";
        if ($conn->query($sql)) {
            echo "<script>alert('teacher details deleted')</script>";
        } else
            echo"<script>alert('teacher details not deleted" . $conn->error . "')</script>";
    }
    ?>
    <div class="container">
        <h2 class="text-center">Teacher's List</h2>
        <table class="table">
            <tr>
                <th>Teacher ID</th>
                <th>Password</th>
                <th>Teacher Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Department</th>
                <th>Maximum Credit Allowance</th>
                <th>Taken Credit</th>
                <th>Position</th>
                <th>Average Feedback</th>
                <th>Last Feedback</th>
                <th>Action</th>
            </tr>


            <?php
            $query = "select * from teacherdetails;";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['teacherid']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['maxcredit']; ?></td>
                    <td><?php echo $row['takencredit']; ?></td> 
                    <td><?php echo $row['position']; ?></td>
                    <td>
                        <?php if ($row['feedback'] === '' || $row['feedback'] === NULL) { ?>
                            <p><b>No Feedback</b></p>
                            <?php
                        } else {
                            $total = 0;
                            $feedbackarr = explode(' ', $row['feedback']);
                            foreach ($feedbackarr as $value) {
                                $total = $total + intval($value);
                            }
                            $feedback = floatval(($total / 5) * 100);
//                    echo $feedback . "<br>";
                            if ($feedback > 89)
                            {echo"<b>Excellent Teacher</b>";}
                            else if ($feedback > 79)
                            {echo"<b>Very Good</b>";}
                            else if ($feedback > 69)
                            {   echo "<b> Good</b>";}
                            else
                            { echo " <b>Poor</b>";}
                            
                            $rec=(floatval(end($feedbackarr))/5)*100;
                            echo "<br>Recommended by : ".$rec."%";
                        }
//deletes file from folder
//                $path = '../assignment/certificate.pdf';
//                unlink($path);
                        ?>
                    </td>
                    <td>
                        <?php if ($row['lastfeedback'] === '' || $row['lastfeedback'] === NULL) { ?>
                            <p><b>No Feedback</b></p>
                            <?php
                        } else {
                            $total = 0;
                            $feedbackarr = explode(' ', $row['lastfeedback']);
                            foreach ($feedbackarr as $value) {
                                $total = $total + intval($value);
                            }
                            $feedback = floatval(($total / 5) * 100);
//                    echo $feedback . "<br>";
                            if ($feedback > 89)
                                echo"<b>Excellent Teacher</b>";
                            else if ($feedback > 79)
                                echo"<b>Very Good</b>";
                            else if ($feedback > 69)
                                echo "<b> Good</b>";
                            else
                                echo " <b>Poor</b>";
                        }
//deletes file from folder
//                $path = '../assignment/certificate.pdf';
//                unlink($path);
                        ?>
                    </td>

                    <td><a class="btn btn-danger" href="viewteacher.php?delid=<?php echo $row['teacherid']; ?>">Delete</a></td> 
                </tr>

                <?php
            }
            $conn->close();
            ?>

        </table>
    </div>
    <?php
    require 'footer.php';
}
?>

