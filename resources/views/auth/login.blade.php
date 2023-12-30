<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">

            <div class="text-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Welcome Back!</h2>
            </div>

            <x-validation-errors class="mb-4 text-red-500" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email"
                        class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password"
                        class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-between">

                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" class="rounded" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                </div>

                <div>
                    <x-button
                        class="w-full bg-indigo-600 text-white rounded-md py-2 hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log in') }}
                    </x-button>
                </div>

            </form>

        </div>
    </div>
</x-guest-layout>
