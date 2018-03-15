<h1 class="text-center">Add / EDIT Offered Course Details</h1>

<?php if(!isset($_SESSION))session_start ();$_SESSION['link']="offeredcourse.php"?>"
. "
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

            <!--Course ID input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Student ID</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="id" placeholder="Course ID" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            
            <!--Department  input-->
            <div class="form-group"> 
                <label class="col-md-4 control-label">Department</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="department" class="form-control selectpicker">
                            <option>Select your Department/Office</option>
                            <option value="COMPUTER SCIENCE AND ENGINEERING">COMPUTER SCIENCE AND ENGINEERING</option>
                            <option value="Department of Agriculture">Department of Agriculture</option>
                        </select>
                    </div>
                </div>
            </div>

            
           
          


           

            <!-- Semester input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Semester</label>  
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="semester" placeholder="Enter offered for which semester" class="form-control" type="text">
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