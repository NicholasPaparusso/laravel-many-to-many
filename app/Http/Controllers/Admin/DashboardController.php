<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
//    public function index(){
//         $projects_counter = Project::where('user_id', Auth::id())->count();
//         return view('admin.home', compact('projects_counter'));
//    }

   public function index(){
    $projects_counter = Project::where('user_id', Auth::id())->count();
    return view('admin.home', compact('projects_counter'));
}
}
