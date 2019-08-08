<?php
if (!isset($_SESSION))
    session_start();
if ($_SESSION['role'] !== 'teacher') {
    header('location:home.php');
} else {
    require 'header.php';
    require '../dbcon.php';
    $offeredid = $_GET['offerid'];
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $q="update $offeredid set assignmentlink='' where studentid='$id'";
        if($conn->query($q))echo "assignment deleted";
        else echo $conn->error;
    }
    
    ?>
    <div class="container">
        <h1 class="text-center">Assignment's</h1>
        <table class="table">
            <tr>
                <th>Serial</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "select * from $offeredid";
            $result1 = $conn->query($sql);
            $c = 0;
            while ($row1 = $result1->fetch_assoc()) {
                $c++;
                ?>
                <tr>
                    <th><?php echo $row1['studentid']; ?></th>
                    <th><?php echo $c; ?></th>
                    <th><?php echo $row1['studentname']; ?></th>
                    <th><a class="btn btn-info" <?php
                        if ($row1['assignmentlink'] !== NULL && $row1['assignmentlink'] !== '')
                            echo 'href="' . $row1['assignmentlink'] . '" target="_blank"';
                        else
                            echo '#';
                        ?>>
                                <?php
                                if ($row1['assignmentlink'] !== NULL && $row1['assignmentlink'] !== '')
                                    echo "View Assignment";
                                else
                                    echo 'Not Submitted';
                                ?>
                        </a>
                        <?php
                        if ($row1['assignmentlink'] !== NULL && $row1['assignmentlink'] !== ''){?>
                        <a class="btn btn-danger" href="download.php?<?php echo 'offerid='.$offeredid.'&id='.$row1['studentid'];?>">Delete</a>
                        <?php } ?>
                    </th>
                </tr>
            <?php } ?>

        </table>
    </div>
<?php } ?>