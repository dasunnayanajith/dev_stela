<?php
$currentAdminPage = basename($_SERVER['PHP_SELF']);
if (!function_exists('admin_nav_active')) {
	function admin_nav_active($pages, $currentAdminPage)
	{
		if (!is_array($pages)) {
			$pages = [$pages];
		}
		return in_array($currentAdminPage, $pages, true) ? ' class="active"' : '';
	}
}
?>
<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
					<div class="admin-sidebar-brand">
						<a href="dashboard.php">Stelaran</a>
						<span>Admin Console</span>
					</div>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
										<li<?php echo admin_nav_active('dashboard.php', $currentAdminPage); ?>><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
										
									<li<?php echo admin_nav_active(['manage-tours.php', 'manage_highlights.php', 'manage_activities.php', 'package-images.php'], $currentAdminPage); ?>><a href="manage-tours.php"><i class="fa fa-list-ul" aria-hidden="true"></i>  <span>Manage Tours</span><div class="clearfix"></div></a></li>
									<li<?php echo admin_nav_active('manage-gallery.php', $currentAdminPage); ?>><a href="manage-gallery.php"><i class="fa fa-picture-o" aria-hidden="true"></i>  <span>Manage Gallery</span><div class="clearfix"></div></a></li>
									<li<?php echo admin_nav_active('manage-testimonials.php', $currentAdminPage); ?>><a href="manage-testimonials.php"><i class="fa fa-star" aria-hidden="true"></i>  <span>Manage Testimonials</span><div class="clearfix"></div></a></li>
									<li<?php echo admin_nav_active('manage-book-tour-prompts.php', $currentAdminPage); ?>><a href="manage-book-tour-prompts.php"><i class="fa fa-edit" aria-hidden="true"></i>  <span>Book A Tour Prompts</span><div class="clearfix"></div></a></li>
									<li id="menu-academico"<?php echo admin_nav_active('manage-users.php', $currentAdminPage); ?>><a href="manage-users.php"><i class="fa fa-users" aria-hidden="true"></i><span>Manage Users</span><div class="clearfix"></div></a></li>
									
									<li<?php echo admin_nav_active('manage-bookings.php', $currentAdminPage); ?>><a href="manage-bookings.php"><i class="fa fa-list" aria-hidden="true"></i>  <span>Manage Booking</span><div class="clearfix"></div></a></li>
									 <li<?php echo admin_nav_active(['manageissues.php', 'updateissue.php'], $currentAdminPage); ?>><a href="manageissues.php"><i class="fa fa-table"></i>  <span>Manage Issues</span><div class="clearfix"></div></a></li>
									<li<?php echo admin_nav_active('manage-enquires.php', $currentAdminPage); ?>><a href="manage-enquires.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>  <span>Manage Enquiries</span><div class="clearfix"></div></a></li>
									<li<?php echo admin_nav_active('manage-pages.php', $currentAdminPage); ?>><a href="manage-pages.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>  <span>Manage Pages</span><div class="clearfix"></div></a></li>
							     
									
								  </ul>
								</div>
							  </div>
