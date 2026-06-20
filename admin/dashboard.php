<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$adminStats = [
	'users' => 0,
	'bookings' => 0,
	'enquiries' => 0,
	'packages' => 0,
	'issues' => 0,
];
$adminCountQueries = [
	'users' => 'SELECT id FROM tblusers',
	'bookings' => 'SELECT BookingId FROM tblbooking',
	'enquiries' => 'SELECT id FROM tblenquiry',
	'packages' => 'SELECT PackageId FROM tbltourpackages',
	'issues' => 'SELECT id FROM tblissues',
];
foreach ($adminCountQueries as $statKey => $statSql) {
	$statQuery = $dbh->prepare($statSql);
	$statQuery->execute();
	$adminStats[$statKey] = $statQuery->rowCount();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
<!--header start here-->
<?php include('includes/header.php');?>
<!--header end here-->
		<ol class="breadcrumb admin-dashboard-crumb">
			<li class="breadcrumb-item"><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a> <i class="fa fa-angle-right"></i> <strong>Dashboard</strong></li>
		</ol>

		<div class="admin-dashboard-heading">
			<h2>System Overview</h2>
			<p>Real-time performance metrics and active management statistics.</p>
		</div>

		<div class="admin-metric-grid">
			<div class="admin-metric-card metric-users">
				<div class="admin-metric-top">
					<span>Users</span>
					<i class="fa fa-user-o" aria-hidden="true"></i>
				</div>
				<strong><?php echo htmlentities($adminStats['users']); ?></strong>
				<small><i class="fa fa-plus" aria-hidden="true"></i> 2 this month</small>
			</div>
			<div class="admin-metric-card metric-bookings">
				<div class="admin-metric-top">
					<span>Bookings</span>
					<i class="fa fa-calendar-o" aria-hidden="true"></i>
				</div>
				<strong><?php echo htmlentities($adminStats['bookings']); ?></strong>
				<small><i class="fa fa-clock-o" aria-hidden="true"></i> Next in 2 days</small>
			</div>
			<div class="admin-metric-card metric-enquiries">
				<div class="admin-metric-top">
					<span>Enquiries</span>
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
				</div>
				<strong><?php echo htmlentities($adminStats['enquiries']); ?></strong>
				<small><i class="fa fa-bolt" aria-hidden="true"></i> Quick response active</small>
			</div>
			<div class="admin-metric-card metric-packages">
				<div class="admin-metric-top">
					<span>Packages</span>
					<i class="fa fa-archive" aria-hidden="true"></i>
				</div>
				<strong><?php echo htmlentities($adminStats['packages']); ?></strong>
				<small><i class="fa fa-folder-open-o" aria-hidden="true"></i> Across 8 categories</small>
			</div>
			<div class="admin-metric-card metric-issues">
				<div class="admin-metric-top">
					<span>Issues</span>
					<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
				</div>
				<strong><?php echo htmlentities($adminStats['issues']); ?></strong>
				<small><i class="fa fa-dot-circle-o" aria-hidden="true"></i> 3 critical priority</small>
			</div>
		</div>

		<div class="admin-dashboard-layout">
			<section class="admin-panel admin-activity-panel">
				<div class="admin-panel-header">
					<h3>Activity Feed</h3>
					<a href="manage-users.php">View All Records</a>
				</div>
				<div class="admin-activity-list">
					<div class="admin-activity-item">
						<span class="admin-activity-icon activity-user"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
						<div>
							<p><strong>New User Registration:</strong> Sarah Jenkins joined the platform.</p>
							<small>2 hours ago • Marketing Agent</small>
						</div>
						<span class="admin-pill">System</span>
					</div>
					<div class="admin-activity-item">
						<span class="admin-activity-icon activity-booking"><i class="fa fa-ticket" aria-hidden="true"></i></span>
						<div>
							<p><strong>Booking Confirmed:</strong> Grand Canyon Helicopter Tour (#BK-9042).</p>
							<small>5 hours ago • Customer: David Miller</small>
						</div>
						<span class="admin-pill priority">Priority</span>
					</div>
					<div class="admin-activity-item">
						<span class="admin-activity-icon activity-issue"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
						<div>
							<p><strong>Issue Reported:</strong> Payment gateway timeout on mobile devices.</p>
							<small>Yesterday • Reported by 3 users</small>
						</div>
						<span class="admin-pill unresolved">Unresolved</span>
					</div>
				</div>
			</section>

			<aside class="admin-dashboard-rail">
				<section class="admin-panel admin-distribution-panel">
					<h3>Tour Distribution</h3>
					<div class="admin-bar-row">
						<div><span>Adventure Tours</span><strong>45%</strong></div>
						<span class="admin-track"><span style="width:45%"></span></span>
					</div>
					<div class="admin-bar-row city">
						<div><span>City Excursions</span><strong>30%</strong></div>
						<span class="admin-track"><span style="width:30%"></span></span>
					</div>
					<div class="admin-bar-row luxury">
						<div><span>Luxury Retreats</span><strong>25%</strong></div>
						<span class="admin-track"><span style="width:25%"></span></span>
					</div>
				</section>

				<section class="admin-quick-actions">
					<h3>Quick Actions</h3>
					<div>
						<a href="create-package.php"><i class="fa fa-plus-circle" aria-hidden="true"></i><span>New Tour</span></a>
						<a href="manage-book-tour-prompts.php"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Newsletter</span></a>
					</div>
				</section>
			</aside>
		</div>


<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
</div>
</div>

			<!--/sidebar-menu-->
				<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#E1E4E5',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2014 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2014 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2014 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2014 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2015 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2015 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2015 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2015 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2016 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
				{period: '2016 Q2', iphone: 8442, ipad: 5723, itouch: 1801}
			],
			lineColors:['#1CA8CB','#113D48','#FFB539'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
</body>
</html>
<?php } ?>
