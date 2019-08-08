<?php
if (!isset($_SESSION)) session_start();
if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "admission") {
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] === 'teacher')
            header("location:../../teacher/home.php");
        else if ($_SESSION['role'] === 'student')
            header("location:../../student/home.php");
    }else {
        header("location:../../index.php");
    }
}
require '../../dbcon.php';

//write message in database
if($_GET['serial']==="1"){    
    $to= trim($_GET['to']);
    $from=trim($_GET['from']);
    $message= htmlentities(mysqli_real_escape_string($conn,trim($_GET['text']))); 
    $sql="INSERT INTO `chat`(`touser`, `fromuser`, `message`)  VALUES ('".$to."','".$from."','".$message."')";
    
    if(mysqli_query($conn, $sql)){
        echo "<tr><th>Data Inserted ".$to." ".$from." ".$message."</th></tr>";
    }else{
         echo "<tr><th>Data not Inserted ".$to." ".$from." ".$message."</th></tr>";
    }
}
//Reading messages from the database
if($_GET['serial']==="2"){
//     echo "<tr><th>db is empty now ".$_GET['to']." ".$_GET['from']."</th></tr>";
    $to= trim($_GET['to']);
    $from=trim($_GET['from']);
    $sql="select * from chat where (touser='$to' and fromuser='$from') or (touser='$from' and fromuser='$to')";
    if($result= mysqli_query($conn, $sql)){
        while($row= mysqli_fetch_assoc($result)){
            if($row['fromuser']===$from){
             echo"<tr><td class='text-right'>".
                     "<p>".$row['message']."<br>".
                     "".date("G:i", strtotime($row['messagetime']))."</p>"
                ."</td></tr>";   
            }
            else if($row['fromuser']===$to){
                  echo"<tr><td>".
                     "<p>".$row['message']."<br>".
                     "".date("G:i", strtotime($row['messagetime']))."</p>"
                ."</td></tr>";   
            }
        }
    }
}
?>

