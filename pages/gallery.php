<!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Our Gallery</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php?page=home-travel">Home</a></li>
                    <li>Our Gallery</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
Gallery Area  
==============================-->
    <div class="overflow-hidden space" id="gallery-sec">
        <div class="container">
            <div class="filter-menu filter-menu-active">
                <button data-filter="*" class="tab-btn active" type="button">All</button>
                <?php $sql = "SELECT DISTINCT(location) FROM tblgallery";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {	?>

                <button data-filter=".<?php echo htmlentities($result->location);?>" class="tab-btn" type="button"><?php echo htmlentities($result->location);?></button>
                
                <?php }} ?> 
            </div>
            <div class="row gy-4 gallery-row filter-active">

                <?php $sql = "SELECT * from tblgallery";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {	?>

                <div class="col-md-6 col-xl-auto filter-item <?php echo htmlentities($result->location);?>">
                    <div class="gallery-box style4">
                        <div class="gallery-img global-img">
                            <img src="assets/img/gallery/<?php echo htmlentities($result->imgname);?>" alt="gallery image">
                            <a href="assets/img/gallery/<?php echo htmlentities($result->imgname);?>" class="icon-btn popup-image"><i class="fal fa-magnifying-glass-plus"></i></a>
                        </div>
                    </div>
                </div>
                
                <?php }} ?> 
                           
            </div>
        </div>
    </div> <!--==============================
	Footer Area
==============================-->