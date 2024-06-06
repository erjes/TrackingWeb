<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengiriman') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6">
                <div class="max-w-l mx-auto bg-white shadow-lg rounded-lg overflow-hidden border border-gray-300 mb-4">
                    <form action="{{ route('shipment.update', $shipment->shipment_number) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="px-6 py-4">
                            <div class="flex items-center mb-4 justify-between">
                                <div class="flex items-center">
                                  <label for="shipment_number" class="block font-bold text-gray-800 pr-2">No:</label>
                                  <x-text-input id="shipment_number" type="text" name="shipment_number" value="{{ $shipment->shipment_number }}" class="block mt-1 w-36 text-center"/>
                                </div>
                                <div class="flex items-center">
                                  <label for="date" class="block text-gray-600 pr-2">Tanggal:</label>
                                  <x-text-input id="date" type="date" name="date" value="{{ $shipment->date }}" class="block mt-1 w-36"/>
                                </div>
                                @if($shipment->status == 'PENDING')
                                <div class="flex items-center">
                                    <label for="status" class="block text-yellow-600 font-bold pr-2">{{ $shipment->status }}</label>
                                </div>
                                @elseif ($shipment->status == 'ON-GOING')
                                    <div class="flex items-center">
                                        <label for="status" class="block text-blue-600 font-bold pr-2">{{ $shipment->status }}</label>
                                    </div>
                                @elseif ($shipment->status == 'DELIVERED')
                                    <div class="flex items-center">
                                        <label for="status" class="block text-green-600 font-bold pr-2">{{ $shipment->status }}</label>
                                    </div>
                                @endif

                            </div>
                            <div class="flex items-center mb-4 justify-between">
                                <div class="items-center">
                                    <label for="item_type" class="block text-gray-600 w-8">Jenis:</label>
                                    <x-text-input id="item_type" type="text" name="item_type" value="{{ $shipment->item_type }}" class="block mt-1 w-36"/>
                                </div>
                                <div class="items-center">
                                    <label for="quantity" class="block text-gray-600 w-8">Jumlah:</label>
                                    <x-text-input id="quantity" type="number" name="quantity" value="{{ $shipment->quantity }}" class="block mt-1 w-36"/>
                                </div>
                                <div class="items-center">
                                    <label for="weight" class="block text-gray-600 w-8">Berat:</label>
                                    <x-text-input id="weight" type="number" name="weight" value="{{ $shipment->weight }}" class="block mt-1 w-36"/>
                                </div>
                                <div class="items-center">
                                    <label for="cubic_meters" class="block text-gray-600 w-8">Kubikasi:</label>
                                    <x-text-input id="cubic_meters" type="number" name="cubic_meters" value="{{ $shipment->cubic_meters }}" class="block mt-1 w-36"/>
                                </div>
                            </div>
                            <div class="flex items-center mb-4 justify-between">
                                <div class="flex items-center">
                                    <label for="origin_location" class="block text-gray-600 w-32">Lokasi Awal:</label>
                                    <x-text-input id="origin_location" type="text" name="origin_location" value="{{ $shipment->origin_location }}" class="block mt-1 w-36"/>
                                </div>
                                <div class="flex items-center">
                                    <label for="destination_location" class="block text-gray-600 w-32">Lokasi Tujuan:</label>
                                    <x-text-input id="destination_location" type="text" name="destination_location" value="{{ $shipment->destination_location }}" class="block mt-1 w-36"/>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <label for="shipping_cost" class="block text-gray-600 w-32">Biaya Kirim:</label>
                                <x-text-input id="shipping_cost" type="number" name="shipping_cost" value="{{ $shipment->shipping_cost }}" class="block mt-1 flex-grow"/>
                            </div>
                            <div class="flex items-center mb-4">
                                <label for="other_costs" class="block text-gray-600 w-32">Biaya Lain:</label>
                                <x-text-input id="other_costs" type="number" name="other_costs" value="{{ $shipment->other_costs }}" class="block mt-1 flex-grow"/>
                            </div>
                            <div class="flex items-center mb-4">
                                <label class="block text-gray-600 w-32">Biaya Total:</label>
                                <label class="block text-gray-600 w-32 ml-2">{{ $shipment->shipping_cost+$shipment->other_costs }}</label>
                            </div>
                        </div>
                        <div class="px-6 pb-4 flex items-center justify-between">
                            <x-secondary-button  onclick="location.href='{{ route('admin.dashboard') }}'">
                                <x-back-logo/>
                            </x-secondary-button>
                            <x-primary-button type="submit">
                                <x-save-logo/>
                            </x-primary-button>
                        </div>
                    </form>
                    <div class="flex items-center justify-start">
                        <x-auth-session-status class="py-4 px-4" :status="session('status')" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
