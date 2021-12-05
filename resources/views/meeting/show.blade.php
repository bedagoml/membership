@extends('layouts.master')
@section('css')
<!-- Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
               
            </div>
        </div>
        <div class="mb-2"><a class="btn btn-sm btn-danger"
            href="{{route('meeting.list')}}">Back to the list</a>
    </div>
    </div>
    <!-- /Page Header -->

    @include('includes.messages')

    <div class="row">
        <div class="col-md-8">
            <div class="job-info job-widget">
                <h3 class="job-title">{{ $event->meeting_title}}</h3>
                 <!--<h6 class="job-title">{{ $event->meeting_description}}</h6>-->
                <ul class="job-post-det mb-2">
                   
                              <li><i class="fa fa-calendar"></i> Event Registered: <span
                            class="text-blue">{{ $event->created_at->diffForHumans() }}</span></li>
                   
                           
                </ul>
            </div>
            <div class="job-content job-widget">
                <div class="job-desc-title"><div class="row">
							<div class="col-12">
								
					

								
								<!--div-->
							<!---Invoice Section---->
                <div class="col-md-12 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">List of Registered Members </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap datatable" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <th >Member Number</th>
                                            <th >Member Name</th>
                                            <th >Phone Number</th>
                                            <th >Email</th>
                                            <th >Status</th>
                                            <th >Paid</th>
                                            <th >Balance</th>
                                            <th >Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->tenant->member_number }}</td>
                                            <td>{{ $invoice->tenant->member_name }}</td>
                                            <td>{{ $invoice->tenant->phone }}</td>
                                            <td>{{ $invoice->tenant->email }}</td>
                                            <td>
                                                @if ($invoice->is_paid > 0)
                                                <span class="badge badge-success">PAID  
                                                @elseif ($invoice->is_paid == 0 && $invoice->paid_in > 0 )
                                                <span class="badge badge-warning">PARTIAL</span>
                                                @else <span
                                                    class="badge badge-danger">UNPAID</span> @endif
                                            </td>
                                            <td>{{ $invoice->paid_in }}</td>
                                            <td>{{ $invoice->balance }}</td>
                                            

                                            <!--<td><a href="{{ route('invoice.show',$invoice->id)}}" class="btn btn-sm btn-primary">View</a> </td>-->
                                            <td>
                                                @if ($invoice->total_payable > 0)
                                                <div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="{{route('invoice.show', $invoice->id)}}"> View</a>
                                    </div>
                                    <!--<div class="dropdown-item ">-->
                                    <!--    <a class="btn btn-sm btn-success btn-block" href="{{route('invoice.edit', $invoice->id)}}"> Edit</a>-->
                                    <!--</div>-->
                                    

						    	</div>
                            </div>
                        </div>
                        @endif
                                                
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
								<!--/div-->

								
										</div>
									</div>
                    
                </div>
               

            </div>
        </div>
        <div class="col-md-4 order-first">
            <div class=" card">
                <div class="card-body">
                   <hr class="pt-4">
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-users"></i></span> Registered Members</h5>
                        <p>{{ $events}}</p>
                       
                      
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-calendar"></i></span> Event Date</h5>
                        <p>{{ $event->meeting_date }}</p>
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-clock-o"></i></span> Event Time</h5>
                        <p>{{ $event->meeting_time }} (EAT)</p>
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-money"></i></span> Charges</h5>
                        <p>
                            {{ $event->meeting_amount }}</p>
                    </div>
                    
                    
                    
                    <div class="info-list">
                       
                        <h5> <span><i class="fa fa-map-signs"></i></span> Description</h5>
                        <p> {{ $event->meeting_description }}</p>
                    </div>
                    <hr class="pt-4">
                    

                 
                </div>


            </div>
        </div>
       
    </div>


</div>
@endsection
@section('js')

<script>
    $(function () {
        $(document).ready(function () {
            $('#invoices-table').DataTable(
                {   
                    "order": [[ 0, "desc" ]],
                    "pageLength": 8,
                    "bLengthChange": false
                }
            );
        });
    });
</script>

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
@endsection



