<?php 
include"header.php";
include"include/function.php"; 
?>
<section class="content">
    <section id="portfolio">
        <div class="center">
           <h2>Ticari yayınlar</h2>
           <p class="lead">Bu bölüm size sunuyoruz baskı hizmetleri tümünü içerir</p>
            <!--<a id="calc_pub" class="btn btn-default" href="#">أحسب سعر منتج حسب المواصفات</a>-->
        </div>
        <div class="row">
            <ul class="portfolio-filter-p text-center">
                <?php
                $selectDesignTypes = "SELECT * FROM publications_type";
                $queryDesignTypes  = mysql_query($selectDesignTypes)or die (mysql_error());
                while($row=mysql_fetch_array($queryDesignTypes)){
                    $titleDesignTypes=htmlspecialchars($row[3]);
                    $filterDesignTypes=htmlspecialchars($row[2]);
                            echo ' <li><a class="btn btn-default" href="#" data-id="'.$row[0].'">'.$titleDesignTypes.'</a></li>';
                }?> 
            </ul><!--/#portfolio-filter  // * , -->
            <div id="layout">
                
            </div>
        </div>
    </section><!--/#portfolio-item-->
</section>
<?php include"footer.php"; ?>