<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $modelQuery = ShortUrl::query();
        $userQuery = User::query();

        $shorturls = $modelQuery->visibleTo($user)->latest()->paginate(5);
        $shorturls->appends(Request::all());

        $users = $userQuery->withCount('shortUrls')
                            ->where('company_id', $user->company_id)
                            ->whereKeyNot($user->id)->get();
        
        return view('dashboard', compact('shorturls', 'users'));
    }
}
