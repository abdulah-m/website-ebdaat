<?php include"header.php"; ?>
            <section class="content animated fadeIn">
                <!-- about us slider -->
<div id="about-slider">
    <div id="carousel-slider" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators visible-xs">
        <?php
        $i = 0;
        $selectSlider = "SELECT * FROM slider";
        $querySlider  = mysql_query($selectSlider)or die (mysql_error());
        while($row=mysql_fetch_array($querySlider)){
            
            if($i == 0){
                echo '<li data-target="#carousel-slider" data-slide-to="'.$i.'" class="active"></li>';
            }else{
                echo '<li data-target="#carousel-slider" data-slide-to="'.$i.'"></li>';
            }
            $i++;
        }          
        ?>
        </ol>

        <div class="carousel-inner">
            <?php
            $i = 0;
            $selectSliderSrc = "SELECT * FROM slider";
            $querySliderSrc  = mysql_query($selectSliderSrc)or die (mysql_error());
            while($row=mysql_fetch_array($querySliderSrc)){
                $src_slide=htmlspecialchars($row[1]);
                if($i == 0){
                    echo ' <div class="item active">
                                <img src="../images/slider/'.$src_slide.'" class="img-responsive" /> 
                           </div>';
                    }else{
                        echo ' <div class="item">
                                    <img src="../images/slider/'.$src_slide.'" class="img-responsive" /> 
                               </div>';
                    }
                $i++;
            }          
            ?> 
        </div>
        <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
            <i class="fa fa-angle-left"></i> 
        </a>
        <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
            <i class="fa fa-angle-right"></i> 
        </a>
    </div> <!--/#carousel-slider-->
</div><!--/#about-slider-->
                
            <div class="intro">
                    <a class="animated  pages-intro" href="./newspaper.php">
                        <img src="img/addadscommerce.png" alt="Ebdaat" />
                        <label>الجريدة</label></a>
                    <a class="animated  pages-intro" href="./Design.php">
                        <img src="img/pages-design.png" alt="Ebdaat" />
                        <label>التصميم</label></a>
                    <a class="animated  pages-intro" href="./Commercial-publications.php">
                        <img src="img/pages-Commercial-publications.png" alt="Ebdaat" />
                        <label>المطبوعات التجارية</label></a>
                </div>
            </section>
<?php include"footer.php"; ?>