<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="{{ route('home')}}">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img desktop-logo" alt="logo">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img toggle-logo" alt="logo">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img light-logo" alt="logo">
							<!--<img src="{{URL::asset('assets/assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1" alt="logo">-->
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img light-logo1" alt="Organization Logo">
						</a><!-- LOGO -->
					</div>
					<ul class="side-menu">
						<li><h3>Main</h3></li>
						<li class="slide">
							<a class="side-menu__item"  data-bs-toggle="slide" href="{{ route('tenant-home')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li><h3>Payment Procedure</h3></li>
						<li>
							<a class="side-menu__item" href="{{route('pay.instruction')}}"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">How to Pay</span></a>
						</li>
						<li><h3>Invoices</h3></li>
						<li>
							<a class="side-menu__item" href="{{route('user.manualinvoice.list')}}"><i class="side-menu__icon fe fe-file"></i><span class="side-menu__label">My Invoices</span></a>
						</li>

						<li><h3>Meetings</h3></li>
						<li>
							<a class="side-menu__item" href="{{route('user.events.list')}}"><i class="side-menu__icon fe fe-star"></i><span class="side-menu__label">Events</span></a>
						</li>
						<li><h3>Donations</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Happy Hundred</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('user_contribution.pay') }}" class="slide-item">Pay Happy Hundred</a></li>
								<li><a href="{{ route('user_happy_hundreds.list') }}" class="slide-item"> List Payments</a></li> 
	
							</ul>
						</li>
						
						<!--<li><h3>My Activities</h3></li>-->
						<!--<li>-->
						<!--	<a class="side-menu__item" href="{{route('attend_meeting.attendance')}}"><i class="side-menu__icon fe fe-book"></i><span class="side-menu__label">Roll Call</span></a>-->
						<!--</li>-->
      <!--                  <li>-->
						<!--	<a class="side-menu__item" href="#"><i class="side-menu__icon fe fe-circle"></i><span class="side-menu__label">Logs</span></a>-->
						<!--</li>-->
					</ul>
				</aside>
