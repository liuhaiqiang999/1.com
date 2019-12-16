<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show','create','store']
        ]);
    }

    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)

        ]);
        Auth::login($user);
        Session::flash('success','注册成功');
        return redirect()->route('users.show',$user->id);
    }

    public function edit(User $user){
        return view('users.edit',compact('user'));
    }

    public function update(Request $request,User $user){
        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name']=$request->name;
        if ($request->password){
            $data['password'] = $request->password;
        }

        $user->update($data);
        Session::flash('success','更新成功');
        return redirect()->route('users.show',$user);
    }
}
