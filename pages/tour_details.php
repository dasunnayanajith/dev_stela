<!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Tour Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php?page=home-travel">Home</a></li>
                    <li>Tour Details</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
tour Area
==============================-->
    <section class="space">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    <div class="tour-page-single">
                        <div class="slider-area tour-slider1">
                            <div class="swiper th-slider mb-4" id="tourSlider4" data-slider-options='{"effect":"fade","loop":true,"thumbs":{"swiper":".tour-thumb-slider"},"autoplayDisableOnInteraction":"true"}'>
                                <div class="swiper-wrapper">
                                    <?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    $sql = "SELECT  `PackageImage` FROM `tbltourpkgimages` WHERE `imgtype` = true and `PackageId` = :pkgid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Check if any records were found
    if ($query->rowCount() > 0) {
        // Loop through and display the records
        foreach ($results as $result) { ?>
            <div class="swiper-slide">
                <div class="tour-slider-img">
                    <img src="admin/img/pkgImages/galary_main/<?php echo htmlspecialchars($result->PackageImage);?>" alt="img">
                </div>
            </div>
            <?php 
        }
    } else {
        echo "No records found for Package ID: " . htmlspecialchars($pkgid);
    }
} else {
    echo "Package ID not found in the URL.";
}
?>
                                </div>
                            </div>
                            <div class="swiper th-slider tour-thumb-slider" data-slider-options='{"effect":"slide","loop":true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}},"autoplayDisableOnInteraction":"true"}'>
                                <div class="swiper-wrapper">

                                    <?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    $sql = "SELECT  `PackageImage` FROM `tbltourpkgimages` WHERE `imgtype` = true and `PackageId` = :pkgid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Check if any records were found
    if ($query->rowCount() > 0) {
        // Loop through and display the records
        foreach ($results as $result) { ?>
            <div class="swiper-slide">
                <div class="tour-slider-img">
                    <img src="admin/img/pkgImages/galary_main/<?php echo htmlspecialchars($result->PackageImage);?>" alt="Image">
                </div>
            </div>
            <?php 
        }
    } else {
        echo "No records found for Package ID: " . htmlspecialchars($pkgid);
    }
} else {
    echo "Package ID not found in the URL.";
}
?>
                                </div>
                            </div>

                            <button data-slider-prev="#tourSlider4" class="slider-arrow style3 slider-prev"><img src="assets/img/icon/hero-arrow-left.svg" alt=""></button>
                            <button data-slider-next="#tourSlider4" class="slider-arrow style3 slider-next"><img src="assets/img/icon/hero-arrow-right.svg" alt=""></button>
                        </div>
                        <?php 
        $pid=intval($_GET['pkgid']);
        $sql = "SELECT * FROM `tbltourpackages` WHERE `PackageId` = :pid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
        foreach($results as $result)
        {	?>
                        <div class="page-content">
                            <div class="page-meta mb-45">
                                <a class="page-tag" href="index.php?page=tour">Featured : <?php echo htmlentities($result->PackageRate);?></a>
                                <span class="ratting"><i class="fa-sharp fa-solid fa-star"></i><span><?php echo htmlentities($result->PackageRate);?></span></span>
                            </div>
                            <h2 class="box-title"><?php echo htmlentities($result->PackageName);?></h2>
                            <h4 class="tour-price"><span class="currency">$<?php echo htmlentities($result->PackagePrice);?></span>/Person</h4>
                            <p class="box-text mb-30"><?php echo htmlentities($result->PackageDetails);?></p>
                            <h2 class="box-title">Basic Information</h2>
                            <p class="blog-text mb-35"><?php echo htmlentities($result->PackageFetures);?></p>
                            <div class="destination-checklist mb-50">

                            

                               <div class="checklist style2">
                                    <ul>
                                        <li>Pickup Location</li>
                                        <li>Operated In</li>
                                        <li>Physical Rating</li>
                                        <li>Max Group Size</li>
                                        <li>Age Range</li>
                                    </ul>
                                </div>
                                <div class="checklist style2">
                                    <ul>
                                        <li><?php echo htmlentities($result->PackagePickup);?></li>
                                        <li><?php echo htmlentities($result->PackageLanguage);?></li>
                                        <li><?php echo htmlentities($result->PackagePhysicalRating);?></li>
                                        <li><?php echo htmlentities($result->PackageGroupSize);?></li>
                                        <li><?php echo htmlentities($result->PackageAgeRange);?></li>                                        
                                    </ul>
                                </div> 
                            </div>
                            <h2 class="box-title">Highlights</h2>
                
                            <div class="checklist mb-50">
                                <ul>
                                <?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    $sql = "SELECT `HighlightItem` FROM `tbltourpkghiglight` WHERE `PackageId`= :pkgid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Check if any records were found
    if ($query->rowCount() > 0) {
        // Loop through and display the records
        foreach ($results as $result) { ?>
            <li><?php echo htmlspecialchars($result->HighlightItem);?></li>
            <?php 
        }
    } else {
        echo "No records found for Package ID: " . htmlspecialchars($pkgid);
    }
} else {
    echo "Package ID not found in the URL.";
}
?>
                                </ul>
                            </div>
                            <h2 class="box-title">Included and Excluded</h2>
                            <div class="destination-checklist">
                            <?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    // SQL query to fetch the boolean values for the package
    $sql = "SELECT `Accommodation`, `Guide`, `Insurance`, `Meals`, `Transport`, `Flights`, `Safari Jeep` FROM `tbltourpkginexclude` WHERE  `PackageId` = :pkgid";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Check if any record was found
    if ($result) {
        // Arrays to hold the true and false items
        $includedItems = [];
        $excludedItems = [];

        // Loop through the result and categorize items based on boolean values
        foreach ($result as $item => $isIncluded) {
            if ($isIncluded) {
                $includedItems[] = $item;
            } else {
                $excludedItems[] = $item;
            }
        }
        ?>

        <!-- Display the Included Items -->
        <div class="checklist style2 style4">
            <ul>
                <?php foreach ($includedItems as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Display the Excluded Items -->
        <div class="checklist style5">
            <ul>
                <?php foreach ($excludedItems as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php
    } else {
        echo "No records found for Package ID: " . htmlspecialchars($pkgid);
    }
} else {
    echo "Package ID not found in the URL.";
}
?>
                            </div>

        <!--==================Date====================== -->




                            <h3 class="page-title mt-50 mb-0">Tour Plan</h3>
                            <ul class="nav nav-tabs tour-tab mt-10" role="tablist">
                                
<?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    $sql = "SELECT DISTINCT `DateId` FROM `tbltouractivities` WHERE `PackageId` = :pkgid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Check if any records were found
    if ($query->rowCount() > 0) {
        // Loop through and display the records
        foreach ($results as $result) {
            // Determine the label to display for the day
            $dayLabel = ($result->DateId >= 1 && $result->DateId <= 9) ? 'Day 0' . $result->DateId : 'Day ' . $result->DateId;
            
            if ($result->DateId == 1) {
                // Special case for DateId = 1
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="day-tab1" data-bs-toggle="tab" data-bs-target="#day-tab1-pane" type="button" role="tab" aria-controls="day-tab1-pane" aria-selected="true"><?php echo htmlspecialchars($dayLabel); ?></button>
                </li>
                <?php
            } else {
                // Default case for other DateIds
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="day-tab<?php echo htmlspecialchars($result->DateId);?>" data-bs-toggle="tab" data-bs-target="#day-tab<?php echo htmlspecialchars($result->DateId);?>-pane" type="button" role="tab" aria-controls="day-tab<?php echo htmlspecialchars($result->DateId);?>-pane" aria-selected="false"><?php echo htmlspecialchars($dayLabel); ?></button>
                </li>
                <?php
            }
        }
    } else {
        echo "No records found for Package ID: " . htmlspecialchars($pkgid);
    }
} else {
    echo "Package ID not found in the URL.";
}
?>


                                
                            </ul>
                            <div class="tab-content">

                            <?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    $sql = "SELECT `DateId`, `ActivityName` FROM `tbltouractivities` WHERE `PackageId` = :pkgid ORDER BY `DateId` ASC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Organize the results by DateId
    $activitiesByDay = [];
    foreach ($results as $result) {
        $activitiesByDay[$result->DateId][] = $result->ActivityName;
    }

    // Loop through each DateId and display the records
    foreach ($activitiesByDay as $dateId => $activities) {
        // Determine the label to display for the day
        $dayLabel = ($dateId >= 1 && $dateId <= 9) ? 'Day 0' . $dateId : 'Day ' . $dateId;

        // Check if it's the first day (DateId = 1)
        $activeClass = ($dateId == 1) ? 'show active' : 'show';
        ?>
        <div class="tab-pane fade <?php echo $activeClass; ?>" id="day-tab<?php echo htmlspecialchars($dateId); ?>-pane" role="tabpanel" aria-labelledby="day-tab<?php echo htmlspecialchars($dateId); ?>" tabindex="0">
            <div class="tour-grid-plan">
                <div class="checklist">
                    <ul>
                        <?php foreach ($activities as $activityName) { ?>
                            <li><?php echo htmlspecialchars($activityName); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "Package ID not found in the URL.";
}
?>
                        



                            </div>
                <!--==================Date-END====================== -->
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        <div class="widget widget_search  ">
                            <form class="search-form">
                                <input type="text" placeholder="Search">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <?php include('pages/side_banner.php'); ?>
                    </aside>
                </div>

            </div>
            <div class="tour-gallery-wrapper">
                <h3 class="page-title mt-50 mb-30">From our gallery</h3>
                <div class="row gy-4 gallery-row filter-active">
                    
                <?php 
// Extract the 'pkgid' from the URL
$pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

if ($pkgid !== null) {
    $sql = "SELECT `PackageImage` FROM `tbltourpkgimages` WHERE `imgtype` = false AND `PackageId` = :pkgid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pkgid', $pkgid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Check if any records were found
    if ($query->rowCount() > 0) {
        // Loop through and display the records
        foreach ($results as $result) { ?>
            <div class="col-md-6 col-xl-auto filter-item">
                <div class="tour-gallery-card">
                    <div class="gallery-img global-img">
                        <img src="admin/img/pkgImages/galary_sub/<?php echo htmlspecialchars($result->PackageImage);?>" alt="gallery image">
                        <a href="admin/img/pkgImages/galary_sub/<?php echo htmlspecialchars($result->PackageImage);?>" class="icon-btn popup-image"><i class="fal fa-magnifying-glass-plus"></i></a>
                    </div>
                </div>
            </div>
            <?php 
        }
    } else {
        echo "No records found for Package ID: " . htmlspecialchars($pkgid);
    }
} else {
    echo "Package ID not found in the URL.";
}
?>

                </div>
            </div>
            <?php }} ?>

           
            <div class="location-map">
                <h3 class="page-title mt-45 mb-30">Location</h3>
                <div class="contact-map style3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1979.6639938990295!2d80.017571!3d7.087925!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1723311068981!5m2!1sen!2slk" allowfullscreen="" loading="lazy"></iframe>
                    <div class="contact-icon">
                        <img src="assets/img/icon/location-dot3.svg" alt="">
                    </div>
                </div>
            </div>

        </div>
        <div class="shape-mockup about-shape movingX d-none d-xxl-block" data-bottom="40%" data-right="17%">
            <img src="assets/img/normal/about-slide-img.png" alt="shape">
        </div>
        <div class="shape-mockup about-rating d-none d-xxl-block" data-bottom="48%" data-right="12%">
            <i class="fa-sharp fa-solid fa-star"></i><span>4.9k</span>
        </div>
        <div class="shape-mockup about-emoji d-none d-xxl-block" data-bottom="45%" data-right="29%"><img src="assets/img/icon/emoji.png" alt="">
        </div>
        <div class="shape-mockup shape1 d-none d-xxl-block" data-bottom="55%" data-right="12%">
            <img src="assets/img/shape/shape_1.png" alt="shape">
        </div>
        <div class="shape-mockup shape2 d-none d-xl-block" data-bottom="51%" data-right="8%">
            <img src="assets/img/shape/shape_2.png" alt="shape">
        </div>
        <div class="shape-mockup shape3 d-none d-xxl-block" data-bottom="53%" data-right="5%">
            <img src="assets/img/shape/shape_3.png" alt="shape">
        </div>
    </section><!--==============================
	Footer Area
==============================-->