    <!--==============================
    Breadcumb
============================== -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Contact Us</h1>
                <ul class="breadcumb-menu">
                    <li><a href="home-travel.html">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
Contact Area  
==============================-->
    <div class="space">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">Get In Touch</span>
                <h2 class="sec-title">Our Contact Information</h2>
            </div>
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="about-contact-grid style2">
                        <div class="about-contact-icon">
                            <img src="assets/img/icon/location-dot2.svg" alt="">
                        </div>
                        <div class="about-contact-details">
                            <h6 class="box-title">Our Address</h6>
                            <p class="about-contact-details-text"><?php echo $address ;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="about-contact-grid">
                        <div class="about-contact-icon">
                            <img src="assets/img/icon/call.svg" alt="">
                        </div>
                        <div class="about-contact-details">
                            <h6 class="box-title">Phone Number</h6>
                            <p class="about-contact-details-text"><a href="tel:<?php echo $phoneNumber1 ;?>"><?php echo $phoneNumber1 ;?></a></p>
                            <p class="about-contact-details-text"><a href="tel:<?php echo $phoneNumber2 ;?>"><?php echo $phoneNumber2 ;?></a></p>
                        </div>
                    </div>          
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="about-contact-grid">
                        <div class="about-contact-icon">
                            <img src="assets/img/icon/mail.svg" alt="">
                        </div>
                        <div class="about-contact-details">
                            <h6 class="box-title">Email Address</h6>
                            <p class="about-contact-details-text"><a href="mailto:<?php echo $email1 ;?>"><?php echo $email1 ;?></a></p>
                            <p class="about-contact-details-text"><a href="mailto:<?php echo $email2 ;?>"><?php echo $email2 ;?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'pages/map_book_now.php'; ?>
