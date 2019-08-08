<?php 
if(!isset($_SESSION))    session_start();
if(isset($_SESSION['user'])){
    require '../dbcon.php';
    $delete=date('m/d');
    $sql="delete from notice where destroydate='$delete' or destroydate < '$delete'";
    if($conn->query($sql)){
//        echo '<script>alert("Notices deleted");</script>';
    }else{
//        echo '<script>alert("'.$conn->error.'");</script>';
    }
}else{
    header("location:index.php");
}

?>
