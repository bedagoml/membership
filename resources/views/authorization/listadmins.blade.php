@extends('layouts.master')

@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-9">
                {{-- <h3 class="page-title">Users</h3> --}}
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ul> --}}
            </div>
            <div>
                <a href="{{ route('admin.create')}}" class="btn btn-success">
                    Add User</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->


<div class="card" style="padding-top:25px; padding-bottom:25px; padding-left:25px; padding-right:25px;">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">

                @include('includes.messages')
                <table class="table table-striped " >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User-Name</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            
                            <th style="width: 10%;">Password</th>
                            <th style="width: 10%;">Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($users as $user)
                        <tr>
                            <td>
                                {{ $user->name}}
                            </td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->user_id }}</td>
                            <td>
                               <ul>
                                 @if ($user->member_creating===1)
                                <li><span>Create Members</span></li>
                                @endif
                                @if ($user->member_viewing===1)
                                <li><span >View Members</span></li>
                                @endif
                                @if($user->member_editing_delete===1)
                                <li><span >Edit & Delete Members</span></li>
                                @endif 
                                 @if ($user->event_creating===1)
                                <li><span>Create Events</span></li>
                                @endif
                                @if ($user->event_viewing===1)
                                <li><span >View Events</span></li>
                                @endif
                                @if($user->event_editing_delete===1)
                                <li><span >Edit & Delete Events</span></li>
                                @endif
                                 @if ($user->invoice_creating===1)
                                <li><span>Create & Pay Invoices</span></li>
                                @endif
                                @if ($user->invoice_viewing===1)
                                <li><span >View Invoices</span></li>
                                @endif
                                @if($user->invoice_editing_delete===1)
                                <li><span >Edit & Delete Invoice</span></li>
                                @endif
                                 @if ($user->setting_creating===1)
                                <li><span>Create System Settings</span></li>
                                @endif
                                @if($user->setting_editing_delete===1)
                                <li><span >Edit & Delete Settings</span></li>
                                @endif
                                 @if ($user->user_creating===1)
                                <li><span>Create System Users</span></li>
                                @endif
                                @if ($user->user_viewing===1)
                                <li><span >View System Users</span></li>
                                @endif
                                @if($user->user_editing_delete===1)
                                <li><span >Edit & Delete System Users</span></li>
                                @endif
                                @if ($user->report_viewing===1)
                                <li><span >View Reports</span></li>
                                @endif
                               </ul>
                                
                            </td>
                            <!--<td>-->

                            <!--    <form action="{{ route('admin.toggleRole',$user->id) }}" method="post">-->
                            <!--        @csrf-->
                            <!--        @if ($user->is_admin===1)-->
                            <!--        <input type="submit" class="btn btn-success btn-sm " value="Make Agent">-->
                            <!--        @elseif($user->is_super===1 && $user->is_admin===1 )-->
                            <!--        <input type="submit" class="btn btn-secondary btn-sm" value="Make Office Manager">-->
                            <!--        @else-->
                            <!--        <input type="submit" class="btn btn-danger btn-sm" value="Make Administrator">-->
                            <!--        @endif-->
                            <!--    </form>-->



                            <!--</td>-->
                            <td>

                                 <div class="dropdown-item ">
                                                <a class="btn btn-sm btn-success btn-block" href="{{route('admin.editpassword', $user->id)}}"> Edit</a>
                                            </div>



                            </td>
                            <td>
                                <div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
            <div class="dropdown-item ">
                                                <a class="btn btn-info btn-block" href="{{route('admin.edit', $user->id)}}"> Edit</a>
                                            </div>
                                             <div class="dropdown-item ">
                                                <form action="{{ route('admin.delete',$user->id) }}" method="post" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                
                                                    <input type="submit" class="btn btn-danger btn btn-block" value="Delete">
                                                </form>
                                                <!--<a class="btn btn-danger btn-block" href="{{route('admin.delete', $user->id)}}"> Delete</a> -->
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
</div>
<!-- /Page Content -->

@endsection

@push('footer_scripts')
<script>
   $(document).on('submit','.delete-form',function(event){
           return confirm(" Are you sure you want to delete this admin ? ");
   });

</script>
@endpush