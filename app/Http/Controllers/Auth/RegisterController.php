<?php

namespace App\Http\Controllers\Auth;

use Flash;
use Auth;
use App\User;
use App\Mail\UserRegistrationMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/login';

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
            'first_name' => 'required|string|max:80',
            'last_name'  => 'required|string|max:80',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed|max:20',
            'phone'      => 'required|min:10|max:15',
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
        $email_confirmation = fn_generate_token(15);
        
        $objUser =  User::create([
            'first_name'         => $data['first_name'],
            'last_name'          => $data['last_name'],
            'email'              => $data['email'],
            'password'           => bcrypt($data['password']),
            'phone'              => $data['phone'],
            'profile_pic_id'     => $data['profile_pic_id'],
            'email_confirmation' => $email_confirmation,
            'role_id'            => '2',   
        ]);

        ## Send to User.
        Mail::to($objUser->email)->send(new UserRegistrationMail($objUser));
        
        Flash::success("successfully Register. Please confirm your email check your email.")->important();       
        return $objUser;
    }

    /**
    * Function used for the verify the user
    * @param string $slug
    * @return success  
    *
    */
    public function fn_verify_user($slug) {
        // dd($slug);
        if(empty($slug))
            return redirect('login');

        $objUser = User::where('email_confirmation', $slug)->first();
        if(empty($objUser)) {
            Flash::error("Your Account is already activated Please Login.")->important();
            return redirect('login');
        }

        Auth::loginUsingId($objUser->id);
        $objUser->email_confirmation = null;
        $objUser->status             = '1';
        $objUser->save();

        Flash::success("Your Account is successfully verified. Thank You!")->important();
        return redirect('profile');
    }
}
