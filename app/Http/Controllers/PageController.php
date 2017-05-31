<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $data = [
        [
            'name' => "Massimiliano",
            'lastname' => "Salerno"
        ],
        [
            'name' => "James",
            'lastname' => "Bond"
        ],
        [
            'name' => "Harry",
            'lastname' => "Plotter"
        ]
    ];
    public function about(){
        return view('about');
    }
    
    public function blog(){
        return view('blog');
    }
    
     public function staff(){
        /*return view('staff', 
                [
                    'title' => 'Il nostro staff', 
                    'staff'=> $this->data
                ]
                );*/
         //return view('staff')->with('staff', $this->data)->with('title', 'Il nostro staff');
         //$this->data = [];
         return view('staffb')->withStaff($this->data)->withTitle('Il nostro staff');
    }
}
