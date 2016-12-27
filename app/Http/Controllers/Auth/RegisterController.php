<?php

namespace VSocial\Http\Controllers\Auth;

use VSocial\User;
use Validator;
use VSocial\Http\Controllers\Controller;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'bd_day' => 'required|min:1|max:31|numeric',
            'bd_month' => 'required|min:1|max:31|numeric',
            'bd_year' => 'required|min:1900|max:2017|numeric',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $day = $data['bd_day'];
        $month = $data['bd_month'];
        $year = $data['bd_year'];
        $date = \DateTime::createFromFormat('j-n-Y', $day.'-'.$month.'-'.$year);
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'birth_date' => $date,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
