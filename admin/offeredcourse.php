<h1 class="text-center">Add / EDIT Offered Course Details</h1>

<?php
if (!isset($_SESSION))
    session_start();
$_SESSION['link'] = "offeredcourse.php";

require '../dbcon.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}

$query = "select deptid,deptname from departments;";
$result = $conn->query($query);
?>
<div class="container">
    <form class="form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>

            <!--Course Name input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Course Name</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="name" placeholder="Full course name" class="form-control"  type="text">
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
            


            <!-- Success message -->
            <!--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>-->

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