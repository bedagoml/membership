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
									<li class="breadcrumb-item active" aria-current="page">Create User</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
<div class="content container-fluid">

    <form action="{{ route('admin.store') }}" method="post">

        @csrf
        <div class="row">
            <div class="col-md-12">

                <!-- Page Header -->
                {{-- <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Create User</h3>
                        </div>
                    </div>
                </div> --}}
                <!-- /Page Header -->

                @include('includes.messages')
                <form >
              
                               
                    <div class="row">
            
            
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                  
            
                                <h6><strong>System User Details</strong></h6><hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                        <label >Full Name <span class="text-danger">*</span></label>
                                        
                                           
                                                <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-sm-4">
                                        <label >Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="user_id" pattern=".{12,}"   required title="Phone number must begin with 254 and contain 12 characters"
                                            >
                                            
                                        </div>
                                         <div class="col-sm-4">
                                        <label >Username <span
                                                class="text-danger">*</span></label>
                                       
                                                
                                                    <input class="form-control" type="text" name="username"
                                                        value="" >
                                               
                                            
            
                                        </div>
                                    </div>
            
                                   
                                    <div class="row">
                                        
                                         
                                    </div> <br>
                                    <h6><strong>User Permissions</strong></h6><hr>
                                  <div class="row">
                                        <div class="col-sm-6">
                                        
                                        <input type="text" class="form-control" value="Members" readonly>
                                      
                                          
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="creating" name="member_creating" value="1">
                                         <label for="creating"> Create</label>
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="viewing" name="member_viewing" value="1">
                                         <label for="viewing"> View</label>
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="editing" name="member_editing_delete" value="1">
                                         <label for="editing"> Edit & Delete</label>
            
                                        </div></div><br>
                                         <div class="row">
                                        <div class="col-sm-6">
                                        
                                        <input type="text" class="form-control" value="Events" readonly>
                                      
                                          
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="creating" name="event_creating" value="1">
                                         <label for="creating"> Create</label>
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="viewing" name="event_viewing" value="1">
                                         <label for="viewing"> View</label>
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="editing" name="event_editing_delete" value="1">
                                         <label for="editing"> Edit & Delete</label>
            
                                        </div></div><br>
                                         <div class="row">
                                        <div class="col-sm-6">
                                        
                                        <input type="text" class="form-control" value="Invoices" readonly>
                                      
                                          
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="creating" name="invoice_creating" value="1">
                                         <label for="creating"> Create</label>
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="viewing" name="invoice_viewing" value="1">
                                         <label for="viewing"> View</label>
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="editing" name="invoice_editing_delete" value="1">
                                         <label for="editing"> Edit & Delete</label>
            
                                        </div></div><br>
                                        <div class="row">
                                        <div class="col-sm-6">
                                        
                                        <input type="text" class="form-control" value="System Users" readonly>
                                      
                                          
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="creating" name="user_creating" value="1">
                                         <label for="creating"> Create</label>
            
                                        </div>
                                        
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="editing" name="user_editing_delete" value="1">
                                         <label for="editing"> Edit & Delete</label>
            
                                        </div></div><br>
                                         <div class="row">
                                        <div class="col-sm-6">
                                        
                                        <input type="text" class="form-control" value="Reports" readonly>
                                      
                                          
            
                                        </div>
                                       
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="viewing" name="report_viewing" value="1">
                                         <label for="viewing"> View</label>
            
                                        </div></div><br>
                                         <div class="row">
                                        <div class="col-sm-6">
                                        
                                        <input type="text" class="form-control" value="Settings" readonly>
                                      
                                          
            
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="creating" name="setting_creating" value="1">
                                         <label for="creating"> Create</label>
            
                                        </div>
                                       
                                        <div class="col-sm-2">
                                        <input type="checkbox" id="editing" name="setting_editing" value="1">
                                         <label for="editing"> Edit</label>
            
                                        </div>
                                      
                                        
                                    </div><br>
                                     <h6><strong>Create System User Account</strong></h6><hr>
                                    <div class="row">
                                       <div class="col-sm-4">
                                        <label >Email Address<span
                                                class="text-danger">*</span></label>
                                       
                                            <input class="form-control" type="email" id="agent_name" name="email"
                                                value="">
                                        </div>
                                        <div class="col-sm-4">
                                         <label>Password<span
                                                class="text-danger">*</span></label>
                                        
                                            
                                                    <input type="password" class="form-control" name="password">
                                                   
                                               
            
                                        </div>
                                         <div class="col-sm-4">
                                         <label >Confirm Password<span
                                                class="text-danger">*</span></label>
                                       
                                           
                                              
                                                    <input type="password" class="form-control" name="repeat-password">
                                               
                                          
            
                                        </div>
                                    </div><br>
                                   
                                    
            
                                    <div class="row mb-4">
                                        <div class="col-sm-6 ">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Create User</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                </form>
                
            </div>
        </div>
    </form>

</div>
<!-- /Page Content -->
			
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

@endsection