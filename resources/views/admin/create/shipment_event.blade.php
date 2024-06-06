<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Status Pengiriman STT') }} #{{ $shipment->shipment_number }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <form action="{{ route('shipment-event.store', $shipment->shipment_number) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="hidden" name="shipment_number" value="{{$shipment->shipment_number}}">
                <div class="mb-4">
                    <x-input-label for="location" :value="__('Lokasi')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required autofocus/>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="event_time" :value="__('Tanggal dan Waktu')" />
                    <x-text-input id="event_time" class="block mt-1 w-full" type="datetime-local" name="event_time" :value="old('event_time')" required/>
                    <x-input-error :messages="$errors->get('event_time')" class="mt-2" />
                </div>

                <div class="mb-4 col-span-1 md:col-span-2">
                    <x-input-label for="details" :value="__('Keterangan')" />
                    <textarea id="details" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" name="details" required>{{ old('details') }}</textarea>
                    <x-input-error :messages="$errors->get('details')" class="mt-2" />
                </div>
            </div>

            <div class="pb-4 flex items-center justify-between">
                <x-secondary-button type="button" onclick="window.location.href='{{ route('shipment-event.index', $shipment->shipment_number) }}'">
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
