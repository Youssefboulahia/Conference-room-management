<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessageMail;
use View;
use Illuminate\Support\Facades\Session;


class MainController extends Controller
{
    public function home(){
        return view('adt.home');
    }
    public function service(){
        return view('adt.service');
    }
    public function about(){
        return view('adt.about');
    }
    public function event(){
        return view('adt.event');
    }
    public function contact(){
        return view('adt.contact');
    }
    public function training(){
        return view('adt.training');
    }
    public function innovation(){
        return view('adt.innovation');
    }

    public function contact_send(Request $request){
        
        $messageMail = new MessageMail;
        
        $messageMail->name = $request->input('name');
        $messageMail->adresse = $request->input('adresse');
        $messageMail->subject = $request->input('subject');
        $messageMail->message = $request->input('message');

        $messageMail->save();


        return redirect()->back()->with('flash_message','Thank you! your message has been sent successfully.');
    }

    public function emailLogin()
    {

        $emails = MessageMail::all();
        $view = View::make('adt.email');
        $view->emails=$emails;
        return $view;
    }

    public function emailCheck(Request $request){

        if(($request->input('adresse')!='adtmena') || ($request->input('pass')!='12345' ))
        {
            return redirect()->back()->with('flash_message','Wrong credentials!');
        }
        else{
            return redirect()->route('email.view')->with('check',true);
        }
    }

    public function emailView()
    {
        if(Session::has('check')){
            $emails = MessageMail::all()->reverse();
            $view = View::make('adt.emailView');
            $view->emails=$emails;
            return $view;
        }
        else{
            return redirect('email');
        }
        
    }
}
