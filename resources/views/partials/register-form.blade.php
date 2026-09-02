<form
    method="POST"
    action="{{ route('registration.store') }}"
    class="space-y-5"
>
    @csrf

    <div>
        <label
            for="username"
            class="block text-sm font-medium text-gray-700 mb-1"
        >
            Username
        </label>

        <input
            id="username"
            type="text"
            name="username"
            value="{{ old('username') }}"
            placeholder="Enter username"
            required

            class="
                w-full
                rounded-lg
                border
                border-gray-300
                px-4
                py-2.5
                text-gray-900
                outline-none
                transition
                focus:border-gray-900
                focus:ring-2
                focus:ring-gray-900/10
            "
        >

        @error('username')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div>
        <label
            for="phone"
            class="block text-sm font-medium text-gray-700 mb-1"
        >
            Phone number
        </label>

        <input
            id="phone"
            type="tel"
            name="phone"
            value="{{ old('phone') }}"
            placeholder="+380..."
            required

            class="
                w-full
                rounded-lg
                border
                border-gray-300
                px-4
                py-2.5
                text-gray-900
                outline-none
                transition
                focus:border-gray-900
                focus:ring-2
                focus:ring-gray-900/10
            "
        >

        @error('phone')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    <button
        type="submit"
        class="
            w-full
            rounded-lg
            bg-gray-900
            px-4
            py-2.5
            font-medium
            text-white
            transition
            hover:bg-gray-800
            focus:outline-none
            focus:ring-2
            focus:ring-gray-900
            focus:ring-offset-2
        "
    >
        Register
    </button>

</form>
