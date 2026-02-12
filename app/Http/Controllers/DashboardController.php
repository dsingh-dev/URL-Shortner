<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $modelQuery = ShortUrl::query();

        $modelQuery->where('user_id', $user->id);

        $shorturls = $modelQuery->orderBy("id", "desc")->paginate(5);
        $shorturls->appends(Request::all());

        return view('dashboard', compact('shorturls'));
    }
}
