<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\RegisterToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profile_id' => 'required|integer',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      Log::debug('crear Usuario '.$data['token'].'...');
      $token = RegisterToken::where(['token'=>$data['token']])->firstOrFail();
      if($token->status == 1){
        $token->status = 2;
        $token->save();
        Log::debug('Token Taken '.$token->token.'...');
        
        if($token->residente != null){
          return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_id' => $data['profile_id'],
            'residente_id' => $token->residente->id,
          ]);
        }
        else{
          return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_id' => $data['profile_id'],
            'residente_id' => null,
          ]);
        }
      }

    }

    protected function showRegistrationForm()
    {
        $profiles = Profile::all();
        return view('auth.register')->with(['profiles'=>$profiles]);
    }

    public function registro($token){
      $token = RegisterToken::where(['token'=>$token,'status'=>1])->firstOrFail();
      $usuario = $token->residente != null ? $token->residente :$token->staff;
      
      return view('auth.register')->with(['token'=>$token,'usuario'=>$usuario]);
    }
}
