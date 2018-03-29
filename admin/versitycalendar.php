
<?php
require '../dbcon.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== "admin") {
    header('location:home.php');
} else {
    $_SESSION['link'] = 'versitycalendar.php';

//    inserting new data in db
    if (isset($_GET['submit'])) {
//         echo "entered insert section<br>";
        $date = date('Y-m-d', strtotime($_GET['date']));
        $occasion = $_GET['occasion'];
        if ($_GET['vacation'] === '1')
            $vacation = 1;
        else if ($_GET['vacation'] === '0')
            $vacation = 0;
        if ($_GET['function'] === '1')
            $function = 1;
        else if ($_GET['function'] === '0')
            $function = 0;

//echo $date . " " . $occasion . " " . $vacation . " " . $function;
//inserted new occasion in the database 
        $sql = "insert into versitycalendar (occasiondate,occasion,vacation,func) values ('$date','$occasion','$vacation','$function')";
        if ($conn->query($sql)) {
            echo "<script>alert('New Occasion enetered')</script>";

            $message = "Dear, you have an occasion on " . $date;
            if ($vacation === 1)
                $message = $message . ". Classes will be dismissed.";
            else
                $message = $message . ". Classes will be held.";
            if ($function === 1)
                $message = $message . " A function will be organized where you are invited";
            else
                $message = $message . " No function will be organized by the authority";
//            echo $message . " " . $date."<br>";
//            $date = ;
            echo $message . " " . $date;
            $sql = "insert into 'universitysystem'.'notice' ('noticeto','noticefrom','message','noticedate','destroydate') values ('everyone','system','$message','$date','".date('m/d', strtotime($date))."')";

            if ($conn->query($sql)) {
                echo "<script>alert('New notice enetered " . $message . "')</script>";
            } else {
                echo "<script>alert('Error occured in inserting the notive " . $message . " at " . $date . " <br>" . $conn->error . "')</script>";
            }
        } else {
            echo "<script>alert('Error occured in inserting the occasion " . $occasion . " at " . $date . " <br>" . $conn->error . "')</script>";
        }
    }
//    deleting data from db
    else if (isset($_GET['delete'])) {
//        echo "entered delete section<br>";
        $id = $_GET['delete'];
        $sql = "delete from versitycalendar where id=$id";
        if ($conn->query($sql)) {
            echo "<script>alert('Occasion deleted')</script>";
        } else {
            echo "<script>alert('Error occured in deleting the occasion " . $occasion . " at " . $date . " <br>" . $conn->error . "')</script>";
        }
    }
//    updating values in db
    else if (isset($_GET['submit1'])) {
//         echo "entered update section<br>";
        $date = date('Y-m-d', strtotime($_GET['date']));
        $occasion = $_GET['occasion'];
        $id = $_GET['id'];
        if ($_GET['vacation'] === '1')
            $vacation = 1;
        else if ($_GET['vacation'] === '0')
            $vacation = 0;
        if ($_GET['function'] === '1')
            $function = 1;
        else if ($_GET['function'] === '0')
            $function = 0;
//        echo $date . " " . $occasion . " " . $vacation . " " . $function . " " . $id;
//updating occasion in the database 
        $sql = "UPDATE versitycalendar SET occasion='$occasion',vacation=$vacation,func=$function where id=$id";
        if ($conn->query($sql)) {
            echo "<script>alert('Occasion Update')</script>";
        } else {
            echo "<script>alert('Error occured in updating the occasion " . $occasion . " at " . $date . " <br>" . $conn->error . "')</script>";
        }
    }
    ?>
    <script>
        $(document).ready(function () {
            $('#new').hide();
            $('#cancel').hide();
            $('#addnew').click(function () {
                $('#cancel').show();
                $('#new').show()();
            });
            $('#cancel').click(function () {
                $('#new').hide();
                $('#cancel').hide();
            });


        });
    </script>
    <div class="row">

        <div class="container">
            <?php
            if (isset($_GET['update'])) {
                $id = $_GET['update'];
                $sql = "select * from versitycalendar where id = $id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>

                <!--Form for updating values--> 
                <form class="form-group"  action="" method="get">
                    <p class="text-center">
                        ***<b class="text-danger">YEAR WILL BE STORED. SELECT THE DATES CORRECTLY</b>***<br>
                        Duplicate dates won't be accepted
                    </p>
                    <table class="table table-responsive">
                        <tr>
                            <th>Select Date</th>
                            <th>Occasion</th>
                            <th>Vacation</th>
                            <th>Function</th>
                            <th>Action</th>                        
                        </tr>
                        <tr>
                            <td><input type="date" name="date" value="<?php echo $row['occasiondate']; ?>" readonly></td>
                            <td><input type="text" name="occasion" pattern="[A-Z a-z]{5,70}" size="70" value="<?php echo $row['occasion']; ?>" title="Please Write the proper occasion within 5 to 70 character(A~Z,a-z, whitespace)" required></td>
                            <td> 
                                <select name="vacation" required>

                                    <option value="">Select</option>
                                    <option value="1"  <?php // if ($row['vacation'] === '1') echo "selected";    ?>>Yes</option>
                                    <option value="0" <?php // if ($row['vacation'] === '0') echo "selected";    ?> >No</option>
                                </select>
                            </td>
                            <td>
                                <select name="function" required>
                                    <option value="">Select</option>
                                    <option value="1" <?php // if ($row['func'] === '1') echo "selected";    ?>>Yes</option>
                                    <option value="0" <?php // if ($row['func'] === '0') echo "selected";    ?>>No</option>
                                </select>
                            </td>
                            <td style="display: none"><input type="text" name="id" value="<?php echo $id; ?>"></td>
                            <td><input class="btn btn-success" type="submit" value="submit" name="submit1"></td>
                        </tr>
                    </table>
                </form> 
                <!--form for inserting new occasion--> 
            <?php } else { ?>
                <br>
                <br>            
                <button class="btn btn-lg btn-info" id="addnew">Add new occation</button>
                <button class="btn btn-lg btn-danger" id="cancel">Cancel</button>
                <br>
                <br>
                <form class="form-group" id="new" action="" method="get">
                    <p class="text-center">
                        ***<b class="text-danger">YEAR WILL BE STORED. SELECT THE DATES CORRECTLY</b>***<br>
                        Duplicate dates won't be accepted
                    </p>
                    <table class="table table-responsive">
                        <tr>
                            <th>Select Date</th>
                            <th>Occasion</th>
                            <th>Vacation</th>
                            <th>Function</th>
                            <th>Action</th>                        
                        </tr>
                        <tr>
                            <td><input type="date" name="date" required></td>
                            <td><input type="text" name="occasion" pattern="[A-Z a-z]{5,70}" size="70" 
                                       title="Please Write the proper occasion within 5 to 70 character(A~Z,a-z, whitespace)" required></td>
                            <td> <select name="vacation" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select></td>
                            <td><select name="function" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select></td>
                            <td><input class="btn btn-success" type="submit" value="submit" name="submit"></td>
                        </tr>
                    </table>
                </form> 

            <?php } ?>

            <!--view the occasions to the user table-->
            <?php
            $sql = "select * from versitycalendar order by occasiondate ";
            $result = $conn->query($sql);
            ?>
            <table class="table table-responsive">
                <tr>
                    <th>Serial</th>
                    <th>Date</th>
                    <th>Occasion</th>
                    <th>Vacation</th>
                    <th>Function</th>
                    <th>Action</th>
                </tr>
                <?php
                $cnt = 0;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <th><?php echo ++$cnt; ?></th>
                        <th><?php echo date('jS M, Y', strtotime($row['occasiondate'])) ?></th>
                        <th><?php echo $row['occasion']; ?></th>
                        <th>
                            <?php
                            if ($row['vacation'] === '1')
                                echo "YES";
                            else
                                echo "NO";
                            ?>
                        </th>
                        <th>
                            <?php
                            if ($row['func'] === '1')
                                echo "YES";
                            else
                                echo "NO";
                            ?>
                        </th>                     
                        <th>
                            <a class="btn btn-warning" href="adminpanel.php?update=<?php echo $row['id'] ?>">UPDATE</a>
                            <a class="btn btn-danger" href="adminpanel.php?delete=<?php echo $row['id'] ?>">DELETE</a>
                        </th>                     
                    </tr>
                <?php } ?>
            </table>


        </div>
    </div>
<?php } ?>