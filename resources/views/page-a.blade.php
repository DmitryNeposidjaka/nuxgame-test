<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>I'm Feeling Lucky</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 px-4 py-12">

<main class="mx-auto w-full max-w-2xl">

    <div class="rounded-2xl bg-white p-8 shadow-lg">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">
                I'm Feeling Lucky
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Welcome, {{ $link->user->username }}
            </p>

            <p class="mt-1 text-xs text-gray-400">
                Link expires {{ $link->expires_at->diffForHumans() }}
            </p>
        </div>


        {{-- Status --}}
        @if (session('status'))
            <div
                class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800"
            >
                {{ session('status') }}
            </div>
        @endif


        {{-- Current link --}}
        <div class="mb-8">
            <p class="mb-2 text-sm font-medium text-gray-700">
                Your current link
            </p>

            <div
                class="rounded-lg border border-gray-200 bg-gray-50 p-3 text-sm text-gray-600 break-all"
            >
                {{ route('page-a.show', ['token' => $token]) }}
            </div>
        </div>


        {{-- Lucky result --}}
        @if (session('lucky_result'))

            @php
                $result = session('lucky_result');
            @endphp

            <div
                class="mb-8 rounded-xl border p-6
                    {{ $result['is_win']
                        ? 'border-green-200 bg-green-50'
                        : 'border-red-200 bg-red-50'
                    }}"
            >

                <p class="text-sm text-gray-500">
                    Random number
                </p>

                <p class="mt-1 text-4xl font-bold text-gray-900">
                    {{ $result['number'] }}
                </p>

                <div class="mt-5 flex items-center justify-between">

                    <div>
                        <p class="text-xs text-gray-500">
                            Result
                        </p>

                        <p
                            class="text-lg font-semibold
                                {{ $result['is_win']
                                    ? 'text-green-700'
                                    : 'text-red-700'
                                }}"
                        >
                            {{ $result['is_win'] ? 'Win' : 'Lose' }}
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-gray-500">
                            Win amount
                        </p>

                        <p class="text-lg font-semibold text-gray-900">
                            {{ $result['win_amount'] }}
                        </p>
                    </div>

                </div>
            </div>

        @endif


        {{-- Actions --}}
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

            {{-- Play --}}
            <form
                method="POST"
                action="{{ route('page-a.play', ['token' => $token]) }}"
            >
                @csrf

                <button
                    type="submit"
                    class="
                            w-full
                            rounded-lg
                            bg-gray-900
                            px-5
                            py-3
                            font-medium
                            text-white
                            transition
                            hover:bg-gray-800
                        "
                >
                    I'm Feeling Lucky
                </button>
            </form>


            {{-- History --}}
            <a
                href="{{ route('page-a.show', [
                        'token' => $token,
                        'history' => 1
                    ]) }}"
                class="
                        flex
                        items-center
                        justify-center
                        rounded-lg
                        border
                        border-gray-300
                        px-5
                        py-3
                        font-medium
                        text-gray-800
                        transition
                        hover:bg-gray-50
                    "
            >
                History
            </a>


            {{-- Regenerate --}}
            <form
                method="POST"
                action="{{ route('page-a.regenerate', ['token' => $token]) }}"
            >
                @csrf

                <button
                    type="submit"
                    class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-5
                            py-3
                            font-medium
                            text-gray-800
                            transition
                            hover:bg-gray-50
                        "
                >
                    Regenerate Link
                </button>
            </form>


            {{-- Deactivate --}}
            <form
                method="POST"
                action="{{ route('page-a.deactivate', ['token' => $token]) }}"
            >
                @csrf

                <button
                    type="submit"
                    class="
                            w-full
                            rounded-lg
                            border
                            border-red-200
                            px-5
                            py-3
                            font-medium
                            text-red-600
                            transition
                            hover:bg-red-50
                        "
                >
                    Deactivate Link
                </button>
            </form>

        </div>


        {{-- History --}}
        @if (isset($history))

            <div class="mt-8">
                <h2 class="mb-4 text-xl font-semibold">
                    Last 3 results
                </h2>

                @forelse ($history as $item)

                    <div class="mb-3 rounded-lg border border-gray-200 p-4">

                        <div>
                            Number:
                            <strong>{{ $item->number }}</strong>
                        </div>

                        <div>
                            Result:

                            <strong>
                                {{ $item->is_win ? 'Win' : 'Lose' }}
                            </strong>
                        </div>

                        <div>
                            Win amount:
                            <strong>{{ $item->win_amount }}</strong>
                        </div>

                    </div>

                @empty

                    <p class="text-gray-500">
                        No results yet.
                    </p>

                @endforelse

            </div>


        @endif

    </div>

</main>

</body>
</html>
