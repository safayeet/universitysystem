
<?php
require 'header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
//        echo"<script>alert('You must login as a Teacher to access.You will be redirected to your " . $_SESSION['link'] . " panel within 5 seconds');</script>";
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../teacher/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../admin/home.php");
    }else{
        header("location:../index.php");
    }
}
require '../dbcon.php';
?>


<div class="container">
    <!--view the occasions to the user table-->
    <?php
    $sql = "select * from versitycalendar order by occasiondate ";
    $result = $conn->query($sql);
    ?>
    <table class="table table-responsive">
        <tr>
            <th>Serial</th>
            <th>Date</th>
            <th>Occasion</th>
            <th>Vacation</th>
            <th>Function</th>
        </tr>
        <?php
        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <th><?php echo ++$cnt; ?></th>
                <th><?php echo date('jS M, Y', strtotime($row['occasiondate'])) ?></th>
                <th><?php echo $row['occasion']; ?></th>
                <th>
                    <?php
                    if ($row['vacation'] === '1')
                        echo "YES";
                    else
                        echo "NO";
                    ?>
                </th>
                <th>
                    <?php
                    if ($row['func'] === '1')
                        echo "YES";
                    else
                        echo "NO";
                    ?>
                </th>                     

            </tr>
        <?php } ?>
    </table>


</div>