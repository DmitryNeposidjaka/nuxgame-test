<?php

namespace App\Http\Controllers;

use App\Contracts\RegistrationLinkGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationLinkController extends Controller
{
    public function __construct(
        private readonly RegistrationLinkGenerator $linkGenerator,
    ) {
    }

    public function regenerate(Request $request): RedirectResponse
    {
        $currentLink = $request->attributes->get('registrationLink');

        $newToken = DB::transaction(function () use ($currentLink) {
            $currentLink->update([
                'deactivated_at' => now(),
            ]);

            $token = $this->linkGenerator->generate();

            $currentLink->user
                ->registrationLinks()
                ->create([
                    'token_hash' => hash('sha256', $token),
                    'expires_at' => now()->addDays(7),
                ]);

            return $token;
        });

        return redirect()
            ->route('page-a.show', [
                'token' => $newToken,
            ])
            ->with('status', 'Link regenerated successfully.');
    }

    public function deactivate(Request $request): RedirectResponse
    {
        $link = $request->attributes->get('registrationLink');

        $link->update([
            'deactivated_at' => now(),
        ]);

        return redirect()
            ->route('home')
            ->with('status', 'Link deactivated successfully.');
    }
}
