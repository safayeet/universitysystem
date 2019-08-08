<?php
if (!isset($_SESSION))
    session_start();
if ($_SESSION['role'] !== 'teacher') {
    header('location:home.php');
} else {
    include '../delnotice.php';
    ?>

    <h1 class="text-center">Teacher Panel </h1>
    <br>

    <?php
    require '../dbcon.php';
    $teacherid = $_SESSION['user'];
    $sql = "select * from teacherdetails where teacherid ='$teacherid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <div class="col-sm-7">
        <table class="table table-responsive">

            <tr>
                <td>Full Name </td>
                <td>:</td>
                <td>         
                    <?php echo $row['name']; ?>
                </td>
            </tr>
            <tr>
                <td>Designation </td>
                <td>:</td>
                <td>         
                    <?php echo $row['position']; ?>
                </td>
            </tr>
            <tr>
                <td>Department </td>
                <td>:</td>
                <td>         
                    <?php echo $row['department']; ?>
                </td>
            </tr>

        </table>
    </div>
    <div class="col-sm-4">
        <h2 class="">Notice Board</h2>
        <?php
        $system = "select * from notice where noticefrom='system' and noticeto='everyone' order by sl DESC  ";
        ?>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">System</a></li>
            <li><a data-toggle="tab" href="#menu1">Course</a></li>
            <li><a data-toggle="tab" href="#menu2">Admin</a></li>
        </ul>

        <div class="tab-content">
            <!--Generic Notice From system-->
            <div id="home" class="tab-pane fade in active">
                <table class="table table-responsive">
                    <?php
                    if ($result = $conn->query($system)) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['noticedate'] . "<br>" . $row['noticefrom']; ?>
                                </td>
                                <td><?php echo $row['message']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div id="menu1" class="tab-pane fade">
                <!--Notice generated from course related actions-->
                <table class="table table-responsive">
                    <?php
                    $s = "select offerid from offeredcourse where teacher='" . $_SESSION['user'] . "'";
                    if ($x = mysqli_query($conn, $s)) {
                        while ($z = mysqli_fetch_array($x)) {
                            $course = " select * from notice where noticefrom='system' and noticeto='" . $z[0] . "' order by sl DESC";
                            if ($result = $conn->query($course)) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['noticedate'] . "<br>" . $row['noticefrom']; ?>
                                        </td>
                                        <td><?php echo $row['message']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else
                                echo"<script>alert('1 " . mysqli_error($conn) . "');</script>";
                        }
                    } else
                        echo"<script>alert('2 " . mysqli_error($conn) . "');</script>";
                    ?>
                </table>
            </div>
            <div id="menu2" class="tab-pane fade">
                <!--direct notice from admin-->
                <div id="home" class="tab-pane fade in active">
                    <table class="table table-responsive">
                        <?php
                        $s = "select offerid from offeredcourse where teacher='" . $_SESSION['user'] . "'";
                        if ($x = mysqli_query($conn, $s)) {
                            while ($z = mysqli_fetch_array($x)) {
                                $admin = "select * from notice where noticefrom='admin' and (noticeto='teacher' or noticeto='$z[0]' or noticeto='" . $_SESSION['user'] . "') order by sl DESC  ";
                                if ($result = $conn->query($admin)) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['noticedate'] . "<br>" . $row['noticefrom']; ?>
                                            </td>
                                            <td><?php echo $row['message']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                        } else
                            echo"<script>alert('2 " . mysqli_error($conn) . "');</script>";
                        ?>
                    </table>
                </div>  
            </div>
        </div>
    </div>

    <?php
}
?>