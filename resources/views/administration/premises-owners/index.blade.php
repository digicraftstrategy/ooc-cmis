<x-app-layout>
    <x-slot name='header'>
        <div class="px-4 py-2 bg-blue-100">
        <h2 class="text-xl font-semibold">{{ __('Premises Owners Management') }}</h2>
        </div>
    </x-slot>
    <livewire:admin.publication-premises.premises-owner.premises-owners-table lazy />
</x-app-layout>
