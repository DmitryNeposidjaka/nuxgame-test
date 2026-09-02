<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageAController extends Controller
{
    public function show(Request $request): View
    {
        $link = $request->attributes->get('registrationLink');

        $history = null;

        if ($request->boolean('history')) {
            $history = $link->user
                ->luckyResults()
                ->latest()
                ->limit(3)
                ->get();
        }

        return view('page-a', [
            'link' => $link,
            'token' => $request->route('token'),
            'history' => $history,
        ]);
    }
}
