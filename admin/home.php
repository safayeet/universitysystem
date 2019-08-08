<?php
//check if session is started if not session will be started
if (!isset($_SESSION)) {
    session_start();
}
$b = TRUE;

//check if there is any value in $_SESSION['role'] 
if (isset($_SESSION['role'])) {
//    check the user role
    if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== "admission") {
        $b = TRUE;
    } else {
        header('location:adminpanel.php');
    }
}
if ($b) {
    require 'header.php';
    ?>

    <div class="container-fluid">
        <div class="container jumbotron">

            <h1 class="text-center">Admin Login Panel</h1>
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
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        require '../dbcon.php';

        $query = "SELECT * FROM administration WHERE username='" . $username . "' and password='" . $password . "'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['role'] = $row['role'];
            $_SESSION['user'] = $username;
            mysqli_close($conn);
            echo '<script>alert("Logged In Successfully");(</script>';
            header('location:adminpanel.php');
        } else
            echo "<script>alert('user name and password not found')</script>";
    }
    ?>
    <?php
    require 'footer.php';
}
?>
