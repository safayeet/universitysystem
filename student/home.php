<?php
require 'header.php';

if (!empty($_SESSION['role'])) {
    header('location:studentpanel.php');
} else {
    ?>


    <div class="container-fluid">
        <div class="container jumbotron">

            <h1 class="text-center">Student Login Panel</h1>
            <form action="home.php" method="POST" >
                <div class="form-group">
                    <label for="username">Student ID:</label>
                    <input type="text" class="form-control" name="id" id="username">
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
        $username = $_POST['id'];
        $password = $_POST['password'];
        require '../dbcon.php';

        $query = "SELECT * FROM studentdetails WHERE id='" . $username . "' and password='" . $password . "'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['role'] = "student";
            $_SESSION['user'] = $username;
            mysqli_close($conn);
            header('location:studentpanel.php');
        } else
            echo "user name and password not found<br>" . $username . "<br>" . $password;
    }
}
?>
<?php require 'footer.php'; ?>
