<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerification;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function register_index()
    {
        return view('layouts.backend.auth.register');
    }

    public function login_index()
    {
        return view('layouts.backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            // 'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if (Auth::attempt([
            'name'=>$request->email,
            'password'=>$request->password,
            'verified'=> 1,
            'role'=> 'super_admin'
        ])) {

            toast('Signed in successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->back();
            
        }elseif (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'verified'=> 1,
            'role'=> 'admin'
        ])) {

            toast('Signed in successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->back();
        }elseif (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'verified'=> 1,
            'role'=> 'vendor'
        ])) {

            toast('Signed in successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->back();
        }elseif (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=> 'user'
        ])) {

            toast('Signed in successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->back();
        }
        else{
            Alert::warning('Opps!','Access Denied.');
            return redirect()->back();
        };


    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'email'  =>  'required|unique:users',
            'phn'  =>  'required|unique:users',
            'password'  =>  'required|min:8',
            'address'  =>  'required'

        ]);
        
    
        
        if ($validator->fails()) {
            if($validator->messages()->all()[0] =="The name has already been taken."){
                Alert::warning('Opps!','The name has already been taken.');
            }elseif($validator->messages()->all()[0] =="The email has already been taken."){
                Alert::warning('Opps!','The email has already been taken.');
            }elseif($validator->messages()->all()[0] =="The password must be at least 8 characters."){
                Alert::warning('Opps!',"The password must be at least 8 characters.");
            }else{
                 Alert::warning('Opps!','Given Cridentials already taken.');
            }
            
            return redirect()->back();
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phn' => $request->phn,
                'password' => Hash::make($request->password),
                'verification_token'=> Str::random(32),
                'verified'=>1
            ]);
    
            
            // Mail::send('layouts.Mail.userVerification', ['user' => $user],function($msg) use($user){
            //     $msg->from('support@anar.com.bd','Anar.com.bd');
            //     $msg->to($user->email);
            //     $msg->subject('Please verify your account.');
            // });
    
            Alert::success('Email Vefification Required!', 'Check your email for verification code.');
    
            return redirect()->route('home');
        }
    }

    public function user_verify($token)
    {
        User::where('verification_token',$token)->update([
            'verification_token'=>'',
            'verified'=>1
            ]);

        toast('Account Verified Successfully.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->route('home');
    }

    public function update(Request $request)
    {
        if($request->password !=null){
            $data = User::find($request->userId)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phn'=>$request->phn,
                'address'=>$request->address,
                'password' => Hash::make($request->password)
            ]);
            
            toast('Account Updated Successfully.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->back();
        }else{
            $data = User::find($request->userId)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phn'=>$request->phn,
                'address'=>$request->address
            ]);
            
            return redirect()->back()->with('success','Account Updated Successfully.');
        }
        
    }

    public function destroy(Request $request)
    {

        $data = User::find($request->id)->delete();
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->flush();
            toast('Logout successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return redirect()->route('home');
        }

    }


    //login with google account
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        try {
                $user = Socialite::driver('google')->user();
                $checkUser = User::where('google_id', $user->id)->first();
                if($checkUser){
                    Auth::login($checkUser);
                    toast('Login successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return redirect()->route('home');
                }else{
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => encrypt('123456dummy'),
                        'verified'=>1,
                    ]);
                    Auth::login($newUser);
                    toast('Login successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return redirect()->route('home');
                }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
   }


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $checkUser = User::where('facebook_id', $user->id)->first();

        if($checkUser){
            Auth::login($checkUser);
            toast('Login successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect('https://anar.com.bd');
        }else{

            if($user->email == null){
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => 'example@gmail.com',
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                    'verified'=>1,
                ]);
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                    'verified'=>1,
                ]);
            }

            Auth::login($newUser);
            toast('Login successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->route('home');
        }
    }
}
