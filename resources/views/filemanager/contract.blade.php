@extends('layouts.home')
@section('content')
<div class="content container-fluid">



  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    
    <link rel="apple-touch-icon" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/themes/semi-dark-layout.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/css/pages/app-file-manager.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/assets/css/style.css">
    <!-- END: Custom CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  {{-- <body class="vertical-layout vertical-menu-modern semi-dark-layout content-left-sidebar file-manager-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="semi-dark-layout"> --}}
 <!-- BEGIN: Content-->
 {{-- <div class="app-content content"> --}}
    <div class="content-area-wrapper">
      <div class="sidebar-left">
    <div class="app-file-sidebar sidebar-content d-flex">
<!-- App File sidebar - Left section Starts -->
<div class="app-file-sidebar-left">
  <!-- sidebar close icon starts -->
  
  <!-- sidebar close icon ends -->
  <div class="form-group add-new-file text-center">
    <!-- Add File Button -->
    <label for="getFile" class="btn btn-primary btn-block glow my-2 add-file-btn text-capitalize"></i></label>
    <input type="file" class="d-none" id="getFile">
  </div><br><br><br><br><br>
  <div class="app-file-sidebar-content">
    <!-- App File Left Sidebar - Drive Content Starts -->
    {{-- <label class="app-file-label">My Drive</label> --}}
    <div class="list-group list-group-messages ">
        <a href="{{ route('filemanager.index')}}"  class="list-group-item list-group-item-action ">
            All Files </a>
        
      
      <a href="{{ route('filemanager.recent')}}"  
      class="list-group-item list-group-item-action">
        
        Recent Files
      </a>
     
      <a href="{{ route('filemanager.images')}}"  class="list-group-item list-group-item-action">
        
        Images
      </a>
      <a href="{{ route('filemanager.contract')}}" class="list-group-item list-group-item-action" style="color: rgb(1, 111, 255);">
       
        Contracts
      </a>
    </div>
    <!-- App File Left Sidebar - Drive Content Ends -->

  
   
    <!-- App File Left Sidebar - Storage Content Ends -->
  </div>
</div>



        </div>
      </div><br><br><br><br>
      <div >
        <form action="" method="post">
            @csrf
            
            
            <div class="row">
                {{ csrf_field() }}
    
                <div class="col-6">
                    <div class="">
                        <div class="card-body">
                          
                            
                            <p class="section-title">Tenant Contracts</p><hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="display: flex; overflow: auto;">
                                        @if (count($tenant_files) > 0) 
                                        @foreach ($tenant_files as $number) 
                                        @foreach ($number['filename'] as $num) 
                                        <div class="card m-2" style="max-width:12em; min-width:10em;">
                                            <img class="card-img-top" src="{{asset('rms/storage/app/filemanager/contract.png')}}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$number['details']['full_name']}}</h5>
                                                <h5 class="card-title">{{$number['details']['account_number']}}</h5>
                                                <h5 class="card-title">{{$number['details']['id']}}</h5>
                                                <form method="POST" action="{{ url('filemanager/delete/'.$number['id'].'/'.$num) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    <a target="_blank" href="{{asset('rms/storage/app/filemanager/'.$num) }}" class="btn btn-primary btn-sm">View</a>
                                                </form>
                                              </div>
                                              </div>
                                          </div>
                                          @endforeach
                                          @endforeach
                                          @else
                                          <div class="text-center">
                        <i>No files found</i>
                                          </div>
                                          @endif
                                          
                                    </div></div>
                            </div><br>
                            <p class="section-title">Landlord Contracts</p><hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="display: flex; overflow: auto;">
                                        @if ($landlord_files->count() > 0) 
                                        @foreach ($landlord_files as $number) 
                                        @foreach ($number['filename'] as $num) 
                                        <div class="card m-2" style="max-width:12em; min-width:10em;">
                                            <img class="card-img-top" src="{{asset('rms/storage/app/filemanager/contract.png') }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$number['details']['full_name']}}</h5>
                                                <h5 class="card-title">{{$number['details']['id']}}</h5>
                                                <form method="POST" action="{{ url('filemanager/delete/'.$number['id'].'/'.$num) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    <a target="_blank" href="{{asset('rms/storage/app/filemanager/'.$num) }}" class="btn btn-primary btn-sm">View</a>
                                                </form>
                                              </div>
                                          </div>
                                          @endforeach
                                          @endforeach
                                          @else
                                          <div class="text-center">
                        <i>No files found</i>
                                          </div>
                                          @endif
                                    </div></div>
                            </div>
                            
                        
                        </div>
    
                            
                        </div>
                    </div>
                </div>            
            </div>
        </form>
        
        </div>
    
    
        <!-- /Content End -->
    
    </div>
      

    

 
    
  </div>
  <!-- App File - Files Section Ends -->
</div>
</div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Content-->


    
  

  

    <!-- BEGIN: Vendor JS-->
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/vendors/js/vendors.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/scripts/configs/vertical-menu-dark.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/core/app-menu.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/core/app.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/scripts/components.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/scripts/footer.min.js"></script>
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/js/scripts/pages/app-file-manager.min.js"></script>
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->
</div>