
<?php
require 'header.php';
require '../dbcon.php';
$offeredid = $_GET['offerid'];
$sql = "select * from $offeredid";
$result = $conn->query($sql);
?>
<table class="table">
    <tr></tr>
    <?php
    while ($row = $result->fetch_array()) {
        ?>
    <tr>
        <th><?php echo $row[0]?></th>
        <th><?php echo $row[1]?></th>
        <th><?php echo $row[2]?></th>
        <th><?php echo $row[3]?></th>
        <th><?php echo $row[4]?></th>
        <th><?php echo $row[5]?></th>
        <th><?php echo $row[6]?></th>
    </tr>
        <?php
    }
    ?>
</table>