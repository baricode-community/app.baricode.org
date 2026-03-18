<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    public function redirect(string $slug)
    {
        $shortLink = ShortLink::where('slug', $slug)->first();

        if (! $shortLink || ! $shortLink->isAccessible()) {
            abort(404);
        }

        $shortLink->incrementClicks();

        return view('pages.link.redirect', [
            'shortLink' => $shortLink,
        ]);
    }
}
