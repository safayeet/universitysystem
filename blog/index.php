<?php
require 'header.php';
require '../dbcon.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    $id = $_SESSION['user'];
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $posttext = $_POST['post'];
    $postid = 'post';
//    generate postid
    $sql = "select count(sl) from blogpost ";
    $p = $conn->query($sql);
    $r = $p->fetch_array();
    if ($r[0] === 0) {
        $postid = $postid . $r[0];
    } else {
        $sql = "select max(sl) from blogpost ";
        $p = $conn->query($sql);
        $r = $p->fetch_array();
        $r[0] ++;
        $postid = $postid . $r[0];
    }



    $sql = "insert into blogpost (postid,posttitle,poster,posttext) values ('$postid','$title','$id','$posttext')";
    if ($conn->query($sql)) {
        echo '<script>alert("New Post inserted")</script>';
        $sql = "CREATE TABLE IF NOT EXISTS `universitysystem`.`$postid` (
  `sl` INT NOT NULL AUTO_INCREMENT,
  `commenter` VARCHAR(45) NOT NULL,
  `commentertype` TEXT(15) NOT NULL,
  `comment` LONGTEXT NOT NULL,
  `datetime` TIMESTAMP NOT NULL,
  UNIQUE INDEX `sl_UNIQUE` (`sl` ASC))
ENGINE = InnoDB";
        if ($conn->query($sql)) {
            echo '<script>alert("New Comment table created")</script>';
        } else {
            echo "<script>alert('Error in creating <br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error in inserting <br>" . $conn->error . "');</script>";
    }
}
if (isset($_GET['delete'])) {
    $postid=$_GET['postid'];
    $sql = "DROP TABLE $postid";
    if ($conn->query($sql)) {
        echo '<script>alert("Comment table deleted")</script>';
        
    } else {
        echo "<script>alert('Error in deletion <br>" . $conn->error . "');</script>";
    }
    $sql = "DELETE FROM `blogpost` WHERE `blogpost`.`postid` = '$postid'";
        if ($conn->query($sql)) {
            echo '<script>alert("post deleted")</script>';
        } else {
        echo "<script>alert('Error in deletion <br>" . $conn->error . "');</script>";
    }
}
$sql = "select * from blogpost order by sl DESC limit 10";
$posts = $conn->query($sql);
?>
<style>
    #newpost{position: absolute;top: 80px;left: 0px;}

    .modal-body  td,#show td{border-top: unset !important;}
</style>

<div class="container">

<?php if (isset($_SESSION['role'])) { ?>
        <!-- Trigger the new post area  -->
        <button type="button"  class="btn btn-info btn-lg" id="newpost" data-toggle="modal" data-target="#myModal">New Post</button>
        <!-- new post form -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Blog Post</h4>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table-responsive">
                                <tr>
                                    <td>Post Title</td>
                                    <td><input type="text" name="title" required></td>
                                </tr>
                                <tr>
                                    <td>Post</td>
                                    <td><textarea name="post" rows="5" cols="70" required></textarea></td>
                                </tr>


                            </table>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" name="submit" class="btn btn-success">submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php } ?>
    <!--view posts-->
    <div class="row">
        <h1 class="text-center">Welcome to BLOG</h1>
        <br>
        <div class="col-sm-8" id="show">
<?php while ($rowp = $posts->fetch_assoc()) { ?>
                <div>
                    <b><a><?php echo $rowp['posttitle']; ?></a></b>
                    <p><b><?php echo $rowp['poster']; ?></b>&nbsp;&nbsp;&nbsp; <?php echo $rowp['postdate']; ?></p>
                    <p><?php echo implode(' ', array_slice(explode(' ', $rowp['posttext']), 0, 30)); ?></p>
                    <a class="btn btn-info btn-sm" href="post.php?postid=<?php echo $rowp['postid']; ?>">Read More</a>
    <?php if ($_SESSION['role'] === "admin") { ?>
                        <a class="btn btn-sm btn-danger" href="index.php?postid=<?php echo $rowp['postid']; ?>&delete=yes">Delete Post</a>
                    <?php } ?>
                    <br><br>
                </div>
<?php } ?>
        </div>
        <div class="col-sm-4">
            <h3>Old Posts</h3>
            <ul class="list-group">
<?php
$sql = "select postid,posttitle from blogpost order by sl";
$p = $conn->query($sql);
while ($row = $p->fetch_array()) {
    ?>
                    <li><a href="post.php?postid=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>


</div>




<?php require 'footer.php'; ?>