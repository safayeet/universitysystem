<script type="text/javascript">
    $(document).ready(function () {
        $('#courseid').html('<option value="">Select department first</option>');
        $('#teacherid').html('<option value="">Select course first</option>');
        $('#semester').html('<option value="">Select semester</option>');
    });
    function fetch_course(deptid) {
        $.ajax({
            type: 'post',
            url: 'ajaxoffer.php',
            data: {
                serial: 2,
                deptid: deptid
            },
            success: function (response) {
                document.getElementById("courseid").innerHTML = response;
            }
        });
    }
    function fetch_credithour(courseid) {
        $.ajax({
            type: 'post',
            url: 'ajaxoffer.php',
            data: {
                serial: 3,
                courseid: courseid
            },
            success: function (response) {
                document.getElementById("credithour").placeholder = response;
                fetch_teacher();
            }
        });
    }
    function fetch_teacher() {

        $.ajax({
            type: 'post',
            url: 'ajaxoffer.php',
            data: {
                serial: 1,
                deptid: document.getElementById("coursedept").value
            },
            success: function (response) {
                document.getElementById("teacherid").innerHTML = response;
            }
        });
    }
    function fetch_student(deptid) {
        $.ajax({
            type: 'post',
            url: 'ajaxoffer.php',
            data: {
                serial: 4,
                deptid: deptid
            },
            success: function (response) {
                document.getElementById("semester").innerHTML = response;
            }
        });
    }
    function fetch_totalstudent(semester) {
        $.ajax({
            type: 'post',
            url: 'ajaxoffer.php',
            data: {
                serial: 5,
                semester: semester,
                deptid: document.getElementById("studentdept").value
            },
            success: function (response) {
                document.getElementById("totalstudent").value = response;
            }
        });
    }
</script>

<h1 class="text-center">Add / EDIT Offered Course Details</h1>

<?php
if (!isset($_SESSION))
    session_start();
$_SESSION['link'] = "offeredcourse.php";
require '../dbcon.php';
?>
<div class="container">
    <form class="form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>

            <!--Course Department input-->
            <div class="form-group"> 
                <label class="col-md-4 control-label">Course Department</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="coursedept" class="form-control selectpicker" id="coursedept" onchange="fetch_course(this.value)">
                            <option value="">Select Department</option>
                            <?php
                            $query = "select deptid,deptname from departments;";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_assoc()) {
                                ?>                            
                                <option value="<?php echo $row["deptid"]; ?>"><?php echo $row["deptname"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--Course input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Course Name</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="course" class="form-control selectpicker" id="courseid" onchange="fetch_credithour(this.value)">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!--credit hours-->
            <div class="form-group">
                <label class="col-md-4 control-label">Credit Hour</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <input name="credithour" placeholder="credit hour" class="form-control" id="credithour" type="text" disabled>
                    </div>
                </div>
            </div>
            <!--course instructor-->
            <div class="form-group">
                <label class="col-md-4 control-label">Course Instructor</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="teacher" class="form-control selectpicker" id="teacherid" onchange="fetch_department()">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!--Student Department input-->
            <div class="form-group"> 
                <label class="col-md-4 control-label">Student Department</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="studentdept" class="form-control selectpicker" id="studentdept" onchange="fetch_student(this.value)">
                            <option value="">Select Department</option>
                            <?php
                            $query = "select deptid,deptname from departments;";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_assoc()) {
                                ?>                            
                                <option value="<?php echo $row["deptid"]; ?>"><?php echo $row["deptname"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--student semester-->
            <div class="form-group">
                <label class="col-md-4 control-label">Student Semester</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="semester" class="form-control selectpicker" id="semester" onchange="fetch_totalstudent(this.value)">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!--Number of Students-->
            <div class="form-group">
                <label class="col-md-4 control-label">Number of Students</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <input name="totalstudent" placeholder="Total Students" class="form-control" id="totalstudent" type="text" disabled>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
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
</div>
<?php
if (isset($_POST['submit'])) {
    $course = $_POST['course'];
    $teacher = $_POST['teacher'];
    $studentdept = $_POST['studentdept'];
    $semester = $_POST['semester'];
    $offeredid = "ofr";
    $query = "select count(offerid) from offeredcourse";
    $result = $conn->query($query);
    $result = $result->fetch_assoc();
    $result = intval($result['count(offerid)']);
    if ($result > 0) {
        $result ++;
        $offeredid .= $result;
    } else {
        $offeredid .= 1;
    }
    $query = "INSERT INTO `offeredcourse`( `offerid`, `courseid`, `semester`, `department`, `teacher`)
            VALUES ('$offeredid','$course',$semester,'$studentdept','$teacher')";
    if ($conn->query($query) === TRUE) {
        echo '<script>alert("New record created successfully")</script>';

        //        create offered course table for course tracking attendance,marks 
        $query = "CREATE TABLE IF NOT EXISTS " . $offeredid . " (
  `studentid` INT NOT NULL,
  `studentname` VARCHAR(45) NOT NULL,
  `totalclass` INT NOT NULL DEFAULT 0,
  `present` INT NOT NULL DEFAULT 0,
  `absent` LONGTEXT NULL,
  `assignment` FLOAT NOT NULL DEFAULT 0,
  `first` FLOAT NOT NULL DEFAULT 0,
  `mid` FLOAT NOT NULL DEFAULT 0,
  `final` FLOAT NOT NULL DEFAULT 0,
  `grade` FLOAT NOT NULL DEFAULT 0,
  PRIMARY KEY (`studentid`))
ENGINE = InnoDB";
        if ($conn->query($query) === TRUE) {
            echo '<script>alert("New table created successfully")</script>';
            $query = "insert into " . $offeredid . "(`studentid`,`studentname`) select id,name from studentdetails where department='$studentdept' and currentsemester='$semester' ORDER BY 'id' ASC";
            if ($conn->query($query) === TRUE)
                echo '<script>alert("students added to the section")</script>';
            else
                echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
        } else {
            echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
        }
    } else {
        echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
    }


    $conn->close();
}
?>