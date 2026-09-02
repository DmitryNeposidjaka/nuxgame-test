<?php

namespace App\Http\Controllers;

use App\Contracts\RegistrationLinkGenerator;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function __construct(
        private RegistrationLinkGenerator $linkGenerator,
    ) {
    }

    public function store(
        StoreRegistrationRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        $url = DB::transaction(function () use ($data) {
            $user = User::create([
                'username' => $data['username'],
                'phone' => $data['phone'],
            ]);

            $token = $this->linkGenerator->generate();

            $user->registrationLinks()->create([
                'token_hash' => hash('sha256', $token),
                'expires_at' => now()->addDays(7),
            ]);

            return route('page-a.show', [
                'token' => $token,
            ]);
        });

        return redirect()
            ->route('home')
            ->with('registration_link', $url);
    }
}
