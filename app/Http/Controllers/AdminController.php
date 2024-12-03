<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function applicationForms()
    {
        return view('admin.application-forms');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
