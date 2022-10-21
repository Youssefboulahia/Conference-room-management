<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function home(){
        return view('team.index');
    }

    public function about(){
        return view('team.about-us');
    }

    public function courses(){
        return view('team.courses');
    }

    public function contact(){
        return view('team.contact');
    }
}
