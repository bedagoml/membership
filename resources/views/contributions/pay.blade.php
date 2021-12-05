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
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">Pay Happy Hundred</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
						<!-- Row -->
						<div class="row">
							<div class="col-lg-12 col-md-12">
							    
     <form action="{{ route('happy_hundreds.store')}}" method="post" class="card">
        @csrf
        
        
        <div class="row">
            {{ csrf_field() }}

            <div class="col-12">
                <div class="">
                    <div class="card-body">
                        {{-- <h4 class="mt-0 header-title mb-4">Important Details</h4> --}}

                        {{-- <hr class="mt-2 mb-4"> --}}
                        @include('includes.messages')
                        <div class="row">
                            <div class="col-md-12">
                                    <label>Payment For </label>
                                    
                                    <div>
                                         <div class="form-group">
                                            <input class="form-control " type="text" id="example-text-input" 
                                            value="Happy Hundred" readonly>
                                    {{-- <select id="invoiceTypeSelector" class="form-control select2-show-search" style="width: 100%" name="invoice_type">
    
                                     <option selected disabled>-----Select-----</option>
                                    <option value="member" selected>Member Invoice</option>
                                            <option value="other">Member Invoice</option>
    
                                    </select> --}}
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="tenantSelector" class="col-md-6">
                                <label>Select Member <span class="text-danger">*</span></label>
                                
                                <div>
                                     <div class="form-group">
                                <select class="form-control select2-show-search" style="width: 100%" name="tenant_id">

                                    <option selected disabled>-----Select-----</option>
                                    @forelse ($tenants as $tenant=>$key)
                                        <option value="{{$key}}">{{ $tenant}}</option>
                                        @empty

                                        @endforelse

                                </select>
                                </div>
                                </div>
                               
                            </div>
                   
                           
                            <div class="col-md-6">
                                <label>Transaction Code<span class="text-danger">*</span></label>
                                    <div>
                                        <div class="form-group">
                                            
                                                <input class="form-control " type="text" id="example-text-input" name="transaction_code"
                                        value="">
                                            
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input">Payment Method <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search"  name="payment_type">

                                    <option selected disabled>-----Select-----</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Bank</option>
                                    <option value="Mpesa">Mpesa</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Amount<span class="text-danger">*</span></label>
                                    <div>
                                        <div class="form-group">
                                            
                                                <input class="form-control " type="number" id="example-text-input" name="amount"
                                        value="">
                                            
                                        </div>
                                        
                                    </div>
                            </div>
                             <div class="col-sm-6">
                                
                                <label>Date </label>
                                
                                    <div class="form-group">
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="date" name="payment_date"
                                                value="">
                                        </div>
                                    </div>
    
                                </div>
                        </div>
                        <div class="form-group row">
                            
                            
                           
                           
                        </div>
                        

                        <div class="row mb-4">
                            <div class="col-md-6">
                                
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit Payment</button>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </form>
   
							    
								

								
							</div>
						
					</div>
			
@endsection
@section('js')
<!--Select2 js -->
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

    $(document).ready(function () {
        var x = document.getElementById("invoiceTypeSelector").value;
        $("#tenantSelector").hide();
        $("#invoiceSelector").hide();
        if ( x == 'member')
        {
            $("#tenantSelector").show();
        $("#invoiceSelector").hide();
        }else if ( x == 'other'){
            $("#tenantSelector").hide();
        $("#invoiceSelector").show();
        }
    });
    
    $('#invoiceTypeSelector').change(function(){
        var x = document.getElementById("invoiceTypeSelector").value;
        $("#tenantSelector").hide();
        $("#invoiceSelector").hide();
        if ( x == 'member')
        {
            $("#tenantSelector").show();
        $("#invoiceSelector").hide();
        }else if ( x == 'other'){
            $("#tenantSelector").hide();
        $("#invoiceSelector").show();
        }
    });
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
@endsection
