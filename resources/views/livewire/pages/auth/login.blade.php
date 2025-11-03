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

    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-user-lock text-white text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Welcome back</h1>
        <p class="text-gray-600">Log in to your account to continue</p>
    </div>

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input wire:model="form.email" id="email"
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       type="email" name="email" required autofocus autocomplete="username"
                       placeholder="Enter your email">
            </div>
            <div class="text-red-600 text-sm mt-2">
                {{ $errors->first('form.email') }}
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input wire:model="form.password" id="password"
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       type="password" name="password" required autocomplete="current-password"
                       placeholder="Enter your password">
            </div>
            <div class="text-red-600 text-sm mt-2">
                {{ $errors->first('form.password') }}
            </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <div class="relative">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                           class="sr-only peer">
                    <div class="w-10 h-5 bg-gray-200 peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-5 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                </div>
                <span class="ms-3 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 transition-colors font-medium" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div>
            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 rounded-lg border border-transparent font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-sign-in-alt"></i>
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Sign Up Link -->
        <div class="text-center pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors" wire:navigate>
                    Sign up now
                </a>
            </p>
        </div>
    </form>

<style>
    .border-gray-300 {
        border-color: #E5E7EB;
    }
    .shadow-sm {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    .focus\:ring-blue-500:focus {
        --tw-ring-color: rgba(59, 130, 246, 0.5);
        box-shadow: 0 0 0 3px var(--tw-ring-color);
    }
    .bg-blue-50 {
        background-color: #EFF6FF;
    }
    input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>

<script>
document.addEventListener('livewire:init', () => {
    // Add smooth interactions
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-20');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20');
        });
    });
});
</script>
</div>


