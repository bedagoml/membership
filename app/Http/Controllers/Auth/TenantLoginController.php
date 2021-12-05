<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\TenantRequest;
use Auth;
use App\Subscription;
use App\Tenant;
use App\Traits\FileManager;
use App\Traits\NotifyClient;
use App\Traits\UtilTrait;
use Hash;

class TenantLoginController extends Controller
{
    use NotifyClient;
    use UtilTrait;
    use FileManager;

    /*

    |--------------------------------------------------------------------------

    | Tenant Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

     */

    use AuthenticatesUsers;

    protected $guard = 'tenant';

    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = '/tenant-home';

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()
    {

        $this->middleware('guest:tenant')->except('logout');

    }
    public function showRegisterForm()
    {

        $subscription = Subscription::pluck('id', 'category');
        return view('auth.register', compact('subscription'));

    }
    public function store(TenantRequest $request)
    {
        $year = date("Y", strtotime($request->member_date));
        $subscription = Subscription::where('category', $request->membership)->first();
            $date = date("M-Y", strtotime($request->member_date));
            $month = date("M", strtotime($request->member_date));
           

        // $response = $this->generateUserAccountNumber();
        
        // dd($response);
        // $request->validate([
        //     'filenames' => 'nullable',
        //     'filenames.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,PNG,JPG,jpg',
        // ]);
        
        $hobby = implode(",",array_keys($request->except(['_method','_token', 'full_name','degree','gradyear','university','occupation','county','address','telephone','phone','id_number','email','membership','license','member_number','member_date','p' ])));

        $tenant = new Tenant;
        // $tenant->id = $request->id;
        $tenant->full_name = $request->full_name;
        $tenant->degree = $request->degree;
        $tenant->gradyear = $request->gradyear;
        $tenant->university = $request->university;
        $tenant->occupation = $request->occupation;
        $tenant->county = $request->county;
        $tenant->address = $request->address;
        $tenant->telephone = $request->telephone;
        $tenant->phone = $request->phone;
        $tenant->id_number = $request->id_number;
        $tenant->email = $request->email;
        $tenant->membership = $request->membership;
        $tenant->license = $request->license;
        $tenant->member_number = $request->member_number;
        $tenant->committees = $hobby;
        // dd($tenant->committees);
        $tenant->password = Hash::make($request->password);
        // $tenant->password = Hash::make($this->generateUserPassword());
        $tenant->test_password = $request->password;
        $tenant->subscription_date = $request->member_date;
        $tenant->status = 0;
       
      
      

        $this->createLog([
            'username' => $tenant->full_name,
            'operation' => ' New Member Registered ' . $tenant->full_name,
            'more_info' => 'New member registered under membership category:  ' . $tenant->category,
            'tenant_id' =>  '200',
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '1',
            'sms_id' => '0',
            'user_id' => '0',
        ]);
        $tenant->save();


        return redirect()->route('tenant.login')
            ->with('success', 'You have been registered successfully, Wait for our account approval.');
       
 
    
            
    }

    public function showLoginForm()
    {

        return view('auth.tenantLogin');

    }

    public function login(Request $request)
    { 
        $status = Tenant::select('*')->first();
        
        if ($status->status == 0){
         
        return back()->withErrors(['Your Account is not yet Approved']);

    }
    elseif ($status->suspend_status == 1){
         
        return back()->withInput($request->only('email'))
            ->withErrors(['Your Account is suspended']);

    }
    else{
        if (auth()->guard('tenant')->attempt(['email' => $request->email, 'password' => $request->password ])) {

            //dd(auth()->guard('tenant')->user());
            return redirect()->intended('/member');

        }

        //return back()->withErrors(['email' => 'Email or password are wrong.']);
        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'Email/Password is Wrong, Try Again!']);
         
    }
    }

    public function logout()
    {
        Auth::guard('tenant')->logout();
        return redirect()
            ->route('tenant.login');
    }

}
