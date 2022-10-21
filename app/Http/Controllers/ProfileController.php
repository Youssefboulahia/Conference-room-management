<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $user = Auth()->user();
        return view('profile.index',['user'=>$user]);
    }

     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  

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

        $user = Auth()->user();
        $user->name = $request->input('name');

        $checkMail = User::where('email',$request->input('mail'));
        if($checkMail->count()>0 && strlen($request->input('mail'))>0)
        {
            session()->flash('warning_mail', 'Adresse email existe');
            return redirect ('profile');
        }
        else if($checkMail->count()==0 && strlen($request->input('mail'))>0)
        {
            $user->email = $request->input('mail');
        }

        if(strlen($request->input('password'))>0 && $request->input('password')!==$request->input('confPassword'))
        {
            session()->flash('warning', 'Confirmer le mot de passe');
            return redirect ('profile');
        }
        else if(strlen($request->input('password'))>0)
        {
            $user->password = Hash::make($request->input('password'));
            
        }
        
        $user->save();

        if(auth()->user()->role==='secretary'){
            return redirect()->route('home');
        }else{
            return redirect()->route('reservation');
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
