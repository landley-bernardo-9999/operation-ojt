<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

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
                ->orWhere('email', 'like', "%$s%")
                ->orWhere('name', 'like', "%$s%")
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
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
