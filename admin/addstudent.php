
<?php
if (!isset($_SESSION))
    session_start();
$_SESSION['link'] = "addstudent.php";

require '../dbcon.php';

$query = "select deptid,deptname from departments;";
$result = $conn->query($query);
?>
<style>
    .alert-success {
        display: none;
    }
</style>
<!--db insert--> 
<div class="container-fluid">

    <form class="form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <!-- Form Name -->
            <h2 class="text-center"><b> Student Registration Form</b></h2><br>

            <!-- Student Name input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Student Name</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="name" placeholder="Full Name" class="form-control"  type="text" required>
                    </div>
                </div>
            </div>
            <!--Department input-->
            <div class="form-group"> 
                <label class="col-md-4 control-label">Department</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="department" class="form-control selectpicker" required>
                            <option>Select Department</option>
                            <?php while ($row = $result->fetch_assoc()) { ?>                            
                                <option value="<?php echo $row["deptid"]; ?>"><?php echo $row["deptname"]; ?></option>
                                <?php
                            }
                            ?>         
                        </select>
                    </div>
                </div>
            </div>
            <!--Student ID input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Student ID</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="id" placeholder="Student ID(Numeric value)" class="form-control" pattern="[0-9]{8}" title="For spring(01),year(18),rest serial(4digit)" type="text" required>
                    </div>
                </div>
            </div>
            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" >Password</label> 
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="password" title="Password (minimum 4 character )" pattern="{4,}" class="form-control"  type="password" required>
                    </div>
                </div>
            </div>
            <!--Email input--> 
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" required>
                    </div>
                </div>
            </div>
            <!-- Contact No input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Contact No.</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="contact" title="880***********" pattern="[0-9]{13}" class="form-control" type="tel" required>
                    </div>
                </div>
            </div>
            <!-- Semester input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Admission Semester</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <select name="semester" class="form-control selectpicker" required>
                            <option>Select Admission Semester</option>                                                    
                            <option value="1">Spring</option>
                            <option value="2">Summer</option>
                            <option value="3">Fall</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Location input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Location</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="location" placeholder="Home Dstrict" class="form-control" type="text" required>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <button type="submit" class="btn btn-warning" name="submit" >
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                </div>
            </div>

        </fieldset>
    </form>
</div><!-- /.container -->
<?php
if (isset($_POST['submit'])) {
    require '../dbcon.php';

    $studentid = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $department = $_POST['department'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $year = date("Y");
    $semester = $_POST['semester'];
    $tablename = "s" . $studentid;

    $sql = "INSERT INTO `universitysystem`.`studentdetails`(`id`, `password`, `name`, `location`, `contact`, `department`, `admissionyear`, `admissionsemester`, `currentsemester`, `cgpa`)
            VALUES ('$studentid', '$password', '$name', '$location', '$contact','$department', '$year', '$semester',1, 0)";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully")</script>';
        $sql = "CREATE TABLE IF NOT EXISTS " . $tablename . " (
  `courseid` VARCHAR(15) NOT NULL,
  `coursename` VARCHAR(45) NOT NULL,
  `credit` TINYINT(1) NOT NULL,
  `grade` TINYINT(1) NOT NULL,
  `semester` TINYINT(1) NOT NULL,
  `year` YEAR NOT NULL)
    ENGINE = InnoDB";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("New table created successfully")</script>';
        } else {
            echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
        }
    } else {

        echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
    }
    $conn->close();
}
?>