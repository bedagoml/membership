@extends('layouts.home')


@push('header_scripts')
<!-- DataTables -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                {{-- <h3 class="page-title">Profile</h3> --}}
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tenant</li>
                </ul> --}}
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="mb-2"><a class="btn btn-sm btn-danger"
        href="{{ route('tenant.all')}}">Back to the list</a>
</div>
    @include('includes.messages')

    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img alt="" src="{{ asset('assets/img/tenant.jpg')}}"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $tenant->full_name}}</h3>
                                        <h6 class="text-muted">{{ $tenant->occupation}}</h6>
                                        <small class="text-muted">{{ $tenant->occupation_at }}</small>
                                        <div class="staff-id">Tenant Phone Number : {{ $tenant->id}}</div>
                                        <div class="small doj text-muted mb-2">Registered :
                                            {{ $tenant->created_at->diffForHumans() }}</div>
                                        <div class="mb-2"><a class="btn btn-sm btn-secondary"
                                                href="{{ route('tenant.edit', $tenant->id )}}">Edit Tenant Details</a>
                                        </div>
                                        
                                       <!--  <div class=""><a class="btn btn-sm btn-white"
                                                href="{{ route('tenant.changepassword',$tenant->id)}}">Update
                                                Password</a>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Tenant ID Number:</div>
                                            <div class="text"><a href="">{{ $tenant->id_number}}</a></div>
                                        </li>
                                        {{-- <li>
                                            <div class="title">Address:</div>
                                            <div class="text">{{ $tenant->physical_address }}</div>
                                        </li> --}}
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text"><a href=""><span class="__cf_email__"
                                                        data-cfemail="39535651575d565c795c41585449555c175a5654">{{ $tenant->email}}</span></a>
                                            </div>
                                        </li>
                                        {{-- <li>
                                            <div class="title">Birthday:</div>
                                            <div class="text">24th July</div>
                                        </li> --}}
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon"
                                href="#"><i class="fa fa-pencil"></i></a></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-content">

        <!-- Profile Info Tab -->
        <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            @forelse ($tenant->invoices as $invoice)
                                        <tr>
                                            <h3 class="card-title">Current Balance </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Amount:</div>
                                                    <div class="text">Ksh {{ ($invoice->paid_in - $invoice->total_payable) *-1 }}</div>
                    
                                                </li>
                                                <li>
                                                    <div class="title">House:</div>
                                                    <div class="text">{{ ($invoice->house->house_no) }}-{{ ($invoice->house->house_type) }}</div>
                                        
                                                </li>
                                                <hr>
                                                         
                
                                            </ul>
                                            
                                            
                                        </tr>

                                        @empty
                                        No house assigned yet.

                                        @endforelse
                         
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Emergency Contact </h3>
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Name</div>
                                    <div class="text">{{$tenant->emergency_person }}</div>
                                </li>
                                <li>
                                    <div class="title">Contact</div>
                                    <div class="text">{{ $tenant->emergency_number }}</div>
                                </li>
                                <li>
                                    <div class="title">Relationship</div>
                                    <div class="text">{{ $tenant->relationship }}</div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!---Assigned Houses---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Occupant In </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap datatable" id="house-table">
                                       <thead> <tr>
                                            <th>Hse No</th>
                                            <th>Type</th>
                                            <th>Apartment</th>
                                            <th>Rented On</th>
                                            {{-- <th class="text-right no-sort">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($houzez as $houze)
                                        <tr>
                                            <td class="text-uppercase">{{$houze->house->house_no}}</td>
                                            <td class="text-uppercase">{{$houze->house->house_type}}</td>
                                            <td>{{$houze->house->apartment->name}}</td>
                                            <td>{{$houze->placement_date}}</td>


                                            {{-- <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="" class="dropdown-item"></a>
                                                        <a class="dropdown-item bg-danger text-white" href="{{'tenant.vacate'}}"
                                                            data-toggle="modal" data-target="#delete_employee"><i
                                                                class="fa fa-trash-o m-r-5"></i> VACATE
                                                            {{$houze->house->house_no }} TENANT</a>
                                                        <a href="" class="dropdown-item"></a>
                                                    </div>
                                                </div>
                                            </td> --}}

                                        </tr>
                                        @empty

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!---Invoice Section---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Tenant Invoices </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap datatable" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <th style="width:20%">#INV</th>
                                            <th style="width:20%">Month</th>
                                            <th style="width:30%">Status</th>
                                            <th style="width:30%">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tenant->invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->rent_month }}</td>
                                            <td>
                                                @if ($invoice->is_paid)
                                                <span class="badge badge-success">PAID  @else <span
                                                    class="badge badge-danger">UNPAID</span> @endif
                                            </td>

                                            <td><a href="{{ route('invoice.show',$invoice->id)}}" class="btn btn-sm btn-primary">View</a> </td>
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
            <div class="row">
                <!---Deposits Section---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Tenant Deposits </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>For Hse</th>
                                            <th>From</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $count=1;
                                    @endphp
                                    <tbody>
                                        @forelse ($deposits as $deposit)
                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>Ksh {{number_format($deposit->amount)}}</td>
                                            <td class="text-uppercase">{{ $deposit->house->house_no}}</td>
                                            <td>{{ $deposit->start_month}}</td>
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


                <!---placement Fee---->
                
            </div>
        </div>
        <!-- /Profile Info Tab -->



    </div>

</div>

@endsection

@push('footer_scripts')
<!-- Required datatable js -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<script>
    $(function () {
        $(document).ready(function () {
            $('#invoices-table').DataTable(
                {
                    "pageLength": 4,
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
                    "pageLength": 4,
                    "bLengthChange": false
                }
            );
        });
    });
</script>

@endpush