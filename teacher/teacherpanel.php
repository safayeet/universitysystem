<?php
require'header.php';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['link'])) {
    $_SESSION['link'] = 'base.php';
}else if(isset($_GET['link'])){
     $_SESSION['link'] = $_GET['link'];
}
?>

<style>
    .anti-row{margin-left: 0px;margin-right: 0px}
    #dashboard{text-align: center;font-weight: bold;font-size: 15px; min-height:70vh; padding-left: 0px;padding-right: 0px; }
    #dashboard ul li a{color:black;}
    .btn{border-radius: 0px;}
    .navbar{margin-bottom: 0px;}
    .panel-default>.panel-heading+.panel-collapse>.panel-body {border-top-color: #fff;}
</style>
<div class="row anti-row">
    <div class="col-sm-2" id="dashboard">
        <br>
        <a href="teacherpanel.php"><h2>DASHBOARD</h2></a><br>

        <ul class="list-unstyled">
            <li class=""><a href="javascript:mylink('base.php')" class="btn btn-default btn-block">HOME</a></li>
            <li class=""><a href="javascript:mylink('offeredcourses.php')" class="btn btn-default btn-block">Offered Courses</a></li>
            <li class=""><a href="javascript:mylink('../chat/index.php')" class="btn btn-default btn-block">Live Chat</a></li>
        </ul>
    </div>
    <div class="col-sm-10" id="panelarea">
        <?php require $_SESSION['link']; ?>
    </div>
</div>
<script type="text/javascript">
    function mylink(link) {
        $(document).ready(function () {
            $("#panelarea").load(link);
        });
    }
</script>

<?php require'footer.php'; ?> 
