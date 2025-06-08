<div class="widget widget_categories  ">
                            <h3 class="widget_title">Categories</h3>
                            <ul>
                                <?php
                                $sr_no = isset($_GET['sr']) ? $_GET['sr'] : 0;
                                $pg_no = isset($_GET['pg']) ? $_GET['pg'] : 1;
                                $next_pg = $pg_no + 1;

                                $sql = "WITH CTE3 AS (
                                            SELECT TR_id, PackageType 
                                            FROM `tbltourpackages` 
                                            WHERE PackageType IS NOT NULL
                                        ),
                                        CTE4 AS (
                                            SELECT cat_id, category_full 
                                            FROM `tbltourcategories`
                                        ),
                                        CTE5 AS (
                                            SELECT 
                                                CTE3.TR_id, 
                                                CTE3.PackageType, 
                                                CTE4.category_full 
                                            FROM CTE3 
                                            JOIN CTE4 
                                            ON CTE3.PackageType = CTE4.cat_id
                                        )

                                        SELECT 
                                            CTE5.PackageType, 
                                            CTE5.category_full,
                                            COUNT(*) AS total_count
                                        FROM 
                                            CTE5 
                                        GROUP BY 
                                            CTE5.PackageType, 
                                            CTE5.category_full
                                        ORDER BY total_count DESC;
                                        ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {	?>
                                <li>
                                    <a href="index.php?page=tour&cat=<?php echo htmlentities($result->PackageType);?>&sr=<?php $sr_no = isset($_GET['sr']) ? $_GET['sr'] : 0; echo $sr_no;?>&pg=<?php $pg_no = isset($_GET['pg']) ? $_GET['pg'] : 1; echo $pg_no;?>"><img src="assets/img/theme-img/map.svg" alt=""><?php echo htmlentities($result->category_full);?></a>
                                    <span>(<?php echo htmlentities($result->total_count);?>)</span>
                                </li>
                                 <?php }} ?>
                                
                            </ul>
                        </div>
                        <div class="widget  ">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="index.php?page=blog_details"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title"><a class="text-inherit" href="index.php?page=blog_details">Exploring The Green Spaces Of the island maldives</a></h4>
                                        <div class="recent-post-meta">
                                            <a href="index.php?page=blog"><i class="fa-regular fa-calendar"></i>22/6/ 2024</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="index.php?page=blog_details"><img src="assets/img/blog/recent-post-1-2.jpg" alt="Blog Image"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title"><a class="text-inherit" href="index.php?page=blog_details">Harmony With Nature Of Belgium Tour and travle</a></h4>
                                        <div class="recent-post-meta">
                                            <a href="index.php?page=blog"><i class="fa-regular fa-calendar"></i>25/6/ 2024</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="index.php?page=blog_details"><img src="assets/img/blog/recent-post-1-3.jpg" alt="Blog Image"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title"><a class="text-inherit" href="index.php?page=blog_details">Exploring The Green Spaces Of Realar Residence</a></h4>
                                        <div class="recent-post-meta">
                                            <a href="index.php?page=blog"><i class="fa-regular fa-calendar"></i>27/6/ 2024</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="widget widget_tag_cloud  ">
                            <h3 class="widget_title">Popular Tags</h3>
                            <div class="tagcloud">
                                <a href="index.php?page=blog">Tour</a>
                                <a href="index.php?page=blog">Adventure</a>
                                <a href="index.php?page=blog">Rent</a>
                                <a href="index.php?page=blog">Innovate</a>
                                <a href="index.php?page=blog">Hotel</a>
                                <a href="index.php?page=blog">Modern</a>
                                <a href="index.php?page=blog">Luxury</a>
                                <a href="index.php?page=blog">Travel</a>
                            </div>
                        </div> -->
                        <div class="widget widget_offer  " data-bg-src="assets/img/bg/widget_bg_1.jpg">
                            <div class="offer-banner">
                                <div class="offer">
                                    <h6 class="box-title">Need Help? We Are Here To Help You</h6>
                                    <div class="banner-logo">
                                        <img src="assets/img/logo.png" alt="Tourm">
                                    </div>
                                    <div class="offer">
                                        <h6 class="offer-title">You Get Online support</h6>
                                        <a class="offter-num" href="<?php echo $phoneNumber1 ;?>"><?php echo $phoneNumber1 ;?></a>
                                    </div>
                                    <a href="index.php?page=contact" class="th-btn style2 th-icon">Read More</a>
                                </div>
                            </div>
                        </div>