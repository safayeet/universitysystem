<?php
require 'header.php';
//will start session if it's not started
if (!isset($_SESSION))
    session_start();
$role=$_SESSION['role'];
$id=$_SESSION['user'];

$sql="select * from blogpost";

?>