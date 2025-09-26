<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    {{--<div class="mb-4 p-4 bg-blue-50 text-blue-700 rounded-md" :class="{ 'hidden': !session('status') }">
        {{ session('status') }}
    </div>--}}
    <div class="text-center mb-10">
        <h1 class="text-2xl md:text-3xl font-semibold mb-3 flex items-center justify-center">
            {{--<span class="w-14 h-14 rounded-full bg-gradient-to-br from-dark-blue-400 to-dark-blue-500 flex items-center justify-center text-2xl md:text-3xl shadow-lg shadow-blue-500/50 mr-4">
                <i class="fas fa-shield-alt"></i>
            </span>--}}
            Login
        </h1>
    </div>
    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input wire:model="form.email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" type="email" name="email" required autofocus autocomplete="username" />
            <div class="text-red-600 text-sm mt-2">
                {{ $errors->first('form.email') }}
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input wire:model="form.password" id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" type="password" name="password" required autocomplete="current-password" />
            <div class="text-red-600 text-sm mt-2">
                {{ $errors->first('form.password') }}
            </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Sign Up Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors" wire:navigate>
                    Sign up now
                </a>
            </p>
        </div>
    </form>
<style>
    .border-gray-300 {
        border-color: #D1D5DB;
    }
    .shadow-sm {
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .focus\:ring-blue-500:focus {
        --tw-ring-color: rgba(59, 130, 246, 0.5);
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
    }
    .bg-blue-50 {
        background-color: #EFF6FF;
    }
</style>

<script>
document.addEventListener('livewire:init', () => {
    // Add any client-side interactions if needed
});
</script>
</div>


