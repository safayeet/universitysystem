<h1 class="text-center">Add / EDIT Course Details</h1>

<?php
if (!isset($_SESSION))
    session_start();
$_SESSION['link'] = "addcourse.php";


require '../dbcon.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "select deptid,deptname from departments;";
$result = $conn->query($query);
?>
<div class="container-fluid">

    <form class="form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <!-- Course ID input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Course ID</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                        <input  name="id" placeholder="Course ID" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!-- Course Name input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Course Name</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <input  name="name" placeholder="Course Name" class="form-control"  type="text">
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

            <!--Credit Hour input--> 
            <div class="form-group">
                <label class="col-md-4 control-label">Credit Hour</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <input name="credithour" placeholder="Credit Hour" class="form-control"  type="tel">
                    </div>
                </div>
            </div>


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

    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $credithour = $_POST['credithour'];

    $query = "INSERT INTO `courselist`(`courseid`, `coursename`, `credithour`, `department`) VALUES ('$id','$name',$credithour,'$department')";
    if ($conn->query($query) === TRUE) {
        $_SESSION['link'] = 'viewcourses.php';
        header('location:adminpanel.php');
        echo '<script>alert("New record created successfully")</script>';
    } else {
        echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '")</script>';
    }
    $conn->close();
}
?>