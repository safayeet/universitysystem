<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    header('location:home.php');
} else {

    require'header.php';
    require '../dbcon.php';

    ?>

    <div class="container">
        <h1 class="text-center">Offered Courses List</h1>
        <table class="table">
            <tr>
                <td>Offering ID</td>
                <td>Course ID</td>
                <td>Semester</td>
                <td>Department</td>
                <td>Teacher ID</td>
                <td>Action</td>
            </tr>
            <?php
            $query = "select * from offeredcourse;";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['offerid']; ?></td>
                    <td><?php echo $row['courseid']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['teacher']; ?></td>
                    <td>
                        <a class="btn btn-danger" href="offeringActions.php?delofr=<?php echo $row['offerid']; ?>">Delete</a>
                        <?php
                        $sql = "select count(feedback) from " . $row['offerid'] . " WHERE feedback = ''";
                        $r = mysqli_query($conn, $sql);
                        $x = mysqli_fetch_array($r);
                        if (intval($x[0]) === 0) {
                            ?>
                        <a class="btn btn-info" href="offeringActions.php?end=<?php echo $row['offerid']; ?>">End Course</a>
                        <?php } else { ?>
                            <a class="btn btn-info" href="#">Activities not completed</a>                            
                        <a class="btn btn-warning" href="offeringActions.php?warn=<?php echo $row['offerid']; ?>">Send Warning</a>
                        <?php } ?>
                    </td>
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