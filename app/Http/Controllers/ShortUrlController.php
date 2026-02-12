<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    
    public function create() {
        return view('shorturls.create');
    }

    public function store(StoreShortUrlRequest $request) {
        $validated = $request->validated();

        $validated['short_code'] = Str::random(8);

        ShortUrl::create($validated);

        return redirect()->route('dashboard');
    }

    public function findShortCode(string $short_code) {
        $url = ShortUrl::where('short_code', $short_code)->first();

        if(!$url) {
            return 'URL not found';
        }

        $url->total_hits++;
        $url->save();

        return redirect($url->long_url);
    }
}
