<!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Popular Tours</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php?page=home-travel">Home</a></li>
                    <li>Popular Tours</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
Team Area  
==============================-->
    <!--==============================
Product Area
==============================-->
    <section class="space">
        <div class="container">
            <div class="th-sort-bar">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-4">
                        <div class="search-form-area">
                            <form class="search-form">
                                <input type="text" placeholder="Search">
                                <button type="submit"><i class="fa-light fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-auto">
                        <div class="sorting-filter-wrap">
                            <div class="nav" role="tablist">
                                <a class="active" href="#" id="tab-destination-grid" data-bs-toggle="tab" data-bs-target="#tab-grid" role="tab" aria-controls="tab-grid" aria-selected="true"><i class="fa-light fa-grid-2"></i></a>

                                <a href="#" id="tab-destination-list" data-bs-toggle="tab" data-bs-target="#tab-list" role="tab" aria-controls="tab-list" aria-selected="false" class=""><i class="fa-solid fa-list"></i></a>
                            </div>
                            <form class="woocommerce-ordering" method="get">
                                <select name="orderby" class="orderby" aria-label="destination order">
                                    <option value="menu_order" selected="selected">Default Sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="tab-grid" role="tabpanel" aria-labelledby="tab-tour-grid">
                            <div class="row gy-24 gx-24">

                                <?php 
                                $pg_no = isset($_GET['pg']) ? $_GET['pg'] : 1;
                                // $pg_no = 1;
                                $limit = 8*$pg_no ;
                                $sql = "SELECT * from tbltourpackages LIMIT $limit";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {	?>

                                <div class="col-md-6">
                                    <div class="tour-box th-ani">
                                        <div class="tour-box_img global-img">
                                            <img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="image">
                                        </div>
                                        <div class="tour-content">
                                            <h3 class="box-title"><a href="index.php?page=tour_details&pkgid=<?php echo htmlentities($result->PackageId);?>"><?php echo htmlentities($result->PackageName);?></a></h3>
                                            <div class="tour-rating">
                                                <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated
                                                        <strong class="rating">5.00</strong> out of 5 based on <span class="rating">4.8</span>(<?php echo htmlentities($result->PackageRate);?>
                                                        Rating)</span></div>
                                                <a href="index.php?page=tour_details&pkgid=<?php echo htmlentities($result->PackageId);?>" class="woocommerce-review-link">(<span class="count">4.8</span>
                                                    Rating)</a>
                                            </div>
                                            <h4 class="tour-box_price"><span class="currency">$<?php echo htmlentities($result->PackagePrice);?></span>/Person</h4>
                                            <div class="tour-action">
                                                <span><i class="fa-light fa-clock"></i><?php echo htmlentities($result->PackageDate);?> Days</span>
                                                <a href="index.php?page=tour_details&pkgid=<?php echo htmlentities($result->PackageId);?>" class="th-btn style4">Detail View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php }} ?>

                                
                            </div>
                        </div>

                        <div class="tab-pane fade " id="tab-list" role="tabpanel" aria-labelledby="tab-tour-list">
                            <div class="row gy-30">
                                
                            <?php 
                                $pg_no = isset($_GET['pg']) ? $_GET['pg'] : 1;
                                // $pg_no = 1;
                                $limit = 8*$pg_no ;
                                $sql = "SELECT * from tbltourpackages LIMIT $limit";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {	?>

                                <div class="col-12">
                                    <div class="tour-box style-flex th-ani">
                                        <div class="tour-box_img global-img">
                                            <img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" alt="image">
                                        </div>
                                        <div class="tour-content">
                                            <h3 class="box-title"><a href="index.php?page=tour_details&pkgid=<?php echo htmlentities($result->PackageId);?>"><?php echo htmlentities($result->PackageName);?></a></h3>
                                            <div class="tour-rating">
                                                <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated
                                                        <strong class="rating">5.00</strong> out of 5 based on <span class="rating">4.8</span>(<?php echo htmlentities($result->PackageRate);?>
                                                        Rating)</span></div>
                                                <a href="index.php?page=tour_details&pkgid=<?php echo htmlentities($result->PackageId);?>" class="woocommerce-review-link">(<span class="count">4.8</span>
                                                    Rating)</a>
                                            </div>
                                            <h4 class="tour-box_price"><span class="currency">$<?php echo htmlentities($result->PackagePrice);?></span>/Person</h4>
                                            <div class="tour-action">
                                                <span><i class="fa-light fa-clock"></i><?php echo htmlentities($result->PackageDate);?> Days</span>
                                                <a href="index.php?page=tour_details&pkgid=<?php echo htmlentities($result->PackageId);?>" class="th-btn style4">Detail View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php }} ?>

                            </div>
                        </div>
                        <div class="th-pagination text-center mt-60">
                            <ul>
                                <li><a class="active" href="index.php?page=blog">1</a></li>
                                <li><a href="index.php?page=blog">2</a></li>
                                <li><a href="index.php?page=blog">3</a></li>
                                <li><a href="index.php?page=blog">4</a></li>
                                <li><a class="next-page" href="index.php?page=blog">Next <img src="assets/img/icon/arrow-right4.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                    <?php include('pages/side_banner.php'); ?>
                    </aside>
                </div>

            </div>

        </div>
        <div class="shape-mockup shape1 d-none d-xxl-block" data-bottom="7%" data-right="8%">
            <img src="assets/img/shape/shape_1.png" alt="shape">
        </div>
        <div class="shape-mockup shape2 d-none d-xl-block" data-bottom="1%" data-right="7%">
            <img src="assets/img/shape/shape_2.png" alt="shape">
        </div>
        <div class="shape-mockup shape3 d-none d-xxl-block" data-bottom="2%" data-right="4%">
            <img src="assets/img/shape/shape_3.png" alt="shape">
        </div>
    </section><!--==============================
	Footer Area
==============================-->