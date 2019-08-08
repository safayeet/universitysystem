
<?php
require 'header.php';
?>
<style>
    .item img{
        width: 100%;
        height: 400px;
    }
    .col-sm-8{border-right: 1px solid #ccc;}

</style>

<!--image slider--> 
<div class="container-fluid">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active "></li>
            <li data-target="#myCarousel" data-slide-to="1" ></li>
            <li data-target="#myCarousel" data-slide-to="2" ></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/university_of_akron_student_union_courtesy_uakron.edu_.jpg" alt="">
            </div>

            <div class="item">
                <img src="images/univ2.jpg" alt="">
            </div>

            <div class="item">
                <img src="images/univ3.jpg" alt="">
            </div>
        </div>
    </div>
</div>


<!--blog posts section-->
<div class="container ">
    <div class="col-sm-8 col-xs-12">
        <h1 class="text-center">Blog Posts</h1>
        <div class="post">
            <!--<img src="" class="img-responsive" alt="No Image Attached"><br><br>-->
            <a href="#">The ever-curious geologist whose career was changed by a postcard</a><br>
            <p class="text-justify">Judith Bunbury’s career has taken her from geology into archaeology, where she contributes to international teams puzzling out 
                the narratives of ancient Egypt. <a href="#" class="btn">read more</a></p>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <h1 class="text-center">Notice Area</h1>
        <?php
        require 'dbcon.php';
        $system = "select * from notice where (noticefrom='system' and noticeto='everyone') order by sl DESC limit 3";
        ?>
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
            } else {
                
            }
            ?>
        </table>
    </div>
</div>
<hr>
<hr>
<!--quotes on versity-->
<div class="container-fluid">
    <div id="mCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#mCarousel" data-slide-to="0" class="active "></li>
            <li data-target="#mCarousel" data-slide-to="1" ></li>
            <li data-target="#mCarousel" data-slide-to="2" ></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">

            <div class="item active">
                <div class="well">
                    <h4 class="text-justify">
                        "
                        It has been a great pleasure to conclude a Memorandum of Understanding between IASBS and IUBAT University. This has opened up windows for cooperation in the areas of multidisciplinary higher professional education and advanced research as well as exchange of faculty and students between our two universities; in fact between the two nations.
                        "
                    </h4>
                    <p class="text-right"><b class="text-info">
                            Professor Yousef Sobouti</b>
                        <br>Institute for Advanced Studies in Basic Science</p>
                </div>
            </div>

            <div class="item">
                <div class="well">
                    <h4 class="text-justify">"
                        We at Simon Fraser University appreciate the links between our two universities. IUBAT University has provided the opportunity for our studies students to learn about Bangladesh and in return our student have iV I hope iV been able to communicate knowledge about Canada .Our graduate Public Policy Program, with its focus on international studies will enable a strengthening of these links.
                        "</h4>
                    <p class="text-right"><b class="text-info">
                            Professor John Richards</b>
                        <br>Simon Fraser University</p>
                </div>
            </div>
            <div class="item">
                <div class="well">
                    <h4 class="text-justify">"
                        Your leadership as an IUBAT University graduate can help make the world a better place – not only for your family, but also your community and all global citizens. Will you do your part? I look foreword to hearing about your achievement in the future. Best wishes for your professional career.
                        "</h4>
                    <p class="text-right"><b class="text-info">
                            Alex Berland</b>
                        <br>Adjunct Faculty, School of Pop'n and Public Helth, UBC, Canada</p>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
require 'footer.php';
?>