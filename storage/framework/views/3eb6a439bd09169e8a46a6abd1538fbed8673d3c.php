
						<!--/app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
									<a class="header-brand1 d-flex d-md-none" href="index.html">
										<img src="" class="header-brand-img desktop-logo" alt="organiztion logo">
										<img src="" class="header-brand-img toggle-logo" alt="organiztion logo">
										<img src="" class="header-brand-img light-logo" alt="organiztion logo">
										<img src="" class="header-brand-img light-logo1" alt="organiztion logo">
									</a><!-- LOGO -->
									<!--<div class="main-header-center ms-3 d-none d-md-block">-->
									<!--	<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>-->
									<!--</div>-->
									<div class="d-flex order-lg-2 ms-auto header-right-icons">
										<div class="dropdown d-lg-none d-md-block d-none">
											<a href="#" class="nav-link icon" data-bs-toggle="dropdown">
												<i class="fe fe-search"></i>
											</a>
											<div class="dropdown-menu header-search dropdown-menu-start">
												<div class="input-group w-100 p-2">
													<input type="text" class="form-control" placeholder="Search....">
													<div class="input-group-text btn btn-primary">
														<i class="fa fa-search" aria-hidden="true"></i>
													</div>
												</div>
											</div>
										</div>
										<!-- SEARCH -->
										<button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
											<span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
										</button>
										<!--<div class="dropdown d-none d-md-flex">-->
										<!--	<a class="nav-link icon theme-layout nav-link-bg layout-setting">-->
										<!--		<span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dark Theme"><i class="fe fe-moon"></i></span>-->
										<!--		<span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Light Theme"><i class="fe fe-sun"></i></span>-->
										<!--	</a>-->
										<!--</div>-->
										<!-- Theme-Layout -->
										<!--<div class="dropdown d-none d-md-flex">-->
										<!--	<a class="nav-link icon full-screen-link nav-link-bg">-->
										<!--		<i class="fe fe-minimize fullscreen-button"></i>-->
										<!--	</a>-->
										<!--</div>-->
										<!-- FULL-SCREEN -->
										<div class="dropdown d-none d-md-flex profile-1">
											<a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
												<span>
													<img src="<?php echo e(URL::asset('assets/assets/images/users/8.jpg')); ?>" alt="profile-user" class="avatar  profile-user brround cover-image">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
												<div class="drop-heading">
													<div class="text-center">
                                                       
														<small class="text-muted">Member</small>
													</div>
												</div>
												<div class="dropdown-divider m-0"></div>
												<a class="dropdown-item" href="#">
													<i class="dropdown-icon fe fe-user"></i> Profile
												</a>
												
												
												
												<a class="dropdown-item" href="<?php echo e(route('tenant.logout')); ?>"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
													<i class="dropdown-icon fe fe-alert-circle"></i> Sign out
												</a>
												 <form id="logout-form" action="<?php echo e(route('tenant.logout')); ?>" method="POST" style="display: none;">
									<?php echo csrf_field(); ?>
								</form>
											</div>
										</div>
										
										<!-- SIDE-MENU -->
									</div>
								</div>
							</div>
						</div>
						<?php /**PATH C:\xampp\htdocs\membership\rms\resources\views/layouts/header2.blade.php ENDPATH**/ ?>