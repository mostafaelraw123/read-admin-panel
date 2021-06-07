<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Traits\Api\ApiUserTrait;
use App\Http\Traits\ForCashier\AccountCreating;
use App\Http\Traits\NewOrderNotification;
use App\Http\Traits\Upload_Files;
use App\Models\AdminNotification;
use App\Models\Package;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\UserPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use TelrGateway\TelrManager;

class ApiAuthController extends Controller
{
    //my traits
    use ApiUserTrait;
    use Upload_Files;
    use NewOrderNotification ;


    public function __construct()
    {
        $this->middleware(['auth:api'])->only(['logout']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * Client Register
     *
     */

    public function client_register(Request $request)
    {
        //validation
        $data = $this->validate($request,[
            'phone_code'=>'required|regex:/^\+\d{1,5}$/',
            'phone' => 'required|numeric',
            'name' =>'required',
            'logo' =>'nullable|image|mimes:jpeg,jpg,png,gif|max:10000',
            'software_type' =>'required|in:ios,android',
        ]);
        $type = 'phone';
        $phone_check =$this->check_if_email_or_phone_exist($type);
        if ($phone_check != 200)  return response()->json(['data'=>null,'message'=>"the {$type} is already taken",'status'=>$phone_check],200);
        //insert data
        $data['user_type']='client';
        $data['password']=bcrypt(123456);
        //upload logo
        if ($request->hasFile('logo')){
            $data['logo']=$this->uploadFiles('users',$request->file('logo'),null);
        }else{
            $data['logo']= $this->createImageFromTextManual('users' , $request->name , 256 , '#000', '#fff');
        }
        $user=User::create($data);
        $user->save();
        $user=$this->add_passport_token_to_user($user);
        //----------notifications send-----------------------------
        $title_notify = 'عميل جديد';
        $desc_notify = 'عميل جديد انضم الى التطبيق';
        $this->notify($title_notify,$desc_notify,route('users.index'),'newUser');
        AdminNotification::create([
            'ar_title' =>$title_notify ,
            'ar_desc' => $desc_notify,
            'from_user_id' => $user->id,
            'type' => 'newUser',
        ]);
        return response()->json(['data'=>$user,'message'=>"good insert",'status'=>$phone_check],200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * Moatmer Register
     *
     */
    public function moatmer_register(Request $request)
    {
        //validation
        $data = $this->validate($request,[
            'phone_code'=>'required|regex:/^\+\d{1,5}$/',
            'phone' => 'required|numeric',
            'name' =>'required',
            'birth_date' =>'required|date|date_format:Y-m-d|before_or_equal:today',
            'card_id'=>'required',
            'gender'=>'required|in:male,female',
            'logo' =>'nullable|image|mimes:jpeg,jpg,png,gif|max:10000',
            'software_type' =>'required|in:ios,android',
            'umrah_price' =>'nullable',
        ]);
        //umrah price Validation
        if ($request->umrah_price != null) {
            $this->validate($request,[
                'umrah_price'=>'required|regex:/^\d+(\.\d{0,1,2})?$/',
            ]);
        }else{
            $data['umrah_price']=0;
        }
        $type = 'phone';
        $phone_check =$this->check_if_email_or_phone_exist($type);
        if ($phone_check != 200)  return response()->json(['data'=>null,'message'=>"the {$type} is already taken",'status'=>$phone_check],200);
        //insert data
        $data['user_type']='moatmer';
        $data['password']=bcrypt(123456);
        //upload logo
        if ($request->hasFile('logo')){
            $data['logo']=$this->uploadFiles('users',$request->file('logo'),null);
        }else{
            $data['logo']= $this->createImageFromTextManual('users' , $request->name , 256 , '#000', '#fff');
        }
        $user=User::create($data);
        $user->save();
        $user=$this->add_passport_token_to_user($user);
        //----------notifications send-----------------------------
        $title_notify = 'مُعتمر جديد';
        $desc_notify = 'مُعتمر جديد انضم الى التطبيق';
        $this->notify($title_notify,$desc_notify,route('users.index'),'newUser');
        AdminNotification::create([
            'ar_title' =>$title_notify ,
            'ar_desc' => $desc_notify,
            'from_user_id' => $user->id,
            'type' => 'newUser',
        ]);
        return response()->json(['data'=>$user,'message'=>"good insert",'status'=>$phone_check],200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * Login Function For client & moatmer
     *
     */
    public function login(Request $request)
    {
        $credentials= $this->validate($request,[
            'phone_code'=>'required|regex:/^\+\d{1,5}$/',
            'phone' => 'required|numeric',
        ]);
        $credentials['password']=123456;
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $return_data=$this->checkIfUserCanLogin($user);
            if ($return_data == 406){
                return response()->json(['data'=>null,'message'=>"this user had blocked",'status'=>406],200);

            }
            $user=$this->add_passport_token_to_user($user);
            return response()->json(['data'=>$user,'message'=>"good login",'status'=>200],200);
        }
        return response()->json(['data'=>null,'message'=>"this phone not registered",'status'=>404],200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * logout
     *
     *
     */
    public function logout(Request $request)
    {
        //get user and change its login status
        $user=$request->user();
        $user->logout_time=time();
        $user->is_login='not_connected';
        $user->save();
        //remove user token
        $request->user()->token()->revoke();
        return response()->json(['data'=>null,'message'=>"good logout",'status'=>200],200);

    }//end function

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * get User BY phone
     */
    public function getUserByPhone(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();
        if (!$user){
            return response()->json(['data'=>$user,'message'=>"user not exists",'status'=>404],200);

        }
        return response()->json(['data'=>$user,'message'=>"good",'status'=>200],200);
    }


    /*===============================================================*/
    /*===============================================================*/
    /*=======================    Helper    ==========================*/
    /*===============================================================*/
    /*===============================================================*/

    public function check_if_email_or_phone_exist($type)
    {
        $input[$type] = \request()->$type;
        $rules = array("{$type}" => "unique:users,{$type}");
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
           if ($type == 'email'){
               return 403;
           }else
               return 402;
        }
        return 200;
    }



}//end class
