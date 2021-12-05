@extends('layouts.master')


@push('header_scripts')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endpush

@section('content')

<div class="content container-fluid">

    <!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title"></h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="#">List Members</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{ route('manualinvoice.create', $tenant->id) }}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										<i class="fe fe-plus"></i>
									</span> Add Invoice
								</a>
								@if($tenant->register_status==0)
								<a href="{{ route('member.deregister', $tenant->id) }}" class="btn btn-danger btn-icon text-white">
									<span>
										<i class="fe fe-x"></i>
									</span> Deregister
								</a>
								@else
								<a href="{{ route('member.deregister', $tenant->id) }}" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-check"></i>
									</span> Register
								</a>
                               
								@endif
                               @if($tenant->suspend_status==0)
								<a href="{{ route('member.suspend', $tenant->id) }}" class="btn btn-warning btn-icon text-white">
									<span>
										<i class="fe fe-x"></i>
									</span> Suspend
								</a>
                                @else
								<a href="{{ route('member.suspend', $tenant->id) }}" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-check"></i>
									</span> UnSuspend
								</a>
								@endif
                                @if($tenant->status==1)
								<a href="{{ route('member.approve', $tenant->id) }}" class="btn btn-pink btn-icon text-white">
									<span>
										<i class="fe fe-x"></i>
									</span> Disapprove
								</a>
                                @else
								<a href="{{ route('member.approve', $tenant->id) }}" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-check"></i>
									</span> Approve
								</a>
								@endif
				
							</div>
						</div>
						<!-- PAGE-HEADER END -->
   
    @include('includes.messages')

   


    <div class="tab-content">
