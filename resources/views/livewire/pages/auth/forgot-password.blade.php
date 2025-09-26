<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-key text-white text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Reset your password</h1>
        <p class="text-gray-600">
            {{ __('Forgot your password? No problem. Just enter your email address and we\'ll send you a reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <form wire:submit="sendPasswordResetLink" class="space-y-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input wire:model="email" id="email"
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       type="email" name="email" required autofocus
                       placeholder="Enter your email address">
            </div>
            @error('email')
                <div class="text-red-600 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 rounded-lg border border-transparent font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled">
                <i class="fas fa-paper-plane"></i>
                <span wire:loading.remove>{{ __('Send Reset Link') }}</span>
                <span wire:loading>{{ __('Sending...') }}</span>
            </button>
        </div>

        <!-- Back to Login Link -->
        <div class="text-center pt-4">
            <a href="{{ route('login') }}"
               class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors font-medium"
               wire:navigate>
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Back to login') }}
            </a>
        </div>
    </form>

<style>
    .border-gray-300 {
        border-color: #E5E7EB;
    }
    input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }
    .bg-green-50 {
        background-color: #F0FDF4;
    }
    .border-green-200 {
        border-color: #BBF7D0;
    }
</style>

<script>
document.addEventListener('livewire:init', () => {
    // Add smooth interactions
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('focus', () => {
            emailInput.parentElement.classList.add('ring-2', 'ring-orange-500', 'ring-opacity-20');
        });
        emailInput.addEventListener('blur', () => {
            emailInput.parentElement.classList.remove('ring-2', 'ring-orange-500', 'ring-opacity-20');
        });
    }
});
</script>
</div>
