<?php

namespace App\Http\Controllers;

use App\AgencyExpenses;
use App\Apartment;
use App\Deposit;
use App\House;
use App\HouseTenant;
use App\Invoice;
use App\User;
use App\Landlord;
use App\MonthlyBilling;
use App\Overpayment;
use App\PlacementFee;
use App\Subscription;
use App\ServiceRequests;
use App\Tenant;
use App\PayOwners;
use App\Viewingfees;
use App\Bills;
use App\Log;
use App\Message;
use App\Replies;
use App\ManualPayment;
use App\ManagerPayment;
use App\BillsPayment;
use App\BillManagerPayments;
use Auth;
use App\Traits\UtilTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ApiController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
    public function __construct()
    {
        $this->middleware('auth');
    }




//   Beggining of member datatable


    public function getActiveTenants()
    {
        //$model = Tenant::query();
        
        $tenants = Tenant::all();
        $checking = HouseTenant::with('tenant')->select(['tenant_id']);
        return Datatables::of($tenants)
            // ->addColumn('view', function ($tenants) {
            //     return '<a href="' . route('tenant.show', $tenants->id) . '" class="btn btn-info waves-effect waves-light">Details</a>';
            // })
            
                 ->editColumn('status', function ($tenants) {

                if ($tenants->status == 0) {
                    return '<span class="badge bg-danger">Deregistered</span>';
                } 
                elseif($tenants->status == 1){
                    return '<span class="badge bg-success">Registered</span>';
                }
                elseif($tenants->status == 2){
                    return '<span class="badge bg-warning">Suspended</span>';
                }
                else{
                    return '<span class="badge bg-info">Pending</span>';
                }
                
                 })
                 ->editColumn('license', function ($tenants) {

                    if ($tenants->license == 0) {
                        return '<span class="badge bg-danger">Not Licensed</span>';
                    } 
                    else{
                        return '<span class="badge bg-success">Licensed</span>';
                    }
                    
                     })
           
            
          
                ->addColumn('actions', function ($tenants) {

                    // Delete permission auth
                    $delete_form = '';
    
                    if (Auth::user()->member_editing_delete==1 && Auth::user()->member_viewing==1) {
                        $delete_form = '
                    <form class="dropdown-item delete-tenant" method="POST" action="' . route('tenant.delete', $tenants->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                    
    
                            $html = '<div class="text-right">
                            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v "></i>
                            </div>
                            <div class="dropdown-menu" role="menu">
                            
                             <div class="dropdown-item ">
                                            <a class="btn btn-success btn-block" href="' . route('tenant.show', $tenants->id) . '"> View</a>
                                        </div>
                            <div class="dropdown-item ">
                            <a href="' . route('tenant.edit', $tenants->id) . '" class="btn btn-info btn-block">Edit</a>
                            </div>
                                ' . $delete_form . '
                            </div>
                        </div>';
    
                    return $html;
                    }elseif (Auth::user()->member_editing_delete==1 ) {
                        $delete_form = '
                    <form class="dropdown-item delete-tenant" method="POST" action="' . route('tenant.delete', $tenants->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                    
    
                            $html = '<div class="text-right">
                            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v "></i>
                            </div>
                            <div class="dropdown-menu" role="menu">
                            
                            
                            <div class="dropdown-item ">
                            <a href="' . route('tenant.edit', $tenants->id) . '" class="btn btn-info btn-block">Edit</a>
                            </div>
                                ' . $delete_form . '
                            </div>
                        </div>';
    
                    return $html;
                    }
                    elseif (Auth::user()->member_viewing==1){
                  
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href="' . route('tenant.show', $tenants->id) . '"> View</a>
                                        </div>
                                       
                                       
    
                                    </div>
                                </div>
                            </div>';
                            $html = '<div class="text-right">
                            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v "></i>
                            </div>
                            <div class="dropdown-menu" role="menu">
                            
                            <div class="dropdown-item ">
                            <a href="' . route('tenant.show', $tenants->id) . '" class="btn btn-success btn-block" >View</a>
                            </div>
                                ' . $delete_form . '
                            </div>
                        </div>';
    
                    return $html;
                    }
                })
                ->rawColumns(['actions', 'status', 'license'])
                ->toJson();

    }
    // end of members datatable
    
    
    
    
    
    
    
    
    
    // start of deleted items datatable
    
    
    
    
    public function houses_trashed()
    {
        $query = House::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href=""> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
    public function invoices_trashed()
    {
        $query = Invoice::onlyTrashed()->orderBy('created_at', 'DESC')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . url('softdeletes/delete/Invoice', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action" method="POST">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block"  href="' . url('softdeletes/restore/Invoice', $query->id) . '"> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
    public function landlord_trashed()
    {
        $query = Landlord::onlyTrashed()->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . url('softdeletes/delete/Landlord', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action" method="POST">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block"  href="' . url('softdeletes/restore/Landlord', $query->id) . '"> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
    public function apartments_trashed()
    {
        $query = Apartment::onlyTrashed()->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . url('softdeletes/delete/Apartment', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action" method="POST">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block"  href="' . url('softdeletes/restore/Apartment', $query->id) . '"> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
    public function tenants_trashed()
    {
        $query = Tenant::onlyTrashed()->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . url('softdeletes/delete/Tenant', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action" method="POST">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block"  href="' . url('softdeletes/restore/Tenant', $query->id) . '"> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
    public function bills_trashed()
    {
        $query = PayOwners::onlyTrashed()->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . url('softdeletes/delete/PayOwners', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action" method="POST">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block"  href="' . url('softdeletes/restore/PayOwners', $query->id) . '"> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
   public function user_trashed()
    {
        $query = User::onlyTrashed()->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
          ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . url('softdeletes/delete/User', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete Parmanently" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action" method="POST">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block"  href="' . url('softdeletes/restore/User', $query->id) . '"> Restore</a>
                                        </div>
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    
                })
                ->rawColumns(['actions'])
            ->toJson();
    }
    
    // end of deleted items datatables
    
    
    
    
    
    
    // Start of subscription categories list
    
    
    
     public function getSubscriptionlist()
    {
        $query = Subscription::all();
       
        return DataTables::of($query )
        ->addIndexColumn()
         ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    if (Auth::user()->setting_editing==1)
                        $delete_form = '
                       
                    <form class="dropdown-item delete-tenant" method="POST" action="' . route('subscription.delete', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                     $html = '<div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
           
            <div class="dropdown-item ">
            <a href="' . route('subscription.edit', $query->id) . '" class="btn btn-info btn-block">Edit</a>
            </div>
                ' . $delete_form . '
            </div>
        </div>';
        
                               

               

                return $html;
                
                    
                    })
                ->rawColumns(['actions'])
       
            ->toJson();
    }
    
    // end of subscription categories list
    
    
    
    
    
    
    
    
    // start list of log activities
    
    public function getAlllogs()
    {
        $query = Log::all();
       
        return DataTables::of($query )
        ->addIndexColumn()
          
            ->toJson();
    }
     public function getApartmentlogs()
    {
        $query = Log::where('apartment_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
     public function getTenantslogs()
    {
        $query = Log::where('tenant_id','!=', '0')->where('user_name','!=', 'CRON Job')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    public function getServicerequestlogs()
    {
        $query = Log::where('servicerequest_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    public function getOwnerslogs()
    {
        $query = Log::where('landlord_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    public function getHouselogs()
    {
        $query = Log::where('house_id','!=', '0')->get();
       
        return DataTables::of($query )
         ->addIndexColumn()
       
            ->toJson();
    }
    public function getBillslogs()
    {
        $query = Log::where('bill_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    public function getInvoiceslogs()
    {
        $query = Log::where('invoice_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    public function getSmslogs()
    {
        $query = Log::where('sms_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    public function getUserslogs()
    {
        $query = Log::where('user_id','!=', '0')->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
       
            ->toJson();
    }
    
    // end of logs activities
    
    
    
    
    
    // start of emailing list
    
    
    public function getAllInbox()
    {
        $query = Message::where('receiver_id', Auth::user()->id)->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
         ->addColumn('status', function ($query) {
            if($query->status == null){
               return '<span class="badge bg-success">New Reply</span>'; 
            }
            elseif($query->status == 2){
                return '<span class="badge bg-danger">New Message</span>'; 
            }
            else{
               
               return '<span class="badge bg-primary">Replied</span>';
            }
           
            
  
        })
        ->addColumn('message', function ($query) {
           
            return (strlen($query->message) > 15) ? substr($query->message,0,10) : $query->message. '...';
               
        })
         ->addColumn('actions', function ($query) {
              
            // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('email.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="btn-group mt-2 mb-2">
            <button type="button" class="btn btn-dropdown-icon btn-pill dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li class="dropdown-plus-title">
                    Dropdown
                    <b class="fa fa-angle-up" aria-hidden="true"></b>
                </li>
                <li><a href="' . route('email.show', $query->id) . '">View</a></li>
                
            </ul>
        </div>';

            return $html;
               
        })
        ->rawColumns(['actions','message', 'status'])
       
            ->toJson();
    }
    
    // end of emailing list
    
    
    // Start of sent email list
    
    
   public function getAllSent()
    {
        $query = Message::where('user_id', Auth::user()->id)->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
        ->addColumn('status', function ($query) {
            if($query->status == 2){
               return '<span class="badge bg-success">Message Sent</span>'; 
            }
            elseif($query->status == null){
               return '<span class="badge bg-primary">Reply Sent</span>';  
            }
             else{
               return '<span class="badge bg-danger">New Reply</span>';  
            }
           
           
            
  
        })
        ->addColumn('message', function ($query) {
           
            return (strlen($query->message) > 15) ? substr($query->message,0,10) : $query->message. '...';
               
        })
         ->addColumn('actions', function ($query) {
              
            // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('email.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                                <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-primary btn-block" href="' . route('email.show-sent', $query->id) . '"> View</a>
                                    </div>

                               
                            </div>
                        </div>
                    </div>';

            return $html;
               
        })
        ->rawColumns(['actions','message', 'status'])
       
            ->toJson();
    }
    
    // end of email list sent
    
    
    
  public function getAllImportant()
    {
        $query = Message::where('important', '!=', 0)->where('receiver_id', Auth::user()->id)->get();
       
        return DataTables::of($query )
        ->addIndexColumn()
        ->addColumn('status', function ($query) {
            if($query->status == 1){
               return '<span class="badge bg-success">New Replies</span>'; 
            }
            elseif($query->status == 2){
                return '<span class="badge bg-danger">New Message</span>'; 
            }
            else{
               
               return '<span class="badge bg-primary">Replied</span>';
            }
           
            
  
        })
        ->addColumn('message', function ($query) {
           
            return (strlen($query->message) > 15) ? substr($query->message,0,10) : $query->message. '...';
               
        })
         ->addColumn('actions', function ($query) {
              
            // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('email.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                                <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-primary btn-block" href="' . route('email.show', $query->id) . '"> View</a>
                                    </div>

                               
                            </div>
                        </div>
                    </div>';

            return $html;
               
        })
        ->rawColumns(['actions','message', 'status'])
       
            ->toJson();
    }
    
    
    
    // end of emails
    
    
    
    
    // start of landlord list
    // public function getAllLandlords()
    // {
    //     // $query=Landlord::withCount('apartments')->get();
    //     $landlords = Landlord::select('landlords.*');

    //     return DataTables::of($landlords)
    //         ->addColumn('count', function ($landlords) {
    //             return $landlords->apartments->count();
    //         })
    //         // ->addColumn('view', function ($landlords) {
    //         //     return '<a href="' . route('landlord.show', $landlords->id) . '" class="btn btn-info waves-effect waves-light">Details</a>';
    //         // })
    //         ->addColumn('actions', function ($landlords) {

    //             // Delete permission auth
    //             $delete_form = '';

    //             if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
    //                 $delete_form = '
    //             <form class="dropdown-item delete-landlord" method="POST" action="' . route('landlord.delete', $landlords->id) . '">
    //                 <input type="hidden" name="_method" value="delete" />
    //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                 <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
    //             </form>';
               

    //             $html = '<div class="text-right">
    //                         <div class="dropdown dropdown-action">
				// 		    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    //                             <div class="dropdown-menu dropdown-menu-right">
    //                                 <div class="dropdown-item ">
    //                                     <a class="btn btn-sm btn-info btn-block" href="' . route('landlord.show', $landlords->id) . '"> View</a>
    //                                 </div>
    //                                 <div class="dropdown-item ">
    //                                     <a class="btn btn-sm btn-secondary btn-block" href="' . route('landlord.edit', $landlords->id) . '"> Edit</a>
    //                                 </div>

    //                                 ' . $delete_form . '
				// 		    	</div>
    //                         </div>
    //                     </div>';

    //             return $html;
    //             }else{
             
               

    //             $html = '<div class="text-right">
    //                         <div class="dropdown dropdown-action">
				// 		    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    //                             <div class="dropdown-menu dropdown-menu-right">
    //                                 <div class="dropdown-item ">
    //                                     <a class="btn btn-sm btn-info btn-block" href="' . route('landlord.show', $landlords->id) . '"> View</a>
    //                                 </div>
                              
				// 		    	</div>
    //                         </div>
    //                     </div>';

    //             return $html;
    //             }
    //         })
    //         ->rawColumns(['actions'])
    //         // ->addColumn('actions', function ($landlords) {
    //         //     if (Auth::user()->is_admin || Auth::user()->is_super) {
    //         //         return '

    //         //             <form action=" ' . route('landlord.delete', $landlords->id) . '"  class="delete-landlord" method="post">
    //         //                 <input type="hidden" name="_method" value="delete" />
    //         //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //         //                 <input class="btn btn-danger waves-effect waves-light" type="submit" value="Delete" />
    //         //             </form>

    //         //             ';

    //         //     } else {
    //         //         return '';

    //         //     }

    //         // })
    //         // ->rawColumns(['view', 'actions'])
    //         ->toJson();
    // }
    
    
    // start of manager payment list
    
    public function getAllManagerPayments()
    {
        // $query=Landlord::withCount('apartments')->get();
        $query = ManagerPayment::where('status','!=', '1')->get();
        // foreach($query as $qr){
        //     $qr['test'] ='ola';
        // }
       
        
       
        return DataTables::of($query )
           
        ->addIndexColumn()
        ->addColumn('status', function ($query) {
            if($query->status === 0){
               return '<span class="badge bg-primary">Pending</span>'; 
            }
            elseif($query->status === 1){
               return '<span class="badge bg-success">Approved</span>';  
            }
            else{
                return '<span class="badge bg-danger">Rejected</span>'; 
            }
            
  
        })
        ->addColumn('actions', function ($query) {
               if($query->status === 0){
            // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('managerpayment.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                                <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-primary btn-block" href="' . route('managerpayment.edit', $query->id) . '"> Edit</a>
                                    </div>

                                ' . $delete_form . '
                            </div>
                        </div>
                    </div>';

            return $html;
               }
               elseif ($query->status === 1){
                   // Delete permission auth
            

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                                <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-success btn-block" href="#">Approved</a>
                                    </div>

                               
                            </div>
                        </div>
                    </div>';

            return $html;
               }
               else{
                   // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('managerpayment.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                              

                                ' . $delete_form . '
                            </div>
                        </div>
                    </div>';

            return $html;  
               }
        })
        ->rawColumns(['actions', 'status'])
            
            ->toJson();
    }
    
    
    // end of manager payment list
    
    
    
    
    // list of all payments
    
    
     public function getAllPayments()
    {
        // $query=Landlord::withCount('apartments')->get();
        $query = ManualPayment::all();
        // foreach($query as $qr){
        //     $qr['test'] ='ola';
        // }
       
        
       
        return DataTables::of($query )
           
        ->addIndexColumn()
        ->addColumn('full_name', function ($query) {
            if($query->FirstName != null){
                return "{$query->FirstName} {$query->MiddleName} {$query->LastName}";
            }
            elseif($query->full_name != null){
               return $query->full_name; 
            }
            else{
                return 'No name indicated';
            }
            })
        ->addColumn('actions', function ($query) {

            // Delete permission auth
            $delete_form = '';

            if ( $query->TransactionType != 'Pay Bill' && Auth::user()->is_admin==2) {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('manualinvoice.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                

                                ' . $delete_form . '
                            </div>
                        </div>
                    </div>';

            return $html;
        })
        ->rawColumns(['actions'])
            
            ->toJson();
    }
    
    
    // end of list payments
    
    // bills lists
     public function getAllManagerBillPayments()
    {
        // $query=Landlord::withCount('apartments')->get();
        $query = BillManagerPayments::where('status','!=', '1')->get();
        // foreach($query as $qr){
        //     $qr['test'] ='ola';
        // }
       
        
       
        return DataTables::of($query )
           
        ->addIndexColumn()
        ->addColumn('status', function ($query) {
            if($query->status === 0){
               return '<span class="badge bg-primary">Pending</span>'; 
            }
            elseif($query->status === 1){
               return '<span class="badge bg-success">Approved</span>';  
            }
            else{
                return '<span class="badge bg-danger">Rejected</span>'; 
            }
            
  
        })
         ->addColumn('name', function ($query) {
            if($query->full_name != null ){
               return $query->full_name; 
            }
            else{
                return 'Agency';
            }
       
        })
        ->addColumn('actions', function ($query) {
               if($query->status === 0){
            // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('managerbillpayment.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                                <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-primary btn-block" href="' . route('managerbillpayment.edit', $query->id) . '"> Edit</a>
                                    </div>

                                ' . $delete_form . '
                            </div>
                        </div>
                    </div>';

            return $html;
               }
               elseif ($query->status === 1){
                   // Delete permission auth
            

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                                <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-success btn-block" href="#">Approved</a>
                                    </div>

                               
                            </div>
                        </div>
                    </div>';

            return $html;
               }
               else{
                   // Delete permission auth
            $delete_form = '';

             {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('managerbillpayment.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 
                              

                                ' . $delete_form . '
                            </div>
                        </div>
                    </div>';

            return $html;  
               }
        })
        ->rawColumns(['actions', 'status'])
            
            ->toJson();
    }
     public function getAllBillPayments()
    {
        // $query=Landlord::withCount('apartments')->get();
        $query = BillsPayment::all();
        // foreach($query as $qr){
        //     $qr['test'] ='ola';
        // }
       
        
       
        return DataTables::of($query )
           
        ->addIndexColumn()
        // ->addColumn('test', function ($payment) {
        //         return $payment->test;
        //     })
        ->addColumn('actions', function ($query) {

            // Delete permission auth
            $delete_form = '';

            if ( $query->TransactionType != 'Pay Bill' && Auth::user()->is_admin==2) {
                $delete_form = '
            <form class="dropdown-item delete-landlord" method="POST" action="' . route('managerbillpayment.delete', $query->id) . '">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
            </form>';
            }

            $html = '<div class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                

                                ' . $delete_form . '
                            </div>
                        </div>
                    </div>';

            return $html;
        })
        ->rawColumns(['actions'])
            
            ->toJson();
    }
    
    
    // end of bills lists
    
    
    // list of apartments

    public function getAllApartments()
    {
        $apartments = Apartment::with('landlord')->select('apartments.*');

        return DataTables::of($apartments)
            ->removeColumn('password')
           
           
            ->addColumn('action', function ($apartments) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form class="dropdown-item delete-house" id="delete-house" method="POST" action="' . route('apartment.delete', $apartments->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="' . route('apartment.show', $apartments->id) . '"> View</a>
                                    </div>
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-secondary btn-block" href="' . route('apartment.edit',$apartments->id) . '"> Edit</a>
                                    </div>
                                      ' . $delete_form . '
                                    
						    	</div>
                            </div>
                        </div>';

                return $html;
                } else{
                    
             
                

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="' . route('apartment.show', $apartments->id) . '"> View</a>
                                    </div>
                                 
						    	</div>
                            </div>
                        </div>';

                return $html;
                }
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    
    // end list apatments
    

    // list of all houses
    
    public function getAllApartmentsHouses(Request $request)
    {
       
        $house = House::with('apartment')->select('houses.*');

        return dataTables::of($house)
            ->addColumn('owner', function ($house) {
                return $house->apartment->landlord->full_name;
            })
            ->addColumn('rent', function ($house) {
                return 'Ksh ' . number_format($house->rent->amount);
            })
            ->editColumn('is_occupied', function ($house) {

                if ($house->is_occupied == 0) {
                    return '<span class="badge bg-danger">VACANT</span>';
                } 
                else {
                    return '<span class="badge bg-success">OCCUPIED</span>';
                }

            })
            ->editColumn('notice', function ($house) {

                if ($house->notice == 0) {
                    return '<span class="badge bg-success">NO NOTICE</span>';
                } 
                else {
                    return '<span class="badge bg-danger">UNDER NOTICE</span>';
                }

            })
            // ->filter(function ($instance) use ($request) {
            //     if ($request->get('is_occupied') == '0' || $request->get('is_occupied') == '1') {
            //         $instance->where('is_occupied', $request->get('is_occupied'));
            //     }
            //     if (!empty($request->get('search'))) {
            //          $instance->where(function($w) use($request){
            //             $search = $request->get('search');
            //             $w->orWhere('house_no', 'LIKE', "%$search%");
                        
            //         });
            //     }
            // })

            ->addColumn('action', function ($house) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form  class="dropdown-item delete-house" method="POST" action="' . route('house.delete', $house->id) . '">
                    
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input  class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                </form>';
               

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-success btn-block" href="' . route('house.show', $house->id) . '"> View</a>
                                        
                                    </div>
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-primary btn-block" href="' . route('house.edit', $house->id) . '"> Edit</a>
                                        
                                    </div>
                                    
                                  
                                        ' . $delete_form . '
                                        
                                       
                               
						    	</div>
                            </div>
                        </div>
                        ';

                return $html;
            } else {
               

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="#"> View</a>
                                    </div>

						    	</div>
                            </div>
                        </div>';

                return $html;
            }
            })
            ->rawColumns(['action', 'is_occupied', 'notice'])
            ->toJson();

    }
    
    // end all houses list
    
    
    // service requests lists

    public function getAllServiceRequests()
    {
        $servicerequests = ServiceRequests::with('house')->select('service_requests.*');

        return dataTables::of($servicerequests)
            
            ->addColumn('full_name', function ($servicerequests) {
                if($servicerequests->tenant_id == null){
                    return 'General Apartment Service';
                }
                else{
                return $servicerequests->tenant->full_name;}
            })
            ->addColumn('name', function ($servicerequests) {
                return $servicerequests->apartment->name;
            })
            ->addColumn('house_no', function ($servicerequests) {
                if($servicerequests->house_id == null){
                    return 'General Apartment Service';
                }
                else{
                 return $servicerequests->house->house_no;}
            })
            ->editColumn('status', function ($servicerequests) {
                         if($servicerequests->status_edit == 0  ){
                            if ($servicerequests->status == 1) {
                                return '<span class="badge bg-danger">CLOSED</span>';
                            } elseif ($servicerequests->status == 2) {
                                return '<span class="badge badge-info">IN PROGRESS</span>';
                            }
                            else {
                                return '<span class="badge bg-success">OPEN</span>';
                            }
                         }
                         if($servicerequests->status_edit == 0  ){
                            if ($servicerequests->status == 1) {
                                return '<span class="badge bg-danger">CLOSED</span>';
                            } elseif ($servicerequests->status == 2) {
                                return '<span class="badge badge-info">IN PROGRESS</span>';
                            }
                            else {
                                return '<span class="badge bg-success">OPEN</span>';
                            }
                         }
                         elseif($servicerequests->status_edit == $servicerequests->status){
                            if ($servicerequests->status == 1) {
                                return '<span class="badge bg-danger">CLOSED</span>';
                            } elseif ($servicerequests->status == 2) {
                                return '<span class="badge badge-info">IN PROGRESS</span>';
                            }
                            else {
                                return '<span class="badge bg-success">OPEN</span>';
                            }
                         }
                         elseif($servicerequests->approval == 2 ){
                            if ($servicerequests->status == 1) {
                                return '<span class="badge bg-danger">CLOSED</span>';
                            } elseif ($servicerequests->status == 2) {
                                return '<span class="badge badge-info">IN PROGRESS</span>';
                            }
                            else {
                                return '<span class="badge bg-success">OPEN</span>';
                            }
                         }
                         else
                         if ($servicerequests->status_edit == 1) {
                                return '<span class="badge bg-danger">CLOSED</span>';
                            } elseif ($servicerequests->status_edit == 2) {
                                return '<span class="badge badge-info">IN PROGRESS</span>';
                            }
                            else {
                                return '<span class="badge bg-success">OPEN</span>';
                            }
            
                        })
            
                        
             ->editColumn('approval', function ($servicerequests) {

                            if ($servicerequests->approval == 0) {
                                return '<span class="badge badge-info">PENDING</span>';
                            } elseif ($servicerequests->approval == 1) {
                                return '<span class="badge bg-success">APPROVED</span>';
                            }
                            elseif ($servicerequests->approval == 3) {
                                return '<span class="badge badge-secondary">AMEND</span>';
                            }
                            else {
                                return '<span class="badge bg-danger">DECLINED</span>';
                            }
            
                        })
                        ->addColumn('action', function ($servicerequests) {

                            // Delete permission auth
                            $delete_form = '';
            
                            if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                                if ($servicerequests->approval == 3){
                                $delete_form = '
                            <form class="dropdown-item delete-house" method="POST" action="' . route('servicerequests.delete', $servicerequests->id) . '">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                            </form>';
                           
            
                            $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-info btn-block" href="' .  route('servicerequests.edit', $servicerequests->id) . '"> Edit</a>
                                                </div>
            
                                           
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                elseif($servicerequests->approval == 1 && $servicerequests->status != 1 ){
                                    $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            
                                            <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-info btn-block" href="' .  route('servicerequests.edit', $servicerequests->id) . '"> Edit</a>
                                                </div>
                                            
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                 elseif($servicerequests->status == 1){
                                    $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            
                                           
                                            
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                elseif($servicerequests->approval == 2){
                                      $delete_form = '
                            <form class="dropdown-item delete-house" method="POST" action="' . route('servicerequests.delete', $servicerequests->id) . '">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                            </form>';
                            $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-item ">
                                                     ' . $delete_form . '
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                else{
                                      $delete_form = '
                            <form class="dropdown-item delete-house" method="POST" action="' . route('servicerequests.delete', $servicerequests->id) . '">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                            </form>';
                           
            
                            $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-info btn-block" href="' .  route('servicerequests.edit', $servicerequests->id) . '"> Edit</a>
                                                </div>
                                                <div class="dropdown-item ">
                                                     ' . $delete_form . '
                                                </div>
                                           
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                        
                            }else{
                                if ($servicerequests->approval == 3){
                                $delete_form = '
                            <form class="dropdown-item delete-house" method="POST" action="' . route('servicerequests.delete', $servicerequests->id) . '">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                            </form>';
                           
            
                            $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                
            
                                           
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                elseif($servicerequests->approval == 1 && $servicerequests->status != 1 ){
                                    $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            
                                           
                                            
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                 elseif($servicerequests->status == 1){
                                    $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            
                                           
                                            
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                }
                                
                                else{
                             
                           
            
                            $html = '<div class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-item ">
                                                    <a class="btn btn-sm btn-success btn-block" href="' .  route('servicerequests.show', $servicerequests->id) . '"> View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            
                            return $html;
                                } 
                            }
                            
                        })
                    
           
            ->rawColumns(['full_name','approval','name','house_no','status','action'])
            ->toJson();

    }
    
    
    // end service request list
    
    
    
    // agency expenses list
    
    public function getAllAgencyExpenses()
    {
        $agency_expenses = AgencyExpenses::select('agency_expenses.*');

        return dataTables::of($agency_expenses)
            
            ->editColumn('status', function ($agency_expenses) {

                            if ($agency_expenses->status == 1) {
                                return '<span class="badge bg-success">PAID</span>';
                            } 
                            else {
                                return '<span class="badge bg-danger">UNPAID</span>';
                            }
            
                        })

            ->addColumn('action', function ($agency_expenses) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form class="dropdown-item delete-house" method="POST" action="' . route('expenses.delete', $agency_expenses->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <i class="material-icons">visibility</i>
                    <input class="btn btn-sm  btn-danger " type="submit" class="edit" value="" />
                </form>';
                }

                $html = '<div class="text-right">
                                     <div>
                                        <a class=" " href="' . route('expenses.edit', $agency_expenses->id) . '"> <i class="material-icons">edit</i></a>
                                    </div>
                                   
                        </div>';

                return $html;
            })
           // ->rawColumns(['penalty_fee', 'is_paid', 'download', 'delete', 'total_payable', 'carryforward', 'balance', 'paid_in'])
            ->rawColumns(['status','action'])
            ->toJson();

    }
    
    // end agency expenses list
    
    
    
    
    // starting tenants report
    
    
    public function getTenantsReport()
    {
        $house_tenants = HouseTenant::with('tenant', 'apartment')->select('house_tenants.*');

        return dataTables::of($house_tenants)
            
        ->addColumn('full_name', function ($house_tenants) {
            return $house_tenants->tenant->full_name;
        })
        ->addColumn('id', function ($house_tenants) {
            return $house_tenants->tenant->id;
        })
            
            ->addColumn('name', function ($house_tenants) {
                return $house_tenants->house->apartment->name;
            })
            ->addColumn('house_no', function ($house_tenants) {
                 return $house_tenants->house->house_no;
            })
            

            ->addColumn('actions', function ($house_tenants) {

            $html = '<div class="text-right">
                                     <div>
                                        <a class=" " href="' . route('tenant.report', $house_tenants->tenant->id) . '"> <i class="material-icons">get_app</i></a>
                                    </div>
                            
                        </div>';

                return $html;
            })
           // ->rawColumns(['penalty_fee', 'is_paid', 'download', 'delete', 'total_payable', 'carryforward', 'balance', 'paid_in'])
            ->rawColumns(['actions'])
            ->toJson();

    }
    
    
    
    // end of tenants report
    
    
    
    // Start of service bills
    
    public function getAllServiceBills()
    {
        $servicerequests = ServiceRequests::with('house')->select('service_requests.*');

        return dataTables::of($servicerequests)
            ->addColumn('phone', function ($servicerequests) {
                return $servicerequests->tenant->id;
            })
            ->addColumn('full_name', function ($servicerequests) {
                return $servicerequests->tenant->full_name;
            })
            ->addColumn('owner', function ($servicerequests) {
                return $servicerequests->apartment->landlord->full_name;
            })
            ->addColumn('name', function ($servicerequests) {
                return $servicerequests->apartment->name;
            })
            ->addColumn('house_no', function ($servicerequests) {
                 return $servicerequests->house->house_no;
            })
            ->editColumn('pay_status', function ($servicerequests) {

                            if ($servicerequests->pay_status == 1) {
                                return '<span class="badge bg-success">PAID</span>';
                            } elseif ($servicerequests->pay_status == 2) {
                                return '<span class="badge badge-info">PARTIAL</span>';
                            }
                            else {
                                return '<span class="badge bg-danger">UNPAID</span>';
                            }
            
                        })

            ->addColumn('action', function ($servicerequests) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form class="dropdown-item delete-house" method="POST" action="' . route('servicerequests.delete', $servicerequests->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <i class="material-icons">visibility</i>
                    <input class="btn btn-sm  btn-danger " type="submit" class="edit" value="" />
                </form>';
              

                $html = '<div class="text-right">
                                     <div>
                                        <a class=" " href="' . route('servicerequests.edit', $servicerequests->id) . '"> <i class="material-icons">edit</i></a>
                                    </div>
                            
                        </div>';

                return $html;
                }
            })
           // ->rawColumns(['penalty_fee', 'is_paid', 'download', 'delete', 'total_payable', 'carryforward', 'balance', 'paid_in'])
            ->rawColumns(['pay_status','action'])
            ->toJson();

    }
    
    // end of service bills
  





    // getting vacant houses
    
    public function getVacantHouses()
    {
        $query = House::where('is_occupied', false)->with('apartment')->select('houses.*');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('rent', function ($query) {
                return 'Ksh.' . number_format($query->rent->amount);
            })
            ->addColumn('action', function ($query) {
                return '<div class="float-left">
                <a href="' . route('tenant.assign_room', $query->id) . '" class="btn btn-info">Place Tenant</a>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();

    }
    
    // end of vacant houses
    
   
    
    // getting occupied houses

    
    public function getOccupiedHousess()
    {
        $query = HouseTenant::with('tenant', 'house')->select('house_tenants.*');
         $rent = Invoice::selectRaw('SUM(balance) as bal, house_id')->where('house_id','!=', null)
            ->groupBy('house_id')
            ->get();
        $tenants = Tenant::select([
         'id',
         'full_name',
         'phone',
        'account_number',
        'status',
        //'pho',
        ]);

        return DataTables::of($query, $tenants, $rent)
            ->addIndexColumn()
            ->addColumn('tenant_names', function ($query) {
                return $query->tenant->full_name;
            })
            ->addColumn('account_number', function ($query) {
                return $query->tenant->account_number;
            })
            ->addColumn('phone_number', function ($query) {
                return $query->tenant->phone;
            })
            ->addColumn('building', function ($query) {
                return $query->house->apartment->name;
            })
             ->addColumn('rent', function ($query) {
                return 'Ksh.' . number_format($query->house->rent->amount);
            })
             ->addColumn('notice', function ($query) {

                if ($query->house->notice != 0) {
                     return '<span class="badge bg-danger">UNDER NOTICE</span>';
                    
                } 
                else {
                   return '<span class="badge bg-success">NO NOTICE</span>';
                }

            })
            
           
            ->addColumn('action', function ($query) {
                return '
                <div class="float-right">
                    <form action="' . route('tenant.vacate', $query->house->id) . '" method="POST" id="vacate-form" class="vacate-form">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE" >
                        <input class="btn btn-danger" type="submit" value="Vacate Tenant" />
                    </form>
                </div>
                ';
            })
            
            ->rawColumns(['action', 'actions', 'notice'])
            ->toJson();

    }
    public function getOccupiedHouses()
    {
        $query = HouseTenant::with('tenant', 'house')->select('house_tenants.*');
         $rent = Invoice::selectRaw('SUM(balance) as bal, house_id')->where('house_id','!=', null)
            ->groupBy('house_id')
            ->get();
        $tenants = Tenant::select([
         'id',
         'full_name',
         'phone',
        'account_number',
        'status',
        //'pho',
        ]);

        return DataTables::of($query, $tenants, $rent)
            ->addIndexColumn()
            ->addColumn('tenant_names', function ($query) {
                return $query->tenant->full_name;
            })
            ->addColumn('account_number', function ($query) {
                return $query->tenant->account_number;
            })
            ->addColumn('phone_number', function ($query) {
                return $query->tenant->phone;
            })
            ->addColumn('building', function ($query) {
                return $query->house->apartment->name;
            })
            ->addColumn('rent', function ($query) {
                return 'Ksh.' . number_format($query->house->rent->amount);
            })
            
           
            ->addColumn('action', function ($query) {
                return '
                <div class="float-right">
                    <form action="' . route('tenant.vacate', $query->house->id) . '" method="POST" id="vacate-form" class="vacate-form">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE" >
                        <input class="btn btn-danger" type="submit" value="Vacate Tenant" />
                    </form>
                </div>
                ';
            })
            ->addColumn('actions', function ($query) {

                    // Delete permission auth
                    $delete_form = '';
    
                    if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                        $delete_form = '
                    <form class="dropdown-item delete-tenant" method="POST" id="delete-tenant" action="' . route('tenant.delete', $query->tenant_id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                  
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href="' . route('tenant.show', $query->tenant_id) . '"> View</a>
                                        </div>
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-secondary btn-block" href="' . route('tenant.edit', $query->tenant_id) . '"> Edit</a>
                                        </div>
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    } else{
                        $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href="' . route('tenant.show', $query->tenant_id) . '"> View</a>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                    }
                })
            ->rawColumns(['action', 'actions'])
            ->toJson();

    }
    
    
    
    // end occupied houses
    
    
    
    // getting house types using AJAX

    public function getHouseTypes(Request $request)
    {
        if ($request->ajax()) {
            $houses = House::where('is_occupied', false)->where('apartment_id', $request->id)->get();
            $data = view('partials.houses', compact('houses'))->render();
            return response()->json(['options' => $data]);
        }

    }
    
    
    // end of house types using AJAX




    //  Occupied Ajax
    
    public function getOccupied(Request $request)
    {
        if ($request->ajax()) {
            $houses = House::where('is_occupied', true)->where('apartment_id', $request->id)->get();
            $data = view('partials.houses', compact('houses'))->render();
            return response()->json(['options' => $data]);
        }
    }
    
    
    // occupies Ajax

    public function getRequiredBills(Request $request)
    {
        if ($request->ajax()) {
            $house = House::findOrFail($request->id);

            return response()->json(['house_rent' => $house->rent->amount]);
        }
    }
    
    
    
    public function geTtenantsFromHouse(Request $request)
    {
        if ($request->ajax()) {
            $house_tenants = HouseTenant::findOrFail($request->house_id);
            return response()->json(['house_rent' => 'Ksh ' . number_format($house_tenants->house->rent->amount)]);
        }
    }



    public function getTenantDetails(Request $request)
    {
        if ($request->ajax()) {
            $tenant = Tenant::findOrFail($request->id);

            return response()->json(['house_no' => ($tenant->house_tenant->house->house_no)]);
        }
    }

    public function getAllDeposits()
    {
        $query = Deposit::where('is_active', true)->with('house', 'tenant')->select('deposits.*');

        return DataTables::of($query)
            ->addIndexColumn()
            // ->addColumn('tenant', function ($query) {
            //     return $query->tenant->full_name;
            // })
            ->addColumn('apartment', function ($query) {
                return $query->house->apartment->name;
            })
            ->addColumn('actions', function ($query) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form class="dropdown-item delete-house" method="POST" action="' . route('deposit.delete', $query->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                }

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="' . route('deposit.edit', $query->id) . '"> Edit</a>
                                    </div>

                                    ' . $delete_form . '
						    	</div>
                            </div>
                        </div>';

                return $html;
            })
            
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function getDepositsPerApartment(Request $request)
    {
        $apartment_id = $request->apartment;
        $month = $request->month . '-' . $request->year;

        if ($request->ajax()) {
            $query = Deposit::where('start_month', $month)
                ->where('is_active', true)
                ->where('apartment_id', $apartment_id)->with('tenant')->select('deposits.*');

            // $query=Deposit::with('tenant')->select('deposits.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('amount', 'Ksh {{number_format($amount)}}')
                ->addColumn('house_no', function ($query) {
                    return $query->house->house_no;
                })
                ->make(true);

        }
    }

    public function sumApartmentsDepositMonthly(Request $request)
    {

        $month = $request->month . '-' . $request->year;

        if ($request->ajax()) {
            $query = Deposit::selectRaw('SUM(amount) as smnt,apartment_id')->active()->where('start_month', $month)
                ->groupBy('apartment_id')
                ->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('amount', 'Ksh {{number_format($smnt)}}')
                ->addColumn('house', function ($query) {
                    return $query->apartment->name;
                })
                ->make(true);
        }

    }

    public function getPlacementFeesPerApartment(Request $request)
    {
        $apartment_id = $request->apartment;
        $month = $request->month . '-' . $request->year;

        if ($request->ajax()) {
            $query = PlacementFee::where('placement_month', $month)
                ->where('apartment_id', $apartment_id)->with('tenant')->select('placement_fees.*');

            // $query=Deposit::with('tenant')->select('deposits.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('amount', 'Ksh {{number_format($amount)}}')
                ->addColumn('share', function ($query) {
                    return 'Ksh ' . number_format(($query->amount) / 2);
                })
                ->addColumn('house_no', function ($query) {
                    return $query->house->house_no;
                })
                ->addColumn('actions', function ($query) {

                    if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                        return '

                                <div class="col-sm-6">
                                    <a href="' . route('placementfee.edit', $query->id) . '" class="btn btn-sm btn-info ">Edit</a>
                                </div>
                                <div class="col-sm-6">
                                    <form action=" ' . route('placementfee.delete', $query->id) . '"  class="delete-placement" method="post">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete" />
                                    </form>
                                </div>

                     ';
                    }

                })
                ->rawColumns(['actions'])
                ->make(true);

        }

    }

    public function sumApartmentPlacementFeesByApartment(Request $request)
    {
        $month = $request->month . '-' . $request->year;

        if ($request->ajax()) {
            $query = PlacementFee::selectRaw('SUM(amount) as smnt,apartment_id')->active()->where('placement_month', $month)
                ->groupBy('apartment_id')
                ->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('amount', 'Ksh {{number_format($smnt)}}')
                ->addColumn('share', function ($query) {
                    return 'Ksh ' . number_format(($query->smnt) / 2);})

                ->addColumn('house', function ($query) {
                    return $query->apartment->name;
                })
                ->make(true);
        }

    }

    public function getHouseMothlyBills(Request $request)
    {
        if ($request->ajax()) {
            $bills = MonthlyBilling::where([
                ['house_id', $request->house_id],
                ['billing_month', $request->month . '-' . $request->year],
            ])->get();

            $data = view('partials.house_monthly_bills', compact('bills'))->render();
            return response()->json(['options' => $data]);

        }

    }

    // public function getAllInvoices()
    // {
    //     $query = Invoice::with('house', 'tenant')->select('invoices.*');

    //     return DataTables::of($query)
        // ->addColumn('house_no',function($query){
        //     return $query->house->house_no;
        // })
    //         ->editColumn('rent', 'Ksh {{ number_format($rent)}}')
    //         ->editColumn('bills', 'Ksh {{ number_format($bills)}}')
    //         ->editColumn('carryforward', '<div class="text-default">Ksh {{ number_format($carryforward)}}</div>')
    //         ->editColumn('penalty_fee', '<div class="text-danger">Ksh {{ number_format($penalty_fee)}}</div>')
    //         ->editColumn('total_payable', '<div class="text-info">Ksh {{ number_format($total_payable)}}</div>')
    //         ->editColumn('paid_in', '<div class="text-info">Ksh {{ number_format($paid_in)}}</div>')
    //         ->editColumn('balance', '<div class="text-success">Ksh {{ number_format($balance)}}</div>')

    //         ->editColumn('is_paid', function ($query) {

    //             if ($query->is_paid) {
    //                 return '<span class="badge bg-success">PAID</span>';
    //             } else {
    //                 return '<span class="badge bg-danger">UNPAID</span>';
    //             }

    //         })
    //         ->addColumn('download', function ($query) {

    //             return '<a href="' . route('invoice.show', $query->id) . '" class="btn btn-sm btn-success" > <i class="fa fa-print"></i> </a>';
    //         })

    //         ->addColumn('delete', function ($query) {

    //             if (Auth::user()->is_admin || Auth::user()->is_super) {
    //                 return ' <form action=" ' . route('invoice.delete', $query->id) . '"  class="delete-invoice" method="post">
    //                                         <input type="hidden" name="_method" value="delete" />
    //                                         <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                                         <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
    //                                 </form>';

    //             } else {
    //                 return '';
    //             }

    //         })

    //         ->rawColumns(['penalty_fee', 'is_paid', 'download', 'delete', 'total_payable', 'carryforward', 'balance', 'paid_in'])

    //         ->toJson();

    // }
    
    
    
    
    public function getPayowners()
    {
        //$month = $request->month . '-' . $request->year;
        //$landlord_id = $request->landlord;
       //$query = PayOwners::with('house', 'landlord')->select('pay_owners.*');
        // $query = PayOwners::with('house', 'landlord')
        // ->where('landlord_id', $landlord_id)->select('pay_owners.*');
    
        $query = PayOwners::all();
        

        return DataTables::of($query)
        //  ->addColumn('house_no',function($query){
        //     return $query->house->house_no;
        // })
        ->addIndexColumn()
        
             ->editColumn('approval', function ($query) {

                            if ($query->approval == 0) {
                                return '<span class="badge bg-info">PENDING</span>';
                            } elseif ($query->approval == 1) {
                                return '<span class="badge bg-success">APPROVED</span>';
                            }
                            elseif ($query->approval == 3) {
                                return '<span class="badge bg-secondary">AMEND</span>';
                            }
                            else {
                                return '<span class="badge bg-danger">DECLINED</span>';
                            }
            
                        })
                        
            ->addColumn('action', function ($query) {

                // Delete permission auth
                
                 $delete_form = '';
    
                    if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                         if ($query->approval == 0){
                        $delete_form = '
                    <form class="dropdown-item delete-house" method="POST" action="' . route('payowner.delete', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-secondary btn-block" href="' . route('payowner.edit', $query->id) . '"> Edit</a>
                                        </div>
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                         }
                         elseif($query->approval == 1){
    
                    
                    $html = '<div class="text-right">
                    <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v "></i>
                    </div>
                    <div class="dropdown-menu" role="menu">
                    
                    <div class="dropdown-item ">
                                            <a class="btn btn-info btn-block" href="' . route('bill.show', $query->id) . '"> View</a>
                                        </div>
                   
                        
                    </div>
                </div>';
                return $html;

                         }
                         elseif($query->approval == 2){
                        $delete_form = '
                    <form class="dropdown-item delete-house" method="POST" action="' . route('payowner.delete', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       
                                       
    
                                        ' . $delete_form . '
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                         }
                         elseif($query->approval == 3){
                        $delete_form = '
                    <form class="dropdown-item delete-house" method="POST" action="' . route('payowner.delete', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-secondary btn-block" href="' . route('payowner.edit', $query->id) . '"> Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                         }
                    }else{
                        if ($query->approval == 0){
                        $delete_form = '
                    <form class="dropdown-item delete-house" method="POST" action="' . route('payowner.delete', $query->id) . '">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                    </form>';
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href=""> N/A</a>
                                        </div>
                                   
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                         }
                         elseif($query->approval == 1){
                        
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href="' . route('payowner.show', $query->id) . '"> View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                         }
                     
                         elseif($query->approval == 3){
                   
                    
    
                    $html = '<div class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item ">
                                            <a class="btn btn-sm btn-info btn-block" href=""> N/A</a>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>';
    
                    return $html;
                         }
                    }

                
            })
            
          

            ->rawColumns([ 'full_name','approval','total_owned','balance','apartment', 'action'])

            ->toJson();

    }
    public function getPayownerstotals()
    {
    
                    
       
        $rent_collection = PayOwners::selectRaw('SUM(total_owned) as sum_bills,SUM(balance) as bal,SUM(paid_in) as pay,SUM(bills) as bill, apartment_id, rent_month, max(created_at) as created_at')->where('type', 'Rent Collection')
           
            ->groupBy( 'rent_month', 'apartment_id')->orderBy('created_at', 'desc')
           
            ->get();
         
        
                
        return DataTables::of($rent_collection)
        //  ->addColumn('house_no',function($query){
        //     return $query->house->house_no;
        // })
        ->addIndexColumn()
        ->addColumn('full_name',function($rent_collection){
            return $rent_collection->apartment->landlord->full_name;
        })
        
        ->addColumn('apartment',function($rent_collection){
            return $rent_collection->apartment->name;
        })
        
        ->addColumn('sum_bills',function($rent_collection){
         
                      return $rent_collection->sum_bills;
           
       })
       ->addColumn('rent_month',function($rent_collection){
                  
                      return  $rent_collection->rent_month;
           
       })
       
        
       
       ->addColumn('bal',function($rent_collection){
       
                  return $rent_collection->bal;
        })
       
   ->addColumn('pay',function($rent_collection){
   
              return $rent_collection->pay;
    })
           // ->editColumn('rent_month', '{{($rent_month)}}')
            //->addColumn('rent_month', function ($query) {
                //return $query->rent_month;
           // ->editColumn('bills', 'Ksh {{ number_format($bills)}}')
           // ->editColumn('carryforward', '<div class="text-default">Ksh {{ number_format($carryforward)}}</div>')
           // ->editColumn('penalty_fee', '<div class="text-danger">Ksh {{ number_format($penalty_fee)}}</div>')
        //     ->editColumn('total_owned', '<div class="text-info">Ksh {{ number_format($smnt)}}</div>')
        //     ->editColumn('paid_in', '<div class="text-success">Ksh {{ number_format($paidtotal)}}</div>')
        //    ->editColumn('balance', '<div class="text-danger">Ksh {{ number_format($bal)}}</div>')

            // ->editColumn('pay_status', function ($query) {

            //     if ($query->pay_status) {
            //         return '<span class="badge bg-success">PAID</span>';
            //     } else {
            //         return '<span class="badge bg-danger">UNPAID</span>';
            //     }

            // })
           
            
          

            ->rawColumns([ 'full_name','apartment','rent_month'])

            ->toJson();

    }
    public function getInvoices()
    {
        $query = Invoice::with('tenant')->select('invoices.*');

     
        return DataTables::of($query)
        ->addIndexColumn()
       

            ->editColumn('is_paid', function ($query) {

                if ($query->is_paid > 0) {
                    return '<span class="badge bg-success">PAID</span>';
                } elseif ($query->is_paid == 0 && $query->paid_in > 0 ) {
                    return '<span class="badge bg-warning">PARTIAL</span>';
                } else{
                    return '<span class="badge bg-danger">UNPAID</span>';
                }

            })
            ->addColumn('action', function ($query) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->invoice_editing_delete==1 || Auth::user()->invoice_viewing==1) {
                    $delete_form = '
                <form class="dropdown-item delete-invoice" method="POST" action="' . route('invoice.delete', $query->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                
                $html = '<div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
            <div class="dropdown-item ">
            <a href="' . route('invoice.show', $query->id) . '" class="btn btn-success btn-block" >View</a>
            </div>
            <div class="dropdown-item ">
            <a href="' . route('invoice.edit', $query->id) . '" class="btn btn-info btn-block">Edit</a>
            </div>
                ' . $delete_form . '
            </div>
        </div>';
                }
                elseif (Auth::user()->invoice_editing_delete==1) {
                    $delete_form = '
                <form class="dropdown-item delete-invoice" method="POST" action="' . route('invoice.delete', $query->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                
                $html = '<div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
            
            <div class="dropdown-item ">
            <a href="' . route('invoice.edit', $query->id) . '" class="btn btn-info btn-block">Edit</a>
            </div>
                ' . $delete_form . '
            </div>
        </div>';
        
                               

               

              
                }else{
                    $delete_form = '
                <form class="dropdown-item delete-invoice" method="POST" action="' . route('invoice.delete', $query->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                
                $html = '<div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
            <div class="dropdown-item ">
            <a href="' . route('invoice.show', $query->id) . '" class="btn btn-success btn-block" >View</a>
            </div>
            
            </div>
        </div>';}
        
                               

               

                return $html;
                
            })
           

            ->rawColumns([ 'is_paid','action'])

            ->toJson();

    }
    
    
    
    // start of member invoices
    
    public function getMemberInvoices($id)
    {
        $query = Invoice::with('tenant')->select('invoices.*')->where('tenant_id', $id);

     
        return DataTables::of($query)
        ->addIndexColumn()
        
           // ->editColumn('rent_month', '{{($rent_month)}}')
            //->addColumn('rent_month', function ($query) {
                //return $query->rent_month;
           // ->editColumn('bills', 'Ksh {{ number_format($bills)}}')
           // ->editColumn('carryforward', '<div class="text-default">Ksh {{ number_format($carryforward)}}</div>')
           // ->editColumn('penalty_fee', '<div class="text-danger">Ksh {{ number_format($penalty_fee)}}</div>')
            ->editColumn('total_payable', '<div class="text-info">{{ $total_payable}}</div>')
            ->editColumn('paid_in', '<div class="text-success">{{ $paid_in}}</div>')
            ->editColumn('balance', '<div class="text-danger">{{$balance}}</div>')

            ->editColumn('is_paid', function ($query) {

                if ($query->is_paid > 0) {
                    return '<span class="badge bg-success">PAID</span>';
                } elseif ($query->is_paid == 0 && $query->paid_in > 0 ) {
                    return '<span class="badge bg-warning">PARTIAL</span>';
                } else{
                    return '<span class="badge bg-danger">UNPAID</span>';
                }

            })
            ->addColumn('action', function ($query) {

                // Delete permission auth
               
                $html = '<div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
            <div class="dropdown-item ">
            <a href="' . route('user_invoice.show', $query->id) . '" class="btn btn-success btn-block" >View</a>
            </div>
            </div>
        </div>';
        
                               

               

                return $html;
            })
            ->rawColumns(['action'])

            ->rawColumns([ 'is_paid', 'download', 'delete', 'total_payable', 'balance', 'paid_in', 'action'])

            ->toJson();

    }
    
    // end of member invoices



    public function getUnpaidInvoices(Request $request)
    {

           
            $query = Invoice::where('is_paid', 0)->with('house', 'tenant', 'apartment')->select('invoices.*');

          return DataTables::of($query)
         ->addColumn('house_no',function($query){
            if($query->house_id == null){
                return 'No House';
            }else{
                return $query->house->house_no;
            }
            
        })
        ->addColumn('property',function($query){
            return $query->apartment->name;
        })
           // ->editColumn('rent_month', '{{($rent_month)}}')
            //->addColumn('rent_month', function ($query) {
                //return $query->rent_month;
           // ->editColumn('bills', 'Ksh {{ number_format($bills)}}')
           // ->editColumn('carryforward', '<div class="text-default">Ksh {{ number_format($carryforward)}}</div>')
           // ->editColumn('penalty_fee', '<div class="text-danger">Ksh {{ number_format($penalty_fee)}}</div>')
            //->editColumn('total_payable', '<div class="text-info">Ksh {{ number_format($total_payable)}}</div>')
            //->editColumn('paid_in', '<div class="text-success">Ksh {{ number_format($paid_in)}}</div>')
            ->editColumn('balance', '<div class="text-danger">{{ $balance}}</div>')

            ->editColumn('is_paid', function ($query) {

                if ($query->is_paid) {
                    return '<span class="badge bg-success">PAID</span>';
                } else {
                    return '<span class="badge bg-danger">UNPAID</span>';
                }

            })
            ->addColumn('action', function ($query) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form class="dropdown-item delete-house" method="POST" action="' . route('invoice.delete', $query->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                }

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-success btn-block" href="' . route('invoice.show', $query->id) . '"> View Invoice</a>
                                    </div>
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="' . route('invoice.pay', $query->id) . '"> Pay House</a>
                                    </div>

                               
						    	</div>
                            </div>
                        </div>';

                return $html;
            })
            ->rawColumns(['action'])

            ->rawColumns([ 'is_paid','house_no', 'download', 'delete', 'total_payable', 'balance', 'paid_in', 'action'])

            ->toJson();

        

    }
    public function getpaidInvoices(Request $request)
    {

           
            $query = Invoice::where('is_paid', 1)->with('tenant')->select('invoices.*');

          return DataTables::of($query)
           // ->editColumn('rent_month', '{{($rent_month)}}')
            //->addColumn('rent_month', function ($query) {
                //return $query->rent_month;
           // ->editColumn('bills', 'Ksh {{ number_format($bills)}}')
           // ->editColumn('carryforward', '<div class="text-default">Ksh {{ number_format($carryforward)}}</div>')
           // ->editColumn('penalty_fee', '<div class="text-danger">Ksh {{ number_format($penalty_fee)}}</div>')
            //->editColumn('total_payable', '<div class="text-info">Ksh {{ number_format($total_payable)}}</div>')
            //->editColumn('paid_in', '<div class="text-success">Ksh {{ number_format($paid_in)}}</div>')
            // ->editColumn('balance', '<div class="text-danger">{{ $balance}}</div>')
           
            ->editColumn('is_paid', function ($query) {

                if ($query->is_paid) {
                    return '<span class="badge bg-success">PAID</span>';
                } else {
                    return '<span class="badge bg-danger">UNPAID</span>';
                }

            })
            ->addColumn('action', function ($query) {

                // Delete permission auth
                $delete_form = '';

                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    $delete_form = '
                <form class="dropdown-item delete-house" method="POST" action="' . route('invoice.delete', $query->id) . '">
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input class="btn btn-sm btn-danger btn-block" type="submit" value="Delete" />
                </form>';
                }

                $html = '<div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-primary btn-block" href="' . route('invoice.show', $query->id) . '"> View Invoice</a>
                                    </div>
                                    

                               
						    	</div>
                            </div>
                        </div>';

                return $html;
            })
            ->rawColumns(['action'])

            ->rawColumns([ 'is_paid', 'download', 'delete', 'total_payable', 'balance', 'paid_in', 'action'])

            ->toJson();

        

    }

    public function getAllOverpayments()
    {
        $query = Overpayment::where('amount', '>', 0)->with('tenant')->select('overpayments.*');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('edit', function ($query) {
                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    return '<a href=" ' . route('overpayment.edit', $query->id) . '  " class="btn btn-info btn-sm">Edit</a>';

                } else {
                    return '';

                }

            })
            ->addColumn('delete', function ($query) {
                if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2) {
                    return '
                        <form action=" ' . route('overpayment.delete', $query->id) . '"  class="delete-overpayment" method="post">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input class="btn btn-danger btn-sm" type="submit" value="Delete" />
                        </form>
                    ';
                } else {
                    return '';
                }

            })
            ->editColumn('amount', function ($query) {
                return 'Ksh ' . number_format($query->amount);
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at->diffForHumans();
            })
            ->rawColumns(['edit', 'delete'])
            ->tojson();
    }

    public function getApartmentHouses($id)
    {
        $query = House::where('apartment_id', $id)->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('rent', function ($query) {
                return 'Ksh ' . $query->rent->amount;
            })
            ->toJson();
    }

    public function apartmentHouses(Request $request)
    {
        if ($request->ajax()) {
            $apartment_id = $request->id;

            $query = House::where('apartment_id', $apartment_id)->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('rent', function ($query) {
                    return 'Ksh ' . $query->rent->amount;
                })
                ->toJson();

        }
    }

    public function validateTenantExistence(Request $request)
    {
        if ($request->ajax()) {
            $tenant = Tenant::find($request->id);
          
             if ($tenant) {
                 return response()->json(['tenant_name' => $tenant->full_name,
                                      
                               
                     'exists' => true,
                 ]);
             } else {
                 return response()->json(['tenant_name' => 'NO EXISTING TENANT WITH THAT ID',
                    'exists' => false]);

            }
        }
    }
    public function populateTenantInvoice(Request $request)
    {
        $tenant_id = $request->house_tenant;
        
        
        if ($request->ajax()) {
           $house_tenant = HouseTenant::where('tenant_id', $tenant_id)->with('house', 'tenant','apartment','rent');
        //    $house_tenant = HouseTenant::find($request->id);

            if ($house_tenant) {
                return response()->json(['tenant_name' => $house_tenant->tenant->full_name,
                                         'house_no' => $house_tenant->house->house_no,
                                         'apartment_name' => $house_tenant->apartment->name,
                                         'rent' => $house_tenant->rent->amount,
                    'exists' => true,
                ]);
            } else {
                return response()->json(['tenant_name' => 'NO EXISTING TENANT WITH THAT ID',
                'house_no' => 'NO EXISTING HOUSE NUMBER WITH THAT ID',
                'apartment_name' => 'NO EXISTING PROPERTY WITH THAT ID',
                'rent' => 'NO EXISTING RENT WITH THAT ID',
                    'exists' => false]);

            }
        }
    }
    public function populatingExpenses(Request $request)
    {
        if ($request->ajax()) {
            $servicerequests = Servicerequests::find($request->id);

            if ($servicerequests) {
                return response()->json(['description', 'status', 'request_date' => $servicerequests->description, $servicerequests->status, $servicerequests->request_date,
                    'exists' => true,
                ]);
            } else {
                return response()->json(['description', 'status', 'request_date' => 'sorry no such request found in the system',
                    'exists' => false]);

            }
        }
    }
}
