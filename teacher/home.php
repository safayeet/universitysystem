<?php
require 'header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
//        echo"<script>alert('You must login as a Teacher to access.You will be redirected to your " . $_SESSION['link'] . " panel within 5 seconds');</script>";
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'student')
            header("location:../student/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
    }
    ?>
    <div class="container-fluid">
        <div class="container jumbotron">

            <h1 class="text-center">Teacher Login Panel</h1>
            <form action="home.php" method="POST" >
                <div class="form-group">
                    <label for="username">UserName:</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>

                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control" id="pwd">
                </div>

                <button type="submit" class="btn btn-success" name="submit">Submit</button>

            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        require '../dbcon.php';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $query = "SELECT * FROM teacherdetails WHERE teacherid='" . $username . "' and password='" . $password . "'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['role'] = 'teacher';
                $_SESSION['user'] = $username;
                mysqli_close($conn);
                echo '<script>alert("Logged In Successfully");(</script>';
                header('location:teacherpanel.php');
            } else
                echo "user name and password not found<br>" . $username . "<br>" . $password;
        }
    }
    ?>
    <?php
    require 'footer.php';
}else {
    header('location:teacherpanel.php');
}
?>
