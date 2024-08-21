<x-app-layout title="Pengaturan" subtitle="Admin">
    
    @if(session('success'))
    <x-message type="success" :message="session('success')" />
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="row ">
        <div class="col-12 col-md-4 mx-auto mt-5">
            <div class="mb-3">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="mb-3">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</x-app-layout>
