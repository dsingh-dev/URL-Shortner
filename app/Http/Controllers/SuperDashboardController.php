<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class SuperDashboardController extends Controller
{
    public function __construct() {

        Auth::shouldUse(SUPER);
    }

    public function index()
    {   
        $modelQuery = Company::query();
        $modelQuery->withCount('users', 'shortUrls');
        
        $companies = $modelQuery->orderBy("id", "desc")->paginate(5);
        $companies->appends(Request::all());

        $shorturls_query = ShortUrl::query();
        $shorturls_query->where('company_id', Auth::guard(SUPER)->user()?->id);
        $shorturls = $shorturls_query->orderBy("id", "desc")->paginate(5);

        return view(SUPER . '.dashboard', [
            'companies' => $companies,
            'shorturls'=> $shorturls
        ]);
    }
}
