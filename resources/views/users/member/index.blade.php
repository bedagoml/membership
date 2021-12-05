@extends('layouts.master2')


@push('header_scripts')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endpush

@section('content')

<div class="content container-fluid">

   
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
                                        <div class="staff-id">Phone Number : {{ $tenant->phone}}</div>
                                        <div class="small doj text-muted mb-2">Registered :
                                            {{ $tenant->created_at->diffForHumans() }}</div>
                                        <div class="mb-2"><a class="btn btn-sm btn-primary"
                                                href="{{ route('user.tenant.edit', $tenant->id )}}">Edit details</a>&nbsp;
                                                <a class="btn btn-sm btn-danger"
                                            href="{{ route('user.tenant.changepassword', $tenant->id )}}">Change Password</a>
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
                                       
                                        <div class="staff-id"><strong>Member Number :</strong> {{ $tenant->member_number}}</div>
                                        <div class="staff-id"><strong>Email Address :</strong> <span class="__cf_email__"
                                                        data-cfemail="39535651575d565c795c41585449555c175a5654">{{ $tenant->email}}</span></div>
                                        <div class="staff-id"><strong>National ID/Passport Number :</strong> {{ $tenant->id_number }}</div>
                                        
                                      
                                         
                                      
                                        
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
                                 <div class="staff-id"><strong>Year :</strong> {{ $tenant->subscription_year}} </div>
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
                                        <div class="staff-id"><strong>Balance :</strong> {{number_format($invoizzy) }} </div> 
                                        
                                        
                                        
                          
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
                                            <td>{{ $invoice->invoice_number }}</td>
                                            
                                            
                                            

                                            <!--<td><a href="{{ route('invoice.show',$invoice->id)}}" class="btn btn-sm btn-primary">View</a> </td>-->
                                            <td>
                                                <div class="text-right">
                                                    <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v "></i>
                                                    </div>
                                                    <div class="dropdown-menu" role="menu">
                                                    
                                                        <div class="dropdown-item ">
                                                            <a class="btn btn-info btn-block" href="{{route('user_invoice.show', $invoice->id)}}"> View</a>
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
            </div>
            <div class="row">
                <!---Unpaid Invoice Section---->
                <div class="col-md-12 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Upcoming Events </h3>
                            <div class="table-responsive">
                                 <table class="table table-striped dt-responsive" id="upcoming_events-table"  style="word-wrap:break-word; table-layout: fixed;  border-spacing: 0; width: 100%;">
                               
                                    <thead>
                                        <tr>
                                            <th >Date</th>
                                            <th style="word-wrap: break-word;">Title</th>
                                            <th style="word-wrap: break-word;">Description</th>
                                            <th >Amount</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($upcoming_events as $evnt)
                                        <tr>
                                            <td>{{ $evnt->meeting_date }}- {{ $evnt->meeting_time }} (EAT)</td>
                                            <td style="word-wrap: break-word;">{{ $evnt->meeting_title }}</td>
                                            <td style="word-wrap: break-word;">{{ $evnt->meeting_description }}</td>
                                            
                                           <td>
                                            @if($evnt->meeting_amount == 0)
                                            <span style="color: rgb(0, 6, 95)">Free Event</span>
                                            @else
                                            Ksh. {{ number_format($evnt->meeting_amount) }}
                                            @endif</td> 
                                            <td>
                                                
                                                
                                                
                                                
                                                <a class="btn btn-sm btn-info btn-block" href="{{route('meeting.invoice', $evnt->id)}}"  onclick="event.preventDefault();
                                                    document.getElementById('meeting_invoices').submit();"> Register</a>
                                                <form id="meeting_invoices" action="{{ route('meeting.invoice', $evnt->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="tenant_id" value="{{ $tenant->id}}"  />
                                                </form></td>
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
            $('#upcoming_events-table').DataTable(
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

