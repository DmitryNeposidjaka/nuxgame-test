<?php

namespace App\Http\Middleware;

use App\Models\RegistrationLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationLinkIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');

        $link = RegistrationLink::with('user')
            ->where('token_hash', hash('sha256', $token))
            ->first();

        if (!$link) {
            abort(404, 'Link not found.');
        }

        if ($link->expires_at->isPast()) {
            abort(410, 'Link expired.');
        }

        if ($link->deactivated_at !== null) {
            abort(410, 'Link deactivated.');
        }

        $request->attributes->set(
            'registrationLink',
            $link
        );

        return $next($request);
    }
}
