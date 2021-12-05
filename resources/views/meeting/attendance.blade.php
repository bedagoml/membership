@extends('layouts.master')
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
								<li class="breadcrumb-item"><a href="{{ route('home')}}" class="d-flex"><span class="breadcrumb-icon"> Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">Events Registration list</li>
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
                                    <th >Member Number</th>
                                    <th style="word-wrap: break-word;">Member Name</th>
                                    <th style="word-wrap: break-word;">Event</th>
                                    <th >Event Date</th>
                                    <th >Event Amount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $evnt)
                                <tr>
                                    <td>{{ $evnt->tenant->member_number }}</td>
                                    <td>{{ $evnt->tenant->full_name }} </td>
                                    <td style="word-wrap: break-word;">{{ $evnt->meeting->meeting_title }}</td>
                                    {{-- <td style="word-wrap: break-word;">{{ $evnt->meeting->meeting_description }}</td> --}}
                                    <td>{{ $evnt->meeting->meeting_date }}- {{ $evnt->meeting->meeting_time }} (EAT)</td>
                                   <td>
                                    @if($evnt->meeting->meeting_amount == 0)
                                    <span style="color: rgb(0, 6, 95)">Free Event</span>
                                    @else
                                    Ksh. {{ number_format($evnt->meeting->meeting_amount) }}
                                    @endif</td> 
                                    
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