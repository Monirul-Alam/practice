<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class PageController extends Controller
{
    //
    public function about () {
        return view('page.about'); 
    }

    public function contact () {
        return view('page.contact'); 
    }

    public function service () {
        // $services = ["Automation", "Chatbot", "Aritficial Intelligence"] ;
        // return view('page.service')
        // ->with('services', $services);
        $admins = Admin::all();
        return view('page.service')->with('admins',$admins); 
    }

    public function list() {
        $admins = Admin::all();
        return view('page.list')->with('admins',$admins); 
    }
    public function edit(Request $req) {
        // $id =$req->id;
        $admin = Admin::where('id','=',decrypt($req->id))->select('user_name','id')->get();
        return $admin;

    }
    public function editSubmit(Request $req) {
        // $id =$req->id;
        $admin = Admin::where('id','=',$req->id)->select('user_name','id')->first();
        $admin->user_name =$req->user_name;
        $admin->user_email =$req->user_email;
        $admin->save();
       
        return $admin;

    }
 
 

    public function teams () {
        return view('page.teams'); 
    }

    public function home () {
        return view('page.home'); 
    }
    public function register () {
        return view('page.register'); 
    }

    public function login () {
        return view('page.login'); 
    }

    public function registersubmit (Request $req) {
        // $req->validate(
        //     [
        //          'user_name'=>'required|min:5|max:20|alpha',
        //          'user_email'=>'required|email',
        //          'user_gender'=>'required',
        //          'user_password'=>'required|min:2',
        //          'user_com_password'=>'required|same:user_password'

        //     ]
        //     );

        $this->validate($req,
    
        [
            'user_name'=>'required|min:5|max:20|alpha| unique:admins',
            'user_email'=>'required|email|exists:admins,user_email',
            'user_gender'=>'required',
            'user_password'=>'required|min:2',
            'user_com_password'=>'required|same:user_password'

        ],
        [
            'user_name.required'=> 'Please Provide username'
        ]
                        
    
    
    
    
    );  
    
    
    // Admin came from Model
    $ad = new Admin(); 
    $ad->User_name = $req->user_name;
    $ad->User_email = $req->user_email;
    $ad->User_password = $req->user_password;
    //$ad->User_location = $req->user_location;
    $ad->save(); // runs query in database

          


        return "<h1>This is $req->user_name</h1>";
    }

    public function loginsubmit (Request $req) {
        $req->validate(
            [
                 'user_name1'=>'required|min:5|max:20|alpha',
                 'user_email1'=>'required|email',
                 
                 'user_password1'=>'required|min:2',
          

            ]
            );


        return "<h1>This is $req->user_name1</h1>";
    }
    public function contactsubmit (Request $req) {
        $req->validate(
            [
                 'contact_name'=>'required|min:5|max:20|alpha',
                 'contact_email'=>'required|email',
          

            ]
            );


        return "<h1>This is $req->user_name</h1>";
    }
}
