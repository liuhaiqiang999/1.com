<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionsController extends Controller
{
    //
    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials,$request->has('remember'))){
            Session::flash('success','欢迎回来');
            return redirect()->intended(route('users.show',Auth::user()->id));
        }else{
            Session::flash('danger','登录失败,请检查账号和密码是否正确');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(){
        Auth::logout();
        Session::flash('success','退出成功');
        return redirect()->route('login');
    }
}
