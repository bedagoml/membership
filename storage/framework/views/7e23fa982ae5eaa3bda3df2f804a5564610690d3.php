<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="<?php echo e(route('home')); ?>">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img desktop-logo" alt="logo">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img toggle-logo" alt="logo">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img light-logo" alt="logo">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img light-logo1" height="auto" width="600px" alt="Organization Logo">
						</a><!-- LOGO -->
					</div>
					<ul class="side-menu">
							<li><h3>Main</h3></li>
							<li>
								<a class="side-menu__item"  data-bs-toggle="slide" href="https://demo.claire.co.ke/members"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
							</li>
						
						
						<li><h3>Members</h3></li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('tenant.create')); ?>"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add Member</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('tenant.all')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Members</span></a>
						</li>
						

						<li><h3>Events</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('meeting.index')); ?>"><i class="side-menu__icon fe fe-clock"></i><span class="side-menu__label">Schedule Event</span></a>
							</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('meeting.list')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Events</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('meeting.attendance')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Registration List</span></a>
						</li>
						
						
						<li><h3>Invoices</h3></li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('manualinvoice.create')); ?>"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add Invoice</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('manualinvoice.list')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Invoices</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('manualinvoice.pay')); ?>"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Pay Invoice</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('manualinvoice.payments')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Payments</span></a>
						</li>
						
						<!--<li><h3>Expenses</h3></li>-->
						<!--<li>-->
						<!--	<a class="side-menu__item" href="<?php echo e(route('bill.create')); ?>"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add Expense</span></a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a class="side-menu__item" href="<?php echo e(route('bill.list')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Expense</span></a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a class="side-menu__item" href="<?php echo e(route('bill.pay')); ?>"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Pay Expense</span></a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a class="side-menu__item" href="<?php echo e(route('bill.payments')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Payments</span></a>-->
						<!--</li>-->
						
						<li><h3>Reports</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Members</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<!--<li><a href="<?php echo e(route('tenant.all')); ?>" class="slide-item">Members Details</a></li>-->
								<li><a href="<?php echo e(route('report.tenantform')); ?>" class="slide-item">Members Statements</a></li>
								<!--<li><a href="#" class="slide-item">Meeting Attendance</a></li>-->
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Organization</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php echo e(route('report.incomeform')); ?>" class="slide-item">Income Statement</a></li>
								
	
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-star"></i><span class="side-menu__label">Events</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php echo e(route('report.eventform')); ?>" class="slide-item">Event Statement</a></li>
								
	
							</ul>
						</li>

						<li><h3>Users</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('admin.create')); ?>"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add User</span></a>
						
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('admin.index')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Users</span></a>
						
						</li>
							<li><h3>Settings</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-briefcase"></i><span class="side-menu__label">Subscriptions</span><i class="angle fa fa-angle-right"></i></a>
						    <ul class="slide-menu">
								<li><a href="<?php echo e(route('subscription.create')); ?>" class="slide-item">Add Category</a></li>
								<li><a href="<?php echo e(route('subscription.list')); ?>" class="slide-item"> List Categories</a></li>
	
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">System Settings</span><i class="angle fa fa-angle-right"></i></a>
						
						</li>
						<li><h3>System Operations</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo e(route('logs.index')); ?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Logs</span></a>
						    
						</li>
						
						<li><h3></h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><span class="side-menu__label"></span></a>
						
						</li>
					
						
						
					</ul>
				</aside>
<?php /**PATH C:\xampp\htdocs\membership\rms\resources\views/layouts/side-menu.blade.php ENDPATH**/ ?>