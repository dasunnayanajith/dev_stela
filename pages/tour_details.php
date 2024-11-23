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
                                            $sql = "SELECT PackageImage FROM tms.tbltourpkgimages WHERE imgmaintype = true AND PackageId = :pkgid";
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
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section><!--==============================
	Footer Area
==============================-->