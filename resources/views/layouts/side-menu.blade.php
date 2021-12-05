<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="{{ route('home')}}">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img desktop-logo" alt="logo">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img toggle-logo" alt="logo">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img light-logo" alt="logo">
							<img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" class="header-brand-img light-logo1" height="auto" width="600px" alt="Organization Logo">
						</a><!-- LOGO -->
					</div>
					<ul class="side-menu">
							<li><h3>Main</h3></li>
							<li>
								<a class="side-menu__item"  data-bs-toggle="slide" href="https://demo.claire.co.ke/members"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
							</li>
						
						@if(Auth::user()->member_creating==1 || Auth::user()->member_viewing==1 || Auth::user()->member_editing_delete==1  )
						<li><h3>Members</h3></li>
							@if(Auth::user()->member_creating==1  )
						<li>
							<a class="side-menu__item" href="{{route('tenant.create')}}"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add Member</span></a>
						</li>
					     	@endif
					     	@if(Auth::user()->member_viewing==1 || Auth::user()->member_editing_delete==1  )
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('tenant.all') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Members</span></a>
						</li>
						    @endif
						@endif
						
                        @if(Auth::user()->event_creating==1 || Auth::user()->event_viewing==1 || Auth::user()->event_editing_delete==1  )
						<li><h3>Events</h3></li>
						@if(Auth::user()->event_creating==1  )
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{route('meeting.index')}}"><i class="side-menu__icon fe fe-clock"></i><span class="side-menu__label">Schedule Meeting</span></a>
							</li>
						@endif
						@if(Auth::user()->event_viewing==1 || Auth::user()->event_editing_delete==1  )
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('meeting.list') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Meeting</span></a>
						</li>
						@endif
						@endif
						@if(Auth::user()->report_viewing==1 )
						<li><h3>Donations</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-credit-card"></i><span class="side-menu__label">Projects</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<!--<li><a href="{{ route('tenant.all') }}" class="slide-item">Members Details</a></li>-->
								<li><a href="{{ route('contribution_project.index') }}" class="slide-item">Create Project</a></li>
								
								<li><a href="{{route('contribution_project.list')}}" class="slide-item">List Projects</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Happy Hundred</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('contribution.pay') }}" class="slide-item">Pay Happy Hundred</a></li>
								<li><a href="{{ route('happy_hundreds.list') }}" class="slide-item"> List Payments</a></li> 
	
							</ul>
						</li>
						{{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-star"></i><span class="side-menu__label">Events</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('report.eventform') }}" class="slide-item"></a></li>
								<li><a href="{{ route('report.agency_status') }}" class="slide-item"> Agency Status</a></li>
	
							</ul>
						</li> --}}
						@endif
						<!--<li class="slide">-->
						<!--	<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('meeting.attendance') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Registration List</span></a>-->
						<!--</li>-->
						
						@if(Auth::user()->invoice_creating==1 || Auth::user()->invoice_viewing==1 || Auth::user()->invoice_editing_delete==1  )
						<li><h3>Invoices</h3></li>
						@if(Auth::user()->invoice_creating==1  )
						<li>
							<a class="side-menu__item" href="{{ route('manualinvoice.create') }}"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add Invoice</span></a>
						</li>
						@endif
						@if(Auth::user()->invoice_viewing==1 || Auth::user()->invoice_editing_delete==1  )
						<li>
							<a class="side-menu__item" href="{{ route('manualinvoice.list') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Invoices</span></a>
						</li>
						@endif
						@if(Auth::user()->member_creating==1)
						<li>
							<a class="side-menu__item" href="{{ route('manualinvoice.pay') }}"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Pay Invoice</span></a>
						</li>
						@endif
						@endif
						<li>
						<a class="side-menu__item" href="{{ route('manualinvoice.payments') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Payments</span></a>
						</li>
						{{-- <li>
							<a class="side-menu__item" href="{{ route('manualinvoice.paymentlist') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Approve Expense</span></a>
						</li>  --}}
						<li><h3>Expenses</h3></li>
						<li>
							<a class="side-menu__item" href="{{ route('bill.create') }}"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add Expense</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{ route('bill.list') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Expense</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{ route('bill.pay') }}"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Pay Expense</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{ route('bill.payments') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Payments</span></a>
						</li>
					
						@if(Auth::user()->report_viewing==1 )
						<li><h3>Reports</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Members</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<!--<li><a href="{{ route('tenant.all') }}" class="slide-item">Members Details</a></li>-->
								<li><a href="{{ route('report.tenantform') }}" class="slide-item">Members Statements</a></li>
								<!--<li><a href="#" class="slide-item">Meeting Attendance</a></li>-->
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Organization</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('report.incomeform') }}" class="slide-item">Income Statement</a></li>
								{{-- <li><a href="{{ route('report.agency_status') }}" class="slide-item"> Agency Status</a></li> --}}
	
							</ul>
						</li>
						{{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-star"></i><span class="side-menu__label">Events</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('report.eventform') }}" class="slide-item"></a></li>
								<li><a href="{{ route('report.agency_status') }}" class="slide-item"> Agency Status</a></li>
	
							</ul>
						</li> --}}
						@endif
                        @if(Auth::user()->user_creating==1 || Auth::user()->user_editing_delete==1  )
						<li><h3>Users</h3></li>
						@if(Auth::user()->user_creating==1)
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin.create') }}"><i class="side-menu__icon fe fe-plus"></i><span class="side-menu__label">Add User</span></a>
						
						</li>
						@endif
						@if(Auth::user()->user_viewing==1 || Auth::user()->user_editing_delete==1  )
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin.index') }}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Users</span></a>
						
						</li>
						@endif
						@endif
						@if(Auth::user()->setting_creating==1 || Auth::user()->setting_editing==1  )
							<li><h3>Settings</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-briefcase"></i><span class="side-menu__label">Subscriptions</span><i class="angle fa fa-angle-right"></i></a>
						    <ul class="slide-menu">
						        @if(Auth::user()->setting_creating==1 )
								<li><a href="{{ route('subscription.create') }}" class="slide-item">Add Subscription</a></li>
								@endif
								@if(Auth::user()->setting_editing==1  )
								<li><a href="{{ route('subscription.list') }}" class="slide-item"> List Subscription</a></li>
								@endif
								
	
							</ul>
						</li>
						@endif
						<!--<li class="slide">-->
						<!--	<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">System Settings</span><i class="angle fa fa-angle-right"></i></a>-->
						
						<!--</li>-->
						<li><h3>System Operations</h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('logs.index')}}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">List Logs</span></a>
						    
						</li>
						{{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="{{ route('softdeletes.index')}}"><i class="side-menu__icon fe fe-trash"></i><span class="side-menu__label">Deleted Files</span></a>
						
						</li> --}}
						<li><h3></h3></li>
						
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><span class="side-menu__label"></span></a>
						
						</li>
					
						
						
					</ul>
				</aside>
