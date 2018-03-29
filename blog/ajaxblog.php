
<?php

require '../dbcon.php';
if (!isset($_SESSION))
    session_start();
if (isset($_GET['postid'])) {
    $postid = $_GET['postid'];
    if (isset($_SESSION['role'])) {
        $commenter = $_SESSION['user'];
        $commentertype = $_SESSION['role'];
    }

    if (trim($_GET['comment']) === '' || $_GET['allow'] === '0') {
        $sql = "select * from $postid order by sl DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo'<tr><b>'
            . $row['commenter']
            . '</b></tr><br>' . '<tr>'
            . $row['datetime']
            . '</tr><br>' . '<tr>'
            . $row['comment']
            . '</tr><br><br><br>';
        }
    } else {
        $comment = trim($_GET['comment']);
        $sql = "insert into $postid (commenter,commentertype,comment) values ('$commenter','$commentertype','$comment')";
        if ($conn->query($sql) !== TRUE) {
            echo " Error in updating the comment";
        }
        $sql = "select * from $postid order by sl DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo'<tr><b>'
            . $row['commenter']
            . '</b></tr><br>' . '<tr>'
            . $row['datetime']
            . '</tr><br>' . '<tr>'
            . $row['comment']
            . '</tr><br><br><br>';
        }
    }

    $conn->close();
}
?>