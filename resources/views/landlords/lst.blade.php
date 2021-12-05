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
								<li class="breadcrumb-item"><a href="{{ route('home')}}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">Property Owners</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
					!-- end row -->
    <div class="row">
        <div class="col-12">
            @include('includes.messages')
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="mt-0 header-title">Property Owners</h4> --}}
                    </p>

                    <table id="landlords-table" class="table table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                
                               <th>Landlord Names</th>
                               <th>Phone</th>
                               <th>Email</th>
                              
                               <th>Owns</th>
                               
                               <th></th>
                           </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('js')
<script>
    $(function () {
        $('#landlords-table').DataTable({
            processing: true,
            serverSide: true,
             "pageLength": 25,
            ajax: '{!! route('api.landlord.list') !!}',
            columns: [
                { data: 'full_name', name: 'full_name' },
                { data: 'id', name: 'id' },
                
                { data: 'email', name: 'email' },
                //{ data: 'phone_no', name: 'phone_no', orderable: false },
                { data: 'count', name: 'count', orderable: false },
                //{ data: 'view', name: 'view', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },

            ]
        });

         $(document).on('submit','.delete-landlord',function(event){
            return confirm('Are you sure you want to PERMANENTLY DELETE this Owner? The action will also delete all information linked with the Owner.');            
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