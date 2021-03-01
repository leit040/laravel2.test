<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('pages/user/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('pages/user/edit',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ['required','min:10'],
            'email'=> ['required','min:5','unique:users,email','email:rfc,dns'],
            'password'=>['required','min:8',]
        ]);
        User::create($data);
        return new RedirectResponse('/user/index');
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
        $user =  User::find($id);
        return view('pages/user/edit',compact('user'));
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
        $data = $request->validate([
            'name'=> ['required','min:10'],
            'email'=> ['required','min:5','unique:users,email','email:rfc,dns'],
            'password'=>['required','min:8',]
        ]);
        $user =  User::find($id);
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=$data['password'];
        $user->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "user \"{$data['name']}\" successfully saved",

        ];
        return new RedirectResponse('/user/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::find($id);
        $name=$user->name;
        $user->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "user \"{$name}\" successfully deleted",

        ];

        return new RedirectResponse('/user/index');

    }
}
