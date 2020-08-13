<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Response,Redirect;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function __construct() {
       // $this->middleware('auth');
    }


    public function index(){
        if(Auth::check()){
            return view('user.dashboard');
        }else{
            return view('user.login');
        }

    }
public function searchstaff($staffname){
$staffdata = DB::table("users")
    ->select("name","email","usertype")
    ->where("name","=",$staffname)
    ->get();
return response()->json($staffdata);
}

    public function create(){
        $staffnames = DB::table('users')->get();

        return response()->json($staffnames);
    }

    public function registration(){
        if(Auth::check()&& Auth::user()->usertype==="admin"){
            return view('user.registration');
        }else{
            return view('user.login');
        }

    }


    public function postLogin(Request $request){

    	$user_data = array(
    		'email'=>$request->get('email'),
    		'password'=>$request->get('password')
    	);

    	if(Auth::attempt($user_data)){
           $user_data = Auth::user();
            Session::put("userid",$user_data->name);
            
            $status= 1; $msg = "Welcome, ".ucfirst(Auth()->user()->name);
          // return response()->json(['response'=>1]);
    	}else{
    	 $status= 0; $msg = "Oops! Email or password is invalid!";
            
    	}
         return response()->json(['response'=>$status,'msg'=>$msg]);
    }

    public function logout(){
        Session::flush();
    	Auth::logout();
    	return redirect('login');
    }


    public function postRegistration(Request $request){

    	$data = $request->all(); //assign all parameters in the request to $data variable
        $accounts = User::where('email',$request->get('email'))
            ->get();
        if(sizeof($accounts)>0){
            $msg ="Email address already taken!";
            $status=0;
        }
        else{
            $check = $this->createUser($data); // call Create_user function create and pass the data variable
            //return Redirect::to("dashboard")->withSuccess("Login successful!");
            $msg ="User account created!";
            $status=1;
        }
        return response()->json(['status'=>$status,'msg'=>$msg]);
    }

    public function edit(Request $request){
        $password = $request->get('password');
        if(isset($password)){
              $password = Hash::make($request->get('password'));
        }
        $email = $request->get('email');
        $fullname = $request->get('fullname');
        $usertype = $request->get('usertype');
        $inputdata = ["name"=>$fullname,"usertype"=>$usertype,"password"=>$password];
        $userdata = array_filter($inputdata);
        $response = User::where('email',$email)
            ->update($userdata);
        if($response>0){
            $msg="Account details updated successfully";
        }else{$msg = "No changes were made!";}
        return response()->json(["msg"=>$msg,"status"=>$response]);
    }



    public function dashboard(){
        // return view('user/dashboard');
    if(Auth::check()){
    	return view('user/dashboard');
         }
    	return Redirect::to('login')->withSuccess("Opps! You aren't authorised!");
    }

    //Function to create new user in the db
    public function createUser(array $data){
    	return User::create([ //invoke User model and return created user
            'name'=>$data['fullname'],
            'usertype'=>$data['usertype'],
            'email'=>$data['email'],
            'password'=> Hash::make($data['password']),
            'status'=>'1',
            'remember_token' =>str_random(10),
        ]);
    }


}
