<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     //ユーザ登録後のリダイレクト先がトップページに変更さ

    protected $redirectTo = '/'; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //ミドルウェアは Controller にアクセスする前に事前に確認される条件
    // guest とは、ログイン認証されていない閲覧者のことです。つまり「 logout アクション以外ではログイン認証されていないことが必要」
        $this->middleware('guest')->except('logout');
    }
}
