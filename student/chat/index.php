<?php
if (!isset($_SESSION))
    session_start();
require 'header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
//        echo"<script>alert('You must login as a Teacher to access.You will be redirected to your " . $_SESSION['link'] . " panel within 5 seconds');</script>";
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../../teacher/home.php");
        else if ($_SESSION['role'] === 'admin')
            header("location:../../admin/home.php");
    }else {
        header("location:../../index.php");
    }
}
require '../../dbcon.php';
?>
<style>
    .col-sm-8{height: 100%;padding: 10px;}

    #table2 tr th,#table1 tr th{
        border-top:unset;
    }
    #table1{
        border:2px dotted #bbb;
    }
    #table1 tr{
        border-bottom:1px solid #fff6f6;
    }
    #table1 tr td p{
        padding: 0px 15px;
    }
</style>
<script>
    "use strict";
    $(document).ready(function () {
        var chatInterval = 250;
        var $to = $("#ToUser");
        var $from = $("#FromUser");
        var $chatInput = $("#chatInput");
        var $chatOutput = $("#table1");
        $("#table2").hide();

//send the message to the database along with sender id and receivers id
        function sendMessage() {
//            store receivers id
            var to = $to.val();
//            store senders id
            var from = $from.val();
//            store message
            var message = $chatInput.val();
//calling ajax for server request
            $.get("ajax.php", {
                serial: 1,
                to: to,
                from: from,
                text: message
            }, function (data) {
                $chatOutput.html(data);
                $chatInput.val("");
            });
            retrieveMessages();
        }
//read messages from the database 
        function retrieveMessages() {
//            store receivers id
            var to = $to.val();
//            store senders id
            var from = $from.val();
//            ajax call for reading data
            $.get("ajax.php", {
                serial: 2,
                to: to,
                from: from
            }, function (data) {
//                pastes the data read from database 
                $chatOutput.html(data);
            });
        }
//        calls the sendMessage function for sending data to database
        $("#Send").click(function () {
//            store message
            var message = $chatInput.val();
            if (message.trim().length == 0) {
                alert("Message Can't be empty");
            } else {
                sendMessage();
            }
        });
//        calls the retrieveMessage function every 250 miliseconds for latest messages
        setInterval(function () {
            if ($to.val().length != 0) {
                retrieveMessages();
            }
        }, chatInterval);

    });

//    Sets username for chat read and write
    function chat(var1, var2) {
//        sets var1 value to the element id ToUser
        document.getElementById("ToUser").value = var1;
        $("#table2").show();
        document.getElementById("nam1").innerHTML = var2;
    }

</script>
<div class="container">
    <h1 class="text-center" id="nam1"></h1>
    <aside class="col-sm-4">
        <p class="lead text-center">Users</p>
        <div class="list-group">
            <!--Available Userlist-->
            <a href="javascript:chat('admin','ADMIN')" class="list-group-item">Admin</a>
            <?php
            $s = "select currentsemester,department from studentdetails where id=" . $_SESSION['user'];
            if ($res = mysqli_query($conn, $s)) {
                $res1 = mysqli_fetch_array($res);
//                echo "<script>alert('".$res1[0]."  " . $res1[1] . "');</script>";
                $sql = "select distinct teacher from offeredcourse where semester ='" . $res1[0] . "' and department='" . $res1[1] . "'";
                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_array($result)) {
//                        echo "<script>alert('1 " . $row['teacher'] . "');</script>";
                        $x = "select name from teacherdetails where teacherid='" . $row[0] . "'";
                        $y = mysqli_query($conn, $x);
                        $name = mysqli_fetch_array($y);
                        ?>   
                                                                                                                                                                                                                                    <!--<input type="button" class="list-group-item" placeholder="" value="<?php // echo $name[0];                  ?>">-->
                        <a href="javascript:chat('<?php echo $row[0]; ?>','<?php echo $name[0]; ?>')" class="list-group-item"><?php echo $name[0]; ?></a>
                        <?php
                    }
                } else
                    echo "<script>alert('" . $conn->error . "');</script>";
            }
            ?>
        </div>
    </aside>

    <div class="col-sm-8">
        <div class="container-fluid">
            <input id="ToUser" type="hidden">
            <input id="FromUser" type="hidden" value="<?php echo $_SESSION['user']; ?>">
            <table class="table table-responsive table-condensed table-striped" id="table1">
                <tr id="chatOutput">
                    <th><h1>Welcome to Online Support</h1></th>
                </tr>                
            </table>

            <table class="table "  id="table2">
                <tr>
                    <th><input type="text" class="form-control form-group-lg" id="chatInput"></th>
                    <th>&nbsp;</th>
                    <th><a href="#" class="btn btn-default" id="Send" >Send</a></th>
                </tr>
            </table>
        </div>
    </div>
</div>


