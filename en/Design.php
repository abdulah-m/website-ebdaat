<?php 
include"header.php";
include"include/function.php";
?>
<section class="content">
    <section id="portfolio">
        <div class="center">
           <h2>Design department</h2>
           <p class="lead">This section includes graphic design and Web design and programming</p>
        </div>
        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" href="#" data-filter="*">All designs</a></li>
            <?php
            $selectDesignTypes = "SELECT * FROM design_type";
            $queryDesignTypes  = mysql_query($selectDesignTypes)or die (mysql_error());
            while($row=mysql_fetch_array($queryDesignTypes)){
                $titleDesignTypes=htmlspecialchars($row[2]);
                $filterDesignTypes=htmlspecialchars($row[2]);
                        echo ' <li><a class="btn btn-default" href="#" data-filter=".'.$filterDesignTypes.'">'.$titleDesignTypes.'</a></li>';
            }          
            ?> 
        </ul><!--/#portfolio-filter  // * , -->
        <div class="row">
            <div class="portfolio-items">
                <?php
                $selectDesign = "SELECT * FROM design";
                $queryDesign  = mysql_query($selectDesign)or die (mysql_error());
                while($row=mysql_fetch_array($queryDesign)){
                    $thumb       =  htmlspecialchars($row[2]);
                    $title       =  htmlspecialchars($row[8]);
                    $description =  htmlspecialchars($row[9]);
                    $image       =  htmlspecialchars($row[5]);
                    $number      =  htmlspecialchars($row[6]);
                    $price       =  htmlspecialchars($row[7]);
                    
                    $d = Cut_Text($description, $limit = 100, "....");
                    $selectType  = "SELECT filter FROM design_type where id=$row[1]";
                    $queryType   = mysql_query($selectType)or die (mysql_error());
                    $class       = mysql_fetch_row($queryType);
                    echo '
                    <div class="portfolio-item '.$class[0].' col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
                            <img class="img-responsive" src="../images/design/recent/'.$thumb.'" alt="">
                            <div class="overlay">
                                <div class="recent-work-inner">
                                    <h3><a href="#">'.$title.'</a></h3>
                                    <p>
                                    '.$d.'<br />
                                    Number : '.$number.'  <br/>
                                    Price : '.$price.' TL 
                                    </p>
                                    <a class="preview" href="../images/design/full/'.$image.'" rel="prettyPhoto"><i class="fa fa-eye"></i> Show </a>
                                </div> 
                            </div>
                        </div>
                    </div><!--/.portfolio-item-->';
                }?>                
            </div>
        </div>
    </section><!--/#portfolio-item-->
</section>
<?php include"footer.php"; ?>