
<?php require 'header.php'; ?>

<h1 class="text-center">Class Attendance</h1>
<?php
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
//calling the dbcon files inside this file for fetching required configurations
require '../dbcon.php';
$offeredid = $_GET['offerid'];
$date = date('m/d');

if (isset($_POST['submit'])) {
    echo "today is " . $date . '<br>';
//    array variable
    $studentid = $_POST['studentid']; //array accepted
    $totalclass = $_POST['totalclass']; //array accepted
    $present = $_POST['present']; //array accepted
    $absent = $_POST['absent']; //array accepted
    $attendance = $_POST['attendance']; //array accepted
    $counter = $_POST['count'];

    for ($cnt = 0; $cnt < intval($counter); $cnt++) {
        $totalclass[$cnt] ++;
        if ($attendance[$cnt] === '1') {
            $tmp = (int) $present[$cnt];
            $present[$cnt] = $tmp + 1;
        } else {
            $absent[$cnt] = $absent[$cnt] . ',' . $date;
        }
        echo "<br>".$totalclass[$cnt]."<br>".$present[$cnt]."<br>".$absent[$cnt]."<br>".$date."<br>".$studentid[$cnt]."<br>";

        $sql = "update ".$offeredid." set totalclass='".$totalclass[$cnt]."', present='".$present[$cnt]."',            
          absent='".$absent[$cnt]."',lastupdate='".$date."' where studentid='".$studentid[$cnt]."'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['link']="offeredcourses.php";
            header("location:teacherpanel.php");
            echo $studentid[$cnt] . " Attendance updated<br>";
        } else {
            echo $studentid[$cnt] . " Attendance update error<br>";
        }
    }
} else {
    echo"not submitted <br>";
    $sql = "select * from $offeredid";
    $result = $conn->query($sql);
    ?>
    <div class="container">
        <form class="form-group" action="" method="post">
            <table class="table">
                <tr>
                    <th>Serial</th>
                    <th>Student ID</th>
                    <th>Student name</th>
                    <th>Attendance</th>
                </tr>
                <?php
                $counter = 0;
                while ($row = $result->fetch_assoc()) {
                    $counter++;
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><input  type='text' name='studentid[]' value='<?php echo $row['studentid']; ?>' ></td>
                        <td><?php echo $row['studentname']; ?></td>
                        <td>
                            <select name="attendance[]" class="form-control selectpicker">     
                                <option value="1">1</option>
                                <option value="0">0</option>           
                            </select>
                        </td>
                        <td style="display: none"> <input type='text' name='totalclass[]' value='<?php echo $row['totalclass']; ?>' ></td>
                        <td style="display: none"> <input type='text' name='present[]' value='<?php echo $row['present']; ?> ' ></td>
                        <td style="display: none"> <input  type='text' name='absent[]' value="<?php echo $row['absent']; ?>" ></td>
                    </tr>


                    <?php
                }
                ?>               
            </table>
            <input style="display: none"  type="text" name="count" value="<?php echo $counter; ?>" >
            <input type="submit" name="submit" value="submit" style="float: right">
        </form>
    </div>
<?php } ?>