<h1 class="text-center">Admin Panel Home page </h1>
<br>
<table class="table table-responsive">
    <tr>
        <td>Total Students</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Total Departments</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Active Students</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Students Under Suspension </td>
        <td>:</td>
        <td></td>
    </tr>
</table>

<?php 

if (!isset($_SESSION)){ session_start();}$_SESSION['link'] = "home.php" ?>