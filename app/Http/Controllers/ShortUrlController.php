<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    
    public function create(): View {
        return view('shorturls.create');
    }

    public function store(StoreShortUrlRequest $request): RedirectResponse {
        $validated = $request->validated();

        $validated['short_code'] = Str::random(8);

        ShortUrl::create($validated);

        return redirect()->route('dashboard');
    }

    public function findShortCode(string $short_code): RedirectResponse {
        $url = ShortUrl::whereShortCode($short_code)->firstOrFail();

        $url->increment('total_hits');

        return redirect()->away($url->long_url);
    }
}
