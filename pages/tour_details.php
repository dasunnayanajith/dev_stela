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

     <!--====================================================TEST AREA=======================================================-->

     <div class="tour-gallery-wrapper">
                <h3 class="page-title mt-50 mb-30">From our gallery</h3>
                <div class="row gy-4 gallery-row filter-active">
                    
                <?php 
                // Extract the 'pkgid' from the URL
                $pkgid = isset($_GET['pkgid']) ? $_GET['pkgid'] : null;

                if ($pkgid !== null) {
                    $sql = "SELECT PackageImage FROM tms.tbltourpkgimages WHERE imgmaintype = false AND PackageId = :pkgid";
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
          

 <!--====================================================TEST AREA=======================================================-->
           
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
    </section><!--============================
	Footer Area
==============================-->