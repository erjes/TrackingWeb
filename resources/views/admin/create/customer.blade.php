<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Customer Baru') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <form action="{{ route('customer.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama Customer')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="phone" :value="__('Telp')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required/>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="col-span-2 mb-4">
                    <x-input-label for="address" :value="__('Alamat')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required/>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center mt-4 justify-between">
                <x-secondary-button type="button" onclick="location.href='{{ route('admin.dashboard') }}'">
                    <x-back-logo/>
                </x-secondary-button>
                <x-primary-button type="submit">
                    <x-save-logo/>
                </x-primary-button>
            </div>
        </form>
        <x-auth-session-status class="mb-4 mt-4" :status="session('status')" />
    </div>
</x-app-layout>
