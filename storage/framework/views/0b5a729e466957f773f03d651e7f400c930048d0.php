<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="<?php echo e(route('home')); ?>">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img desktop-logo" alt="logo">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img toggle-logo" alt="logo">
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img light-logo" alt="logo">
							<!--<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo-3.png')); ?>" class="header-brand-img light-logo1" alt="logo">-->
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo2.png')); ?>" class="header-brand-img light-logo1" alt="Organization Logo">
						</a><!-- LOGO -->
					</div>
					<ul class="side-menu">
						<li><h3>Main</h3></li>
						<li class="slide">
							<a class="side-menu__item"  data-bs-toggle="slide" href="<?php echo e(route('tenant-home')); ?>"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li><h3>Payment Procedure</h3></li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('pay.instruction')); ?>"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">How to Pay</span></a>
						</li>
						<li><h3>Invoices</h3></li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('user.manualinvoice.list')); ?>"><i class="side-menu__icon fe fe-file"></i><span class="side-menu__label">My Invoices</span></a>
						</li>

						<li><h3>Events</h3></li>
						<li>
							<a class="side-menu__item" href="<?php echo e(route('user.events.list')); ?>"><i class="side-menu__icon fe fe-star"></i><span class="side-menu__label">Events</span></a>
						</li>
						
						<!--<li><h3>My Activities</h3></li>-->
						<!--<li>-->
						<!--	<a class="side-menu__item" href="<?php echo e(route('attend_meeting.attendance')); ?>"><i class="side-menu__icon fe fe-book"></i><span class="side-menu__label">Roll Call</span></a>-->
						<!--</li>-->
      <!--                  <li>-->
						<!--	<a class="side-menu__item" href="#"><i class="side-menu__icon fe fe-circle"></i><span class="side-menu__label">Logs</span></a>-->
						<!--</li>-->
					</ul>
				</aside>
<?php /**PATH /home/democlai/public_html/members/rms/resources/views/layouts/side-menu2.blade.php ENDPATH**/ ?>