<h1 class="text-center">Add / EDIT Teacher Details</h1>

<?php
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['link'] = "addteacher.php";

require '../dbcon.php';

$query = "select deptid,deptname from departments;";
$result = $conn->query($query);
?>


<div class="container">
    <form class="form-horizontal" action=" " method="post"  id="contact_form">
        <fieldset>
            <!-- Form Name -->
            <h2 class="text-center"><b>Teacher Registration Form</b></h2><br>

            <!-- Teacher Name input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Teacher Name</label>  
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
            <!--Teacher ID input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Teacher ID</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="id" placeholder="Teacher ID" class="form-control"  type="text">
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
            <!--position input--> 
            <div class="form-group">
                <label class="col-md-4 control-label">Position</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="position" placeholder="Position" class="form-control"  type="text">
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
            <!-- Maximum Credit hour input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Credit Allowance</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="maxcredit" placeholder="Maximum Credit" class="form-control" type="tel">
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


            <!-- Select Basic -->

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
</div>

<?php
if (isset($_POST['submit'])) {
    $teachername = $_POST['name'];
    $deptid = $_POST['department'];
    $teacherid = $_POST['id'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $contact = $_POST['contact'];
    $maxcredit = $_POST['maxcredit'];
    $location = $_POST['location'];

    $sql = "INSERT INTO `teacherdetails`(`teacherid`, `password`, `name`, `location`, `contact`, `department`, `maxcredit`, `takencredit`, `position`)
VALUES ('$teacherid','$password','$teachername','$location',$contact,'$deptid',$maxcredit,0,'$position')";
    if ($conn->query($sql) == TRUE) {
        echo '<script>alert("New record created successfully")</script>';
    } else {
        echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
    }
}
$conn->close();
?>



