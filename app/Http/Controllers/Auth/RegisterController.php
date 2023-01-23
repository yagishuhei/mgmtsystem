<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//登録内容変更、リセットパスワードリンク送付
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
//登録後管理者のままで元の画面にリダイレクト
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $id = Auth::user()->id;
        Log::info($id);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $password = Str::random(8);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'general',
            'password' => Hash::make($password),
        ]);
        $credentials['email'] = $data['email'];
        Password::sendResetLink($credentials);
        return $user;
    }
    //registerメソッドをオーバーライド
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered(($user = $this->create($request->all()))));
        return $this->registered($request, $user) ?: redirect('/register');
    }
}
