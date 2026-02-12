<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperDashboardController extends Controller
{
    public function index()
    {   
        $companies = Company::all();
        
        return view(SUPER . '.dashboard', [
            'companies' => $companies
        ]);
    }
}
