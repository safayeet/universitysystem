<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
} else {

    require'header.php';
    require '../dbcon.php';

    if (isset($_GET['deldept'])) {
        $deptid = $_GET['deldept'];

        $sql = "DELETE FROM departments WHERE deptid = '$deptid'";
        if ($conn->query($sql)) {
            echo "<script>alert('dept deleted')</script>";
        } else
            echo"<script>alert('student not deleted" . $conn->error . "')</script>";
    }
    ?>
    <div class="container">
        <h2 class="text-center">Department List</h2>
        <table class="table">
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Total Courses</th>
                <th>Total Credit Hours</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "select * from departments;";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['deptid']; ?></td>
                    <td><?php echo $row['deptname']; ?></td>
                    <td><?php echo $row['totalcourses']; ?></td>
                    <td><?php echo $row['totalcredithour']; ?></td>
                    <td><a class="btn btn-danger" href="viewdepartment.php?deldept=<?php echo $row['deptid']; ?>">DELETE</a></td>
                </tr>

                <?php
            }
            ?>

        </table>
    </div>
    <?php
    require 'footer.php';
}
?>