<div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
               
                
                </div>
                
            </div>
            <!--details-->
         <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
                 <div class="col-md-4 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            
                                        
                           <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $tenant->full_name}}</h3>
                                        <div class="staff-id">Member Number : {{ $tenant->member_number}}</div>
                                        <div class="staff-id">Phone Number : {{ $tenant->phone}}</div>
                                        <div class="small doj text-muted mb-2">Registered :
                                            {{ $tenant->created_at->diffForHumans() }}</div>
                                        <div class="mb-2"><a class="btn btn-sm btn-primary"
                                                href="{{ route('tenant.edit', $tenant->id )}}">Edit details</a>&nbsp;
                                                <a class="btn btn-sm btn-danger"
                                            href="{{ route('tenant.changepassword', $tenant->id )}}">Change Password</a>
                                        </div>
                                        <div class="mb-2">
                                    </div>
                                      
                                         
                                      
                                        
                                       <!--  <div class=""><a class="btn btn-sm btn-white"
                                                href="{{ route('tenant.changepassword',$tenant->id)}}">Update
                                                Password</a>
                                        </div> -->
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            <h3 class="card-title"> Details </h3>
                                        
                           <div class="profile-info-left">
                                       
                                        <div class="staff-id"><strong>Account Number :</strong> {{ $tenant->member_number}}</div>
                                        <div class="staff-id"><strong>Email Address :</strong> <span class="__cf_email__"
                                                        data-cfemail="39535651575d565c795c41585449555c175a5654">{{ $tenant->email}}</span></div>
                                        <div class="staff-id"><strong>National ID/Passport Number :</strong> {{ $tenant->id_number }}</div>
                                        {{-- <div class="staff-id"><strong>Subcommittees:</strong> {{ $tenant->committees }}</div> --}}
                                        
                                      
                                         
                                      
                                        
                                       <!--  <div class=""><a class="btn btn-sm btn-white"
                                                href="{{ route('tenant.changepassword',$tenant->id)}}">Update
                                                Password</a>
                                        </div> -->
                                    </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-3 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            <h3 class="card-title"> Subscription Details </h3>
                                 <div class="staff-id"><strong>Date :</strong> {{ $tenant->subscription_date}} </div>
                                 <div class="staff-id"><strong>Account Status :</strong> 
                                    @if($tenant->status == 1)
                                    <span style="color: green;">Registered</span> 
                                    @elseif($tenant->status == 0)
                                    <span style="color: red">Deregistered</span>
                                    @elseif($tenant->status == 2)
                                    <span style="color: rgb(0, 4, 255)">Suspended</span>
                                    @else
                                    <span style="color: rgb(255, 115, 0)">Pending</span>
                                    @endif</div> 
                                        <div class="staff-id"><strong>Balance :</strong> {{ $invoizzy}} </div>
                                             
                          
                        </div>
                    </div>
                </div>
                
                </div>
                
            </div>
     
            <!--details-->
 
   
            <div class="row">
                

                <!---Paid Invoice Section---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Paid Invoices </h3>
                            <div class="table-responsive">
                                    <table class="table table-striped dt-responsive nowrap" id="invoices-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:30%">Date</th>
                                            <th style="width:20%">#INV</th>
                                            <th style="width:30%">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($invoiz as $invoice)
                                        <tr>
                                            <td>{{ $invoice->created_at }}</td>
                                            <td>INV00{{ $invoice->id }}</td>
                                            
                                            
                                            

                                            <!--<td><a href="{{ route('invoice.show',$invoice->id)}}" class="btn btn-sm btn-primary">View</a> </td>-->
                                            <td>
                                                <div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="{{route('invoice.show', $invoice->id)}}"> View</a>
                                    </div>
                                    {{-- <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-success btn-block" href="{{route('invoice.edit', $invoice->id)}}"> Edit</a>
                                    </div> --}}
                                    

						    	</div>
                            </div>
                        </div>
                                                
                                            </td>
                                        </tr>

                                        @empty

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!---Payment Section---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Payments </h3>
                            <div class="table-responsive">
                               
                                <table class="table table-striped dt-responsive nowrap" id="deposit-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <!--<th>#</th>-->
                                            <th style="width:50%;">Date</th>
                                            <th style="width:30%;">Reference</th>
                                            <th style="width:20%;">Amount</th>
                                            
                                        </tr>
                                    </thead>

                                    @php
                                    $count=1;
                                    @endphp
                                    <tbody>
                                        @forelse ($tenant_payment as $deposit)
                                        <tr>
                                            <!--<td>{{$count}}</td>-->
                                            <td >{{ $deposit->created_at}}</td>
                                            <td class="text-uppercase">{{$deposit->TransID}}</td>
                                            <td class="text-uppercase">Ksh.{{number_format( $deposit->TransAmount)}}</td>
                                            
                                        </tr>

                                        @php
                                        $count+=1;
                                        @endphp
                                        @empty

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!---Unpaid Invoice Section---->
               
            </div>
            <div class="row">
                <!---Unpaid Invoice Section---->
                <div class="col-md-12 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Scheduled Meetings </h3>
                            <div class="table-responsive">
                                 <table class="table table-striped dt-responsive" id="upcoming_events-table"  style="word-wrap:break-word; table-layout: fixed;  border-spacing: 0; width: 100%;">
                               
                                    <thead>
                                        <tr>
                                            <th >Date</th>
                                            <th style="word-wrap: break-word;">Title</th>
                                            <th style="word-wrap: break-word;">Description</th>
                                            {{-- <th >Amount</th>
                                            <th >Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($upcoming_events as $evnt)
                                        <tr>
                                            <td>{{ $evnt->meeting_date }}- {{ $evnt->meeting_time }} (EAT)</td>
                                            <td style="word-wrap: break-word;">{{ $evnt->meeting_title }}</td>
                                            <td style="word-wrap: break-word;">{{ $evnt->meeting_description }}</td>
                                            
                                           
                                        </tr>
                                      

                                        @empty

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Info Tab -->



    </div>

</div>

@endsection

@section('js')
<!-- Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables.js')}}"></script>
<!-- Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>

<script>
    $(function () {
        $(document).ready(function () {
            $('#invoices-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#unpaid-invoices-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#house-table').DataTable(
                {
                    "pageLength": 2,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#balance-table').DataTable(
                {
                    "pageLength": 2,
                    "order": [[ 2, "desc" ]],
                    "bLengthChange": false
                     
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#deposit-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#deposit-list-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#tenant-bill-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
@endsection

