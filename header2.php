<?php
// Assigning phone number to a variable
$phoneNumber1 = "+94766610222";
$phoneNumber2 = "+94703660222";
$email1 = "info@stelaranholidays.com";
$email2 = "stelaranholidays@gmail.com";
$address = " 54/9/1, 3rd Lane, Hansagiri Rd, Gampaha, Sri Lanka";
$companyshort = "Stelaran Holidays";
$quote = "Your Holiday Your Choice. Miracle of Indian Ocean, discover Sri Lanka with us, Land like no other land.";

?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Stelaran Holidays</title>
    <meta name="author" content="Tourm">
    <meta name="description" content="Tourm - Travel & Tour Booking Agency HTML Template ">
    <meta name="keywords" content="Tourm - Travel & Tour Booking Agency HTML Template ">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&family=Montez&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">

    <!-- Swiper css -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .person-selector-input {
            padding: 10px;
            font-size: 14px;
            width: 220px;
            cursor: pointer;
            text-align: center;
        }
        .person-selector-popup {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            padding: 15px;
            width: 250px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .person-selector-popup.active {
            display: block;
        }
        .counter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .counter-container label {
            font-size: 14px;
        }
        .counter-buttons {
            display: flex;
            gap: 10px;
        }
        .counter-buttons button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->

    <div class="magic-cursor relative z-10">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>


    <!--==============================
     Preloader
  ==============================-->
    <div id="preloader" class="preloader ">
        <button class="th-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <img src="assets/img/logo.png" alt="">
        </div>

        <div id="loader" class="th-preloader">
            <div class="animation-preloader">
                <div class="txt-loading">
                    <span preloader-text="S" class="characters">S </span>

                    <span preloader-text="T" class="characters">T </span>

                    <span preloader-text="E" class="characters">E </span>

                    <span preloader-text="L" class="characters">L </span>

                    <span preloader-text="A" class="characters">A </span>
                    <span preloader-text="R" class="characters">R </span>
                    <span preloader-text="A" class="characters">A </span>
                    <span preloader-text="N" class="characters">N </span>
                </div>
            </div>
        </div>

    </div> <!--==============================
    Sidemenu
============================== -->
    <div class="sidemenu-wrapper sidemenu-info ">
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
            <div class="widget  ">
                <div class="th-widget-about">
                    <div class="about-logo">
                        <a href="index.php?page=home_travel"><img src="assets/img/logo.png" alt="Tourm"></a>
                    </div>
                    <p class="about-text"><?php echo $quote ;?></p>
                    <div class="th-social">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <div class="widget  ">
                <h3 class="widget_title">Get In Touch</h3>
                <div class="th-widget-contact">
                    <div class="info-box_text">
                        <div class="icon">
                            <img src="assets/img/icon/phone.svg" alt="img">
                        </div>
                        <div class="details">
                            <p><a href="tel:+01234567890" class="info-box_link"><?php echo $phoneNumber1 ;?></a></p>
                            <p><a href="tel:+09876543210" class="info-box_link"><?php echo $phoneNumber2 ;?></a></p>
                        </div>
                    </div>
                    <div class="info-box_text">
                        <div class="icon">
                            <img src="assets/img/icon/envelope.svg" alt="img">
                        </div>
                        <div class="details">
                            <p><a href="mailto:mailinfo00@tourm.com" class="info-box_link"><?php echo $email1 ;?></a></p>
                            <p><a href="mailto:support24@tourm.com" class="info-box_link"><?php echo $email2 ;?></a></p>
                        </div>
                    </div>
                    <div class="info-box_text">
                        <div class="icon"><img src="assets/img/icon/location-dot.svg" alt="img"></div>
                        <div class="details">
                            <p><?php echo $address ;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-search-box">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" placeholder="What are you looking for?">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div><!--==============================
    Mobile Menu
  ============================== -->
    <div class="th-menu-wrapper onepage-nav">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="index.php?page=home_travel"><img src="assets/img/logo.png" alt="Tourm"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php?page=about">About Us</a></li>
                    <li><a href="index.php?page=tour">Our Tour</a></li>
                    <li><a href="index.php?page=service">Services</a></li>
                    <li><a href="index.php?page=tailormade_tours">Tailor-Made Tours</a></li>
                    <li><a href="index.php?page=gallery">Gallery</a></li>
                    <li><a href="index.php?page=blog">Blog</a></li>
                    <li><a href="index.php?page=contact">Contact us</a></li>
                </ul>
            </div>
        </div>
    </div><!--==============================
	Header Area
==============================-->
    <header class="th-header header-layout3 header-absolute">
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <nav class="main-menu d-none d-xl-block">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="index.php?page=about">About Us</a></li>
                                    <li><a href="index.php?page=tour">Our Tour</a></li>
                                    <li><a href="index.php?page=service">Services</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="index.php?page=index">
                                    <img src="assets/img/logo.png" alt="Tourm">
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <nav class="main-menu d-none d-xl-block">
                                <ul>
                                    <li><a href="index.php?page=tailormade_tours">Tailor-Made Tours</a></li>
                                    <li><a href="index.php?page=gallery">Gallery</a></li>
                                    <li><a href="index.php?page=blog">Blog</a></li>
                                    <li><a href="index.php?page=contact">Contact us</a></li>
                                </ul>
                            </nav>
                            <button type="button" class="th-menu-toggle d-block d-xl-none"><i class="far fa-bars"></i></button>
                        </div>
                    </div>
                </div>
                <div class="header-right-button">
                    <a href="#" class="simple-btn sideMenuToggler"><img src="assets/img/icon/menu.svg" alt=""></a>
                </div>
            </div>
        </div>
    </header>
