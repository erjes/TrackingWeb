<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Status Pengiriman STT') }} #{{ $shipment->shipment_number }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-start">
                <x-auth-session-status class="py-4 px-4" :status="session('status')" />
            </div>

            <div class="p-6 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-300">
                <div class="px-1 pb-4 flex items-center justify-between">
                    <x-secondary-button  onclick="location.href='{{ route('admin.dashboard') }}'">
                        <x-back-logo/>
                    </x-secondary-button>
                    <x-primary-button  onclick="location.href='{{ route('shipment-event.create',$shipment->shipment_number) }}'">
                        <x-manage-logo/>
                        <span class="ml-2">Update Status Pengiriman</span>
                    </x-primary-button>
                </div>

                <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">
                    {{ __('Status Pengiriman:') }}
                </h3>
                <div class="relative">
                    @foreach ($events as $index => $event)
                        <div class="flex items-start mb-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-10 h-10 border-2 rounded-full {{ $index == 0 ? 'border-blue-500' : 'border-blue-500' }}">
                                    <span class="text-gray-500">{{ $index + 1 }}</span>
                                </div>
                            </div>
                            <div class="ml-4 w-full">
                                <h4 class="font-semibold text-gray-800 leading-tight">{{ $event->location }}</h4>
                                <div class="border border-gray-300 py-2 px-4 w-full">
                                    <p class="text-gray-600">{{ $event->event_time }}</p>
                                    <p class="text-gray-600">{{ $event->details }}</p>
                                </div>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <div class="border-l-2 border-gray-300 ml-5 h-6"></div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
