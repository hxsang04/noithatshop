<?php

namespace App\Http\Controllers\FrontEnd;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.signin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hidden_action == 'In')
        {
            $arr = array('email'=>$request->email, 'password'=>$request->password);

            if(Auth::attempt($arr)){
                if (Auth::user()->level == 1) {

                    return redirect()->route('home.index');
                }else{
                    return redirect()->route('dashboard.index');
                }
            }else{
                return redirect()->back()->withInput($request->only('email'))->with('message', 'Email Or Password Invalid!');
            }
        }
        else
        {
            $this->validate($request,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'confirm_password'=>'required|min:6|max:20|same:password',
            ]);

            $users = new User();
            $users->name = $request->name;
            $users->email  = $request->email;
            $users->password = Hash::make($request->password);
            $users->level = 1;
            $users->save();

            Auth::login($users,true);
            if (Auth::user()) {
                return redirect()->route('home.index')->with('message', ' Hi, '.Auth::user()->name.' ');
            }else{
                return redirect()->withInput()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
