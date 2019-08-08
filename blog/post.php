<?php
require 'header.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
require '../dbcon.php';
if (!isset($_GET['postid'])) {
    header("location:index.php");
} else {
    if (isset($_GET['stop'])) {
        $postid = $_GET['postid'];
        $s = $_GET['stop'];
        $sql = "update blogpost set allowcomment=$s where postid='$postid'";
        if ($conn->query($sql)) {
            echo '<script>alert("Comment Permission updated")</script>';
        }
    }
    $postid = $_GET['postid'];
    $sql = "select * from blogpost where postid='$postid'";
    $postdetails = $conn->query($sql);
    if ($row = $postdetails->fetch_assoc()) {
        ?>
        <style>
            #commentarea td{border-top: unset !important;}
        </style>
        <script>
            function comment() {
        //                alert(document.getElementById("comment").value + " " + document.getElementById("postid").value);
                $.ajax({
                    type: 'get',
                    url: 'ajaxblog.php',
                    data: {
                        comment: document.getElementById("comment").value,
                        postid: document.getElementById("postid").value,
                        allow: document.getElementById("allow").value
                    },
                    success: function (response) {
                        document.getElementById("commentarea").innerHTML = response;
                    }
                });
            }
            $(document).ready(function () {
                comment();
            });
        </script>

        <div class="container">
            <div class="col-sm-8">
                <div class="row">
                    <h1 class=""><?php echo $row['posttitle']; ?></h1>
                    <textarea style="display: none;" id="postid"><?php echo $row['postid']; ?></textarea>
                    <textarea style="display: none;" id="allow"><?php echo $row['allowcomment']; ?></textarea>
                    <a><b><?php echo $row['poster']; ?></b></a>
                    <p><?php echo $row['postdate']; ?></p>
                    <p class="text-justify">
                        <?php echo $row['posttext']; ?>
                    </p>
                    <br>
                </div>

                <div class="row">
                    <textarea class="form-control" id="comment" <?php if (!isset($_SESSION['user']) || $row['allowcomment'] === '0') echo "disabled"; ?>></textarea>

                   <!--<textarea class="form-control" id="comment" <?php if (isset($_SESSION['user']) & $row['allowcomment'] === '1') echo "disabled"; ?>> </textarea>-->
                        <br>
                        <?php if (isset($_SESSION['user']) & $row['allowcomment'] === '1') { ?>
                            <a class="btn btn-info" href="javascript:comment()" >Comment</a>
                            <a class="btn btn-info" href="post.php?postid=<?php echo $postid; ?>&stop=0" >Stop Comment</a>
                        <?php } ?>
                        <br>
                        <br>
                        </div>

                        <div class="row">
                            <table class="table table-responsive"  id="commentarea">

                            </table>
                        </div>
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


            <?php
        } else {
            echo "error in sql <br>" . $conn->error;
        }
        require 'footer.php';
    }
    ?>