<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index(){
        $teachers = User::role('teacher')->get();

        return view('welcome', compact('teachers'));
    }


    public function detail($id){
        $teacher=User::findOrFail($id);

        return view('details',compact('teacher'));
    }

}
