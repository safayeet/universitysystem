<?php

require 'header.php';
if (!isset($_SESSION))
    session_start();
require '../dbcon.php';

$offeredid = $_GET['offerid'];
?>
<div class="container">
    <h1 class="text-center">Assignment's</h1>
    <table class="table">
        <tr>
            <th>Serial</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>View Assignment</th>
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
                <th><a <?php
                    if ($row1['assignmentlink'] !== NULL)
                        echo 'href="' . $row1['assignmentlink'] . '" target="_blank"';
                    else
                        echo '#';
                    ?>>
                            <?php
                            if ($row1['assignmentlink'] !== NULL)
                                echo "View Assignment";
                            else
                                echo 'Not Submitted';
                            ?>
                    </a></th>
            </tr>
        <?php } ?>

    </table>
</div>