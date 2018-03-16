
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
                        <input  name="name" placeholder="Full Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!--Department input-->
            <div class="form-group"> 
                <label class="col-md-4 control-label">Department</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="department" class="form-control selectpicker">
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
                        <input  name="id" placeholder="Student ID(Numeric value)" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" >Password</label> 
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="password" placeholder="Password (minimum 6 character )" class="form-control"  type="password">
                    </div>
                </div>
            </div>
            <!--Email input--> 
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!-- Contact No input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Contact No.</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="contact" placeholder="+880***********" class="form-control" type="tel">
                    </div>
                </div>
            </div>
            <!-- Semester input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Admission Semester</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="semester" placeholder="Enter Semester" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <!-- Location input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Location</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="location" placeholder="Home Dstrict" class="form-control" type="text">
                    </div>
                </div>
            </div>
            
            <!--image upload
            <div class="form-group">
                <label class="col-md-4 control-label">Profile Picture</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                        <input name="image" placeholder="Proile Picture" class="form-control" type="file">
                    </div>
                </div>
            </div>-->

            <!-- Success message -->
            <!--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>-->

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
//    $image = $_FILES['image']['name'];
//    $target = "upload/" . basename($image);
//    $sql = "INSERT INTO `studentdetails`(`id`, `password`, `name`, `location`, `contact`, `admissionyear`, `admissionsemester`, `currentsemester`, `cgpa`, 'imagename')
//            VALUES ('$studentid', '$password', '$name', '$location', '$contact', '$year', '$semester','$semester', 0,'$image')";
    $sql = "INSERT INTO `studentdetails`(`id`, `password`, `name`, `location`, `contact`, `admissionyear`, `admissionsemester`, `currentsemester`, `cgpa`)
            VALUES ('$studentid', '$password', '$name', '$location', '$contact', '$year', '$semester',2, 0)";
    if ($conn->query($sql) === TRUE) {

//        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
//            echo '<script>alert("Image uploaded successfully")</script>';
//        } else {
//            echo '<script>alert("Failed to upload image")</script>';
//        }

        $_SESSION['link'] = 'viewstudent.php';
        header('location:adminpanel.php');
        echo '<script>alert("New record created successfully")</script>';
    } else {

        echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
    }
    $conn->close();
}
?>