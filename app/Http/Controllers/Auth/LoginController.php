<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'Username' => 'required',
            'password' => 'required',
        ]);

        // Login ICIT Account
        // ----------------------------------------------------------------------------------------------------------------
        
        $access_token = 'S670ZYehFLgE9q_hm_lkOdN2ZPW8BBwO'; // <----- API - Access Token Here
        $scopes 	= 'personel,student,templecturer'; 	// <----- Scopes for search account type
        $username 	= $input['Username']; // <----- Username for authen
        $password 	= $input['password']; 	// <----- Password for authen
        $api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-authen'; // <----- API URL
        
        $ch = curl_init();// Initiate connection
        curl_setopt($ch, CURLOPT_URL, $api_url); // set url
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10s timeout time for cURL connection
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Allow https verification if true
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Verify the certificate's name against host 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_POST, true);// Set post method
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // automatically follow Location: headers (ie redirects)
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('scopes' => $scopes, 'username' => $username, 'password' => $password));

        // ----------------------------------------------------------------------------------------------------------------

        if(($response = curl_exec($ch)) === false){
            // echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
            return redirect()->route('login')
                ->with('Error','ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง.');
        }else{        
            $json_data = json_decode($response, true);
            if(!isset($json_data['api_status'])){
                // echo 'API Error ' . print_r($response, true);
                return redirect()->route('login')
                ->with('Error','เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ.');
            }elseif($json_data['api_status'] == 'success'){
                try {
                    if(User::where('username', $json_data['userInfo']['username'])->count()!=1){
                        DB::beginTransaction();
                        User::create([
                            'name' => $json_data['userInfo']['firstname_en'].' '.$json_data['userInfo']['lastname_en'],
                            'username' => $json_data['userInfo']['username'],
                            'email' => $json_data['userInfo']['username'].'@email.kmutnb.ac.th',
                            'password' => Hash::make('77749000'),
                        ]);
                        DB::commit();
                    }
                    if(auth()->attempt(array('username' => $input['Username'], 'password' => '77749000')))
                    {
                        return redirect()->route('home');
                    }
                }catch (Exception $e) {
                    DB::rollback();
                    return redirect()->route('login')->with('Error','เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ.');
                }
            }elseif($json_data['api_status'] == 'fail'){
                // echo "API Error: " . $json_data['api_status_code'] . ' - ' . $json_data['api_message'];
                return redirect()->route('login')->with('Error','ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง.');
            }else{
                // echo "Internal Error";
                return redirect()->route('login')->with('Error','เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ.');
            }
        }
        curl_close($ch);

        // ----------------------------------------------------------------------------------------------------------------          
    }

}
