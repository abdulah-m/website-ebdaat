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
        
        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" href="#" data-filter="*">bütün yayınlar</a></li>
            <?php
            $selectDesignTypes = "SELECT * FROM publications_type";
            $queryDesignTypes  = mysql_query($selectDesignTypes)or die (mysql_error());
            while($row=mysql_fetch_array($queryDesignTypes)){
                $titleDesignTypes=htmlspecialchars($row[3]);
                $filterDesignTypes=htmlspecialchars($row[2]);
                        echo ' <li><a class="btn btn-default" href="#" data-filter=".'.$filterDesignTypes.'">'.$titleDesignTypes.'</a></li>';
            }          
            ?> 
        </ul><!--/#portfolio-filter  // * , -->
        <div class="row">
            <div class="portfolio-items">
                <?php
                $selectDesign = "SELECT * FROM publications";
                $queryDesign  = mysql_query($selectDesign)or die (mysql_error());
                while($row=mysql_fetch_array($queryDesign)){
                    $thumb       =  htmlspecialchars($row[2]);
                    $title       =  htmlspecialchars($row[10]);
                    $description =  htmlspecialchars($row[11]);
                    $image       =  htmlspecialchars($row[5]);
                    $number      =  htmlspecialchars($row[6]);
                    $price       =  htmlspecialchars($row[7]);
                    
                    $d = Cut_Text($description, $limit = 100, "....");
                    $selectType  = "SELECT filter FROM publications_type where id=$row[1]";
                    $queryType   = mysql_query($selectType)or die (mysql_error());
                    $class       =  mysql_fetch_row($queryType);
                    echo '
                    <div class="portfolio-item '.$class[0].' col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
                            <img class="img-responsive" src="../images/publications/recent/'.$thumb.'" alt="">
                            <div class="overlay">
                                <div class="recent-work-inner">
                                    <h3><a href="#">'.$title.'</a></h3>
                                    <p>
                                    '.$d.'<br />
                                    Adet : '.$number.'  <br/>
                                    Fiyat : '.$price.' TL 
                                    </p>
                                    <a class="preview" href="../images/publications/full/'.$image.'" rel="prettyPhoto"><i class="fa fa-eye"></i> gösteri </a>
                                </div> 
                            </div>
                        </div>
                    </div><!--/.portfolio-item-->';
                }?>                
            </div>
        </div>
    </section><!--/#portfolio-item-->
        
</section>
<div id="publ_form" style="display:none;">
    <a id="close_box" href="#" ><img src="img/close_btn.png" /></a>
    
    <form id="publ_form2" action="include/publ_form.php" method="post">
        <h1>اختر المواصفات لإظهار السعر</h1>
        <select name="type" id="type">
            <option value="" selected="selected">حدد نوع المنتج</option>
            <?php
            $selectType = "SELECT * FROM publications_type";
            $queryType  = mysql_query($selectType)or die (mysql_error());
            while($row=mysql_fetch_array($queryType)){
                $id =  htmlspecialchars($row[0]);
                $ar =  htmlspecialchars($row[1]);
                $en =  htmlspecialchars($row[2]);
                echo '<option value="'.$id.'">'.$en.'</option>';
            }?>
        </select>
        <select name="size" id="size">
            <option value="" selected="selected">القياس</option>
            <?php
            $size = array("A0","A1","A2","A3","A4","A5","A6","C3","C4","C5","C6");
            $i = 0;
            while($i < count($size)){
                echo '<option value="'.$size[$i].'">'.$size[$i].'</option>';
                $i++;
            }?>
        </select>
        <select name="number" id="number">
            <option value="" selected="selected">العدد</option>
            <?php
            $number = array("1000","2000","3000","4000","5000","5000","6000","7000","8000","9000","10000");
            $i = 0;
            while($i < count($number)){
                echo '<option value="'.$number[$i].'">'.$number[$i].'</option>';
                $i++;
            }?>
        </select>
        <select name="thick" id="thick">
            <option value="" selected="selected">السماكة</option>
            <?php
            $thick = array("115","150","200","250","300","350","400","450","500");
            $i = 0;
            while($i < count($thick)){
                echo '<option value="'.$thick[$i].'">'.$thick[$i].'</option>';
                $i++;
            }?>
        </select>
        <select name="faces" id="faces">
            <option value="" selected="selected">نوع الطباعة</option>
            <?php
            $faces = array("One face","Two-sided","One face tinted","Two-sided colored");
            $i = 0;
            while($i < count($faces)){
                $i++;
                echo '<option value="'.$i.'">'.$faces[$i-1].'</option>';
            }?>
        </select>
        <button name="submit" value="submit">احسب السعر</button>
    </form>
    <div id="publ_status"></div>
</div>
<?php include"footer.php"; ?>