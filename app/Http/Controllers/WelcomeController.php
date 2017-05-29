<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome($name = "", $lastname = "", $age = 0, Request $req){
        $language = $req->input('lang');
        return "<h1>Cosa dice $name $lastname? Che ha $age anni</h1> <p>Your language is $language</p>";
    }
}
