<x-guest-layout>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-300 mb-4">
                <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">
                    {{ __('Detail Pengiriman') }}
                </h3>
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-1/2 px-2 mb-4">
                        <label for="shipment_number" class="block font-bold text-gray-800 mb-1">No. STT:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->shipment_number }}</div>
                    </div>
                    <div class="w-1/2 px-2 mb-4">
                        <label for="date" class="block font-bold text-gray-800 mb-1">Tanggal:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->date }}</div>
                    </div>
                    <div class="w-full px-2 mb-4">
                        <label class="block font-bold text-gray-800 mb-1">Status:</label>
                        <div class="border border-gray-300 p-2">
                            @if($shipment->status == 'PENDING')
                                <span class="text-yellow-600 font-bold">{{ $shipment->status }}</span>
                            @elseif ($shipment->status == 'ON_GOING')
                                <span class="text-blue-600 font-bold">{{ $shipment->status }}</span>
                            @elseif ($shipment->status == 'DELIVERED')
                                <span class="text-green-600 font-bold">{{ $shipment->status }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-1/2 px-2 mb-4">
                        <label for="item_type" class="block font-bold text-gray-800 mb-1">Jenis Barang:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->item_type }}</div>
                    </div>
                    <div class="w-1/2 px-2 mb-4">
                        <label for="quantity" class="block font-bold text-gray-800 mb-1">Jumlah:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->quantity }}</div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-1/2 px-2 mb-4">
                        <label for="weight" class="block font-bold text-gray-800 mb-1">Berat /Kg:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->weight }}</div>
                    </div>
                    <div class="w-1/2 px-2 mb-4">
                        <label for="cubic_meters" class="block font-bold text-gray-800 mb-1">Kubikasi:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->cubic_meters }}</div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-1/2 px-2 mb-4">
                        <label for="sender_name" class="block font-bold text-gray-800 mb-1">Pengirim:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->sender_name }}</div>
                    </div>
                    <div class="w-1/2 px-2 mb-4">
                        <label for="recipient_name" class="block font-bold text-gray-800 mb-1">Penerima:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->recipient_name }}</div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-1/2 px-2 mb-4">
                        <label for="origin_location" class="block font-bold text-gray-800 mb-1">Lokasi Awal:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->origin_location }}</div>
                    </div>
                    <div class="w-1/2 px-2 mb-4">
                        <label for="destination_location" class="block font-bold text-gray-800 mb-1">Lokasi Tujuan:</label>
                        <div class="border border-gray-300 p-2">{{ $shipment->destination_location }}</div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-300">
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
</x-guest-layout>
