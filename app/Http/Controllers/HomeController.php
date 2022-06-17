<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Frame;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); 
        
        $userId = $user->id;
        $frames = Frame::with(['posts' => function($q) use ($userId) {
            $q->where('user_id', '=' , $userId);
        }])->get();


        return view('home', ['user' => $user, 'frames' => $frames]);
    }
}
