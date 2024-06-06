<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <form action="{{ route('customer.update', $customer->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Customer')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$customer->name)" autofocus/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone',$customer->phone)" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="address" :value="__('Customer Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address',$customer->address)" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <x-secondary-button  onclick="location.href='{{ route('admin.dashboard') }}'">
                    <x-back-logo/>
                </x-secondary-button>
                <x-primary-button type="submit">
                    <x-save-logo/>
                </x-primary-button>
            </div>
            <div class="flex items-center justify-start">
                <x-auth-session-status class="py-4 px-4" :status="session('status')" />
            </div>
        </form>
    </div>
</x-app-layout>
