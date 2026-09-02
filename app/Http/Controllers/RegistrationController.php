<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        return redirect()
            ->route('home')
            ->with(
                'registration_link',
                'test'
            );
    }
}
