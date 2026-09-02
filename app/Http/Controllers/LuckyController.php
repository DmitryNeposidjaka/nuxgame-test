<?php

namespace App\Http\Controllers;

use App\Services\LuckyGameService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LuckyController extends Controller
{
    public function __construct(
        private readonly LuckyGameService $game,
    ) {
    }

    public function store(Request $request): RedirectResponse
    {
        $link = $request->attributes->get('registrationLink');

        $result = $this->game->play();

        $savedResult = $link->user
            ->luckyResults()
            ->create($result);

        return redirect()
            ->route('page-a.show', [
                'token' => $request->route('token'),
            ])
            ->with('lucky_result', [
                'number' => $savedResult->number,
                'is_win' => $savedResult->is_win,
                'win_amount' => $savedResult->win_amount,
            ]);
    }
}
