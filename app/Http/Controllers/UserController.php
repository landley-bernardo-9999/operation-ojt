<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
            if(auth()->user()->privilege === 'admin'){

                $s = $request->query('s');

                $users = DB::table('users')
                ->where('privilege','!=' ,'admin')
                ->where('name', 'like', "%$s%")
                ->orderBy('created_at','desc')
                ->get();

                return view('users', compact('users'));      
            }
            else{
                abort(404, "Forbidden Page.");
            }   
         }
        catch(\Exception $e)
        {
            abort(404, "Forbidden Page.");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
            if(auth()->user()->privilege === 'admin'){

                return view('create-user');
            }
            else{
                abort(404, "Forbidden Page.");
            }   
         }
        catch(\Exception $e)
        {
            abort(404, "Forbidden Page.");
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->privilege === 'admin'){

            request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'privilege' => $request->privilege,
                'password' =>  bcrypt($request->password),
            ]);
    
            return redirect('users/create')->with('success', 'User has been registered successfully!');
        }
        else{
            abort(404, "Forbidden Page.");
        }   
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        try
        {
            if(auth()->user()->user_id == $user_id || auth()->user()->privilege === 'admin'){

                $user = User::findOrFail($user_id);

                return view('show-account', compact('user'));
            }
            else{
                abort(404, "Forbidden Page.");
            }   
         }
        catch(\Exception $e)
        {
            abort(404, "Forbidden Page.");
        }

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
    public function destroy($user_id)
    {
        DB::table('users')->where('user_id', $user_id)->delete();

        return redirect('/users/')->with('success','User has been deleted!');
    }
}
