
<?php
require 'header.php';
?>

<!--image slider--> 
<div class="container-fluid">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/univ1.jpg" alt="">
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
        <h1 class="text-center">Latest Blog Posts</h1>
        <div class="post">
            <img src="" class="img-responsive" alt="No Image Attached"><br><br>
            <a href="#">The ever-curious geologist whose career was changed by a postcard</a><br>
            <p>Judith Bunbury’s career has taken her from geology into archaeology, where she contributes to international teams puzzling out 
                the narratives of ancient Egypt. <a href="#" class="btn">read more</a></p>
        </div>
        <a class="btn btn-primary btn-lg text-center" href="blog/">See More</a>
    </div>
    <div class="col-sm-4 col-xs-12">
        <h1 class="text-center">Notice Area</h1>
    </div>
</div>






<?php
require 'footer.php';
?>