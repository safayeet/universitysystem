<?php
//will start session if it's not started
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
} else {
    require 'header.php';

//storing session variable user value in teacherid variable
    $admin = $_SESSION['user'];
//calling the dbcon files inside this file for fetching required configurations
    require '../dbcon.php';
    ?>
    <style>
        .col-sm-8 tr th,.col-sm-4 tr th{
            border-top: unset;
        }
    </style>
    <div class="container">
    <div class="col-sm-7">
        <br>
        <h1 class="text-center">Admin Profile</h1>
        <br>
        <table class="table table-responsive">
            <?php
            $sql = "select * from administration where username = '$admin'";
            $result1 = $conn->query($sql);
            if ($row1 = $result1->fetch_assoc()) {
//                echo "<br> paise";
                ?>
                <tr>
                    <th>Name</th>
                    <th>:</th>
                    <th><?php echo strtoupper($row1['name']); ?></th>
                </tr>
                <tr>
                    <th>Position</th>
                    <th>:</th>
                    <th><?php echo strtoupper($row1['role']); ?></th>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>:</th>
                    <th><?php echo strtoupper($row1['email']); ?></th>
                </tr>
               
               
                <tr>
                    <th>Username</th>
                    <th>:</th>
                    <th><?php echo $row1['username']; ?></th>
                </tr>
                <tr>
                    <th>PassWord</th>
                    <th>:</th>
                    <th><?php echo $row1['password']; ?></th>
                </tr>
                <tr>
                    <th>Contact No</th>
                    <th>:</th>
                    <th><?php echo $row1['phone']; ?></th>
                </tr>
                <tr>
                    <th>Location</th>
                    <th>:</th>
                    <th><?php echo $row1['location']; ?></th>
                </tr>

            <?php } else {
                echo $conn->error;
                ?>
                <h1 class="text-center text-danger">No Data Found</h1>
            <?php } ?>

        </table>
    </div>
    </div>

<?php require 'footer.php';} ?>