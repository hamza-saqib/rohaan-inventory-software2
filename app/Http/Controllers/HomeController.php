<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UnitMeasurement;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUsers = 0;
        $totalStudents = 0;
        $totalTeachers = 0;//Teacher::count('id');
        $totalClasses = 0;
        return view('home', compact('totalUsers', 'totalStudents', 'totalTeachers', 'totalClasses'));
    }
}
