
@extends('layouts.master2')
@section('css')
<!-- Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
						
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('tenant-home')}}" class="d-flex"><span class="breadcrumb-icon"> Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">My Invoices</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
						<!-- Row -->
			 <div class="row">
        
        <div class="col-md-12">
            @include('includes.messages')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        
                         <table class="table table-striped dt-responsive" id="upcoming_events-table"  style="word-wrap:break-word; table-layout: fixed;  border-spacing: 0; width: 100%;">
                               
                            <thead>
                                <tr>
                                     
                                    <th >INV #</th>
                                    {{-- <th style="width:30%">Member Name</th> --}}
                                    
                                    <td>Year</td>
                               
                                    <th >Payable</th>                                    
                                    <th >Paid In</th>                                    
                                    <th >Balance</th>                                    
                                    <th >Status</th>  
                                    <th >Action</th>   
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $evnt)
                                <tr>
                                   
                                    <td >{{ $evnt->invoice_number}}</td>
                                    <td>{{ $evnt->subscription_year}}</td>
                                    <td >{{ $evnt->total_payable }}</td>
                                    <td >{{ $evnt->paid_in }}</td>
                                    <td >{{ $evnt->balance }}</td>
                                   <td>
                                    @if($evnt->balance > 0)
                                    <span style="color: rgb(95, 0, 0)">Unpaid</span>
                                    @elseif($evnt->paid_in > 0 && $evnt->balance > 0)
                                    <span style="color: rgb(95, 54, 0)">Partial</span>
                                    @else
                                    <span style="color: rgb(1, 73, 7)">Paid</span>
                                    @endif</td> 
                                    <td>
                                        <div class="text-right">
                                            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v "></i>
                                            </div>
                                            <div class="dropdown-menu" role="menu">
                                            
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-info btn-block" href="{{route('user_invoice.show', $evnt->id)}}"> View</a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                    </td>
                                    
                                    {{-- <td>
                                        
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-info btn-block" href="{{route('meeting.invoice', $evnt->id)}}"  onclick="event.preventDefault();
                                            document.getElementById('meeting_invoices').submit();"> Register</a>
                                        <form id="meeting_invoices" action="{{ route('meeting.invoice', $evnt->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="tenant_id" value=""  />
                                        </form></td> --}}
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
							
						<!-- /Row -->

@endsection
@section('js')

<!-- Data tables -->
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