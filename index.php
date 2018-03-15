
<?php

require 'header.php';
?>
<style>
    .post{
        padding: 0px 10px;

    }
</style>


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
<div class="container-fluid">
    <h3 class="text-center">Blog Posts</h3>
    <div class="col-sm-4 post">
        <img src="images/img_2.jpg" class="img-thumbnail img-responsive" alt="Post Image"><br><br>
        <a href="#">The ever-curious geologist whose career was changed by a postcard</a><br>
        <p>Judith Bunbury’s career has taken her from geology into archaeology, where she contributes to international teams puzzling out 
            the narratives of ancient Egypt. She says her love of wearing bright colors makes her hard to ignore...<a href="#" class="btn">read more</a></p>
    </div>
    <div class="col-sm-4 post">
        <img src="images/img_1.jpg" class="img-thumbnail img-responsive" alt="Post Image"><br><br>
        <a href="#"><h5>The Egyptian geneticist exploring the fragile early life of mammalian eggs</h5></a><br>
        <p>In the last ten years Ahmed Balboula and his family have lived in three different countries as he’s pursued a career in reproductive 
            genetics. His current research looks at the role of genes in determining success rates in fertilisation ....<a href="#" class="btn">read more</a></p>
    </div>
    <div class="col-sm-4 post">
        <img src="images/img_3.jpg" class="img-thumbnail img-responsive" alt="Post Image"><br><br>
        <a href="#"> <h5>Cambridge and AI: what makes this city a good place to start a business?</h5></a><br>
        <p>What makes a city as small as Cambridge a hotbed for AI and machine learning start-ups? A critical mass of clever people 
            obviously helps. But there’s more to Cambridge’s success than that...<a href="#" class="btn">read more</a> </p>
    </div>
</div>





<?php

require 'footer.php';
?>