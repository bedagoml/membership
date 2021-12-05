@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<!-- File Uploads css -->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!-- Time picker css -->
<link href="{{URL::asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet" />
<!-- Date Picker css -->
<link href="{{URL::asset('assets/plugins/date-picker/date-picker.css')}}" rel="stylesheet" />
<!-- File Uploads css-->
 <link href="{{URL::asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
<!--Mutipleselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/multipleselect/multiple-select.css')}}">
<!--Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect.css')}}">
<!--intlTelInput css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/intl-tel-input-master/intlTelInput.css')}}">
<!--Jquerytransfer css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/jQuerytransfer/jquery.transfer.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/plugins/jQuerytransfer/icon_font/icon_font.css')}}">
<!--multi css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/multi/multi.min.css')}}">
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<!--<div class="page-leftheader">-->
							<!--	<h4 class="page-title">Advanced Foms</h4>-->
							<!--</div>-->
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('home')}}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<li class="breadcrumb-item"><a href="#">Reports</a></li>
									<li class="breadcrumb-item active" aria-current="page">Income Statement</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection

@section('content')
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="row">
        {{-- <div class="col-sm-12">
            <h4 class="page-title">Assign A Room To Tenant</h4>
        </div> --}}
    </div>
    <!-- /Page Title -->

    <!-- Content Starts -->
    <div class="card">
        <form action="{{route('income_statement')}}" method="get">
            @csrf
            
            
            <div class="row">
               
    
                <div class="col-12">
                    <div class="">
                        <div class="card-body">
                            {{-- <h4 class="mt-0 header-title mb-4">Important Details</h4> --}}
    
                            {{-- <hr class="mt-2 mb-4"> --}}
                            @include('includes.messages')
                            
                            <div class="row">
                                <div class="col-sm-6">
                                <label>From <span
                                        class="text-danger">*</span></label>
                                
                                    <div class="form-group">
                                        <div class="cal-icon">
                                            <input class="form-control" type="date" name="from"
                                              required/>
                                        </div>
                                    </div>
    
                                </div>
                                <div class="col-sm-6">
                                <label >To<span
                                    class="text-danger">*</span></label>
                            
                                <div class="form-group">
                                    <div class="cal-icon">
                                        <input class="form-control" type="date" name="to"
                                            required>
                                    </div>
                                </div>
    
                            </div>
                            </div><br>
    
                            <div class="row mb-4">
                                <div class="col-sm-8">
                                    
                                   
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Get Statement</button></button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </form>
        
        </div>
        @if($hasReport)
 <div class="card" style="padding-top:25px; padding-bottom:25px; padding-left:25px; padding-right:25px;">
        <div class="row">
            <div class="col-12">
                <div class="title text-center">
                    <h2>INCOME STATEMENT</h2>
                </div>
            </div>
        </div>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                           
                           
                        </div> <!-- end col -->
                        <div class="col-xs-6  float-right" style="float:right;text-align:right;">
                            <div class="mt-3 float-right">
                                <img src="" alt="DEMO LOGO" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!--<div class="title text-center">-->
                        <!--    <h4>Detailed Income Statement</h4>-->
                        <!--</div>-->
                    </div>
                    <div class="table-responsive">
                               
                        <table class="table table-striped dt-responsive nowrap" id="statement" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                   {{-- <div class="row table-responsive   "> --}}
                        {{-- <table class="table dt-responsive nowrap" id="statement" style="border-collapse: collapse; border-spacing: 500px; width: 100%;"> --}}
                            <thead>
                              <tr>
                                   <tr style="padding-top:0px; padding-bottom:0px;">
                                <th >Date</th>
                                <th >Member Name</th>
                                <th>Description</th>
                                <th>Reference</th>
                                <th>Subscription Amount</th>
                                <th >Projects Amount</th>
                                <th >Happy-100 Amount</th>
                                <th >Expenses Amount</th>
                                <th >Expenses Paid Amount</th>
                              </tr>
                                
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                              <tr>
                                <th>{{$entry['date']}}</th>
                                <th>{{$entry['member_name']}}</th>
                                <td>{{$entry['description']}}</td>
                                <td>{{$entry['reference']}}</td>

                                @if($entry['paid_in'] === '-')
                                <td>
                                   -
                                </td>
                                @else 
                                <td >
                                    Ksh. {{number_format($entry['paid_in'],2)}}
                                </td>
                                @endif
                                @if($entry['paid'] === '-')
                                <td>
                                    -
                                </td>
                                @else 
                                <td >
                                    Ksh. {{number_format($entry['paid'],2)}}
                                </td>
                                @endif
                                @if($entry['happy'] === '-')
                                <td>
                                    -
                                </td>
                                @else 
                                <td >
                                    Ksh. {{number_format($entry['happy'],2)}}
                                </td>
                                @endif
                                @if($entry['happy_1'] === '-')
                                <td>
                                    -
                                </td>
                                @else 
                                <td >
                                    Ksh. {{number_format($entry['happy_1'],2)}}
                                </td>
                                @endif
                                @if($entry['happy_2'] === '-')
                                <td>
                                    -
                                </td>
                                @else 
                                <td >
                                    Ksh. {{number_format($entry['happy_2'],2)}}
                                </td>
                                @endif
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                    <div class="col-12">
                        <div class="title text-center">
                        <h2><strong>SUMMARY</strong></h2>
                        </div>
                    </div>
                    <div class="row table-responsive   ">
                        <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 500px; width: 100%;">
                            <thead>
                              <tr>
                                <td>Details</td>
                                <td>Income</td>
                                <td>Expense</td>
                              </tr>
                            </thead>
                            <tbody>
                                
                                
                                <tr>
                                    <td>Subscription</td>
                                    <td>Ksh. {{$payments}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Projects</td>
                                    <td>Ksh. {{ $donationpayments}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Happy Hundreds</td>
                                    <td>Ksh. {{ $happy_hours_payments}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Total Expenses</td>
                                    <td>-</td>
                                    <td>Ksh. {{ $expense}}</td>
                                </tr>
                                <tr>
                                    <td>Total Expenses Payment</td>
                                    <td>-</td>
                                    <td>Ksh. {{ $expensepay}}</td>
                                </tr>
                                <hr>
                                <tr>
                                    <th>Total Expenses Balance</th>
                                    <th>-</th>
                                    <th>Ksh. {{ $expensebalance}}</th>
                                </tr>
                                <tr>
                                    <th>Total Income</th>
                                    <th >Ksh. {{$total_income}}</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th>Account Balance</th>
                                    <th >Ksh. {{$balance}}</th>
                                    <td>-</td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                    <!-- end row -->
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <a  href="{{\Request::fullUrl()}}&download=yes" target="_blank" class="m-2 btn btn-success waves-effect waves-light">Download Statement</a>
                            </div>
                    </div>

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>


    <!-- /Content End -->
         @endif
</div>

                    
           



@endsection
@section('js')
<!--Select2 js -->
<script>
    $(function () {
        $(document).ready(function () {
            $('#statement').DataTable(
                {
                    "pageLength": 25,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Timepicker js -->
<script src="{{URL::asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<!-- Datepicker js -->
<script src="{{URL::asset('assets/plugins/date-picker/date-picker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{URL::asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<!--File-Uploads Js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<!-- File uploads js -->
<script src="{{URL::asset('assets/plugins/fileupload/js/dropify.js')}}"></script>
<script src="{{URL::asset('assets/js/filupload.js')}}"></script>
<!-- Multiple select js -->
<script src="{{URL::asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/multipleselect/multi-select.js')}}"></script>
<!--Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<!--intlTelInput js-->
<script src="{{URL::asset('assets/plugins/intl-tel-input-master/intlTelInput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/intl-tel-input-master/country-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/intl-tel-input-master/utils.js')}}"></script>
<!--jquery transfer js-->
<script src="{{URL::asset('assets/plugins/jQuerytransfer/jquery.transfer.js')}}"></script>
<!--multi js-->
<script src="{{URL::asset('assets/plugins/multi/multi.min.js')}}"></script>
<!-- Form Advanced Element -->
<script src="{{URL::asset('assets/js/formelementadvnced.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/file-upload.js')}}"></script>
<script>
    $('#apartment_id').change(function () {
        var id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{!! route('ajax.houses.filter') !!}",
            method: 'POST',
            data: { 'id': id, '_token': token },
            success: function (data) {
                $('#house-rent').val('');
                $('#section-bills').html('');
                $("select[name='house_id']").html('');
                $("select[name='house_id']").html(data.options);
            },
            error: function () {
                alert("error!!!!");
            }
        });
    });

    $('#houses_select').change(function () {
        var id = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: "{!! route('ajax.house.bills') !!}",
            method: 'POST',
            data: { 'id': id, '_token': token },
            success: function (data) {
                $('#house-rent').val('');
                $('#house-rent').val(data.house_rent);
            },
            error: function () {
                alert("error!!!!");
            }
        });

    });

    $(document).on('change', '#off-switch', function () {
        if ($(this).prop("checked") == true) {
            $("#new-tenant-row").prop('hidden', false);
            $("#checked-tenant").attr("name", "is_new_tenant");
        }
        else {
            $("#new-tenant-row").prop('hidden', true);
            $("#checked-tenant").removeAttr('name');
        }
    });

    $(function () {
        $('#datetimepicker10').datetimepicker({
            viewMode: 'years',
            format: 'MM/YYYY'
        });
    });

    $(document).on('focusout', '#tenant-id', function () {

        var id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{!! route('ajax.tenant.validate') !!}",
            method: 'POST',
            data: { 'id': id, '_token': token },
            success: function (data) {

                if (data.exists) {
                    $('#tenant-names').removeClass('is-invalid');
                    $('#tenant-names').addClass('is-valid');
                    $('#tenant-names').val('');
                    $('#tenant-names').val(data.tenant_name);
                } else {
                     $('#tenant-names').removeClass('is-valid');
                     $('#tenant-names').addClass('is-invalid');
                    $('#tenant-names').val('');
                    $('#tenant-names').val(data.tenant_name);
                }

            },
            error: function () {
                alert("error!!!!");
            }
        });

    });

</script>
@endsection