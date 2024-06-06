<x-app-layout>
    <div class="container mx-auto mt-6">
        <div class="flex flex-grow mb-4">
            <div class="w-full flex flex-grow">
                <div class="flex flex-grow mx-2">
                    <div class="w-full md:w-1/2 px-2">
                        <label for="shipment_number" class="block text-sm font-medium text-gray-700">No STT:</label>
                        <x-text-input type="text" id="shipment_number" name="shipment_number"/>
                    </div>

                    <div class="w-full md:w-1/2 px-2">
                        <label for="shipment_status" class="block text-sm font-medium text-gray-700">Status:</label>
                        <select id="shipment_status" name="shipment_status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                            <option value="">All</option>
                            <option value="PENDING">Pending</option>
                            <option value="ON-GOING">On-going</option>
                            <option value="DELIVERED">Delivered</option>
                        </select>
                    </div>

                    <div class="w-full px-2 mt-2 md:mt-0">
                        <br>
                        <x-primary-button id="search-button" class="h-auto">
                            <x-search-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </x-primary-button>
                    </div>

                    <div class="container mx-auto mt-6 flex justify-end px-2">
                        <br>
                        <x-primary-button id="add-button" class="h-auto">
                            <x-add-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </x-primary-button>
                        <div id="dropdown-menu" class="origin-top-right absolute right-3 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1" role="none">
                                <a href="{{ route('customer.create') }}" class="block px-4 py-2 text-sm text-center text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                    <div class="flex items-center justify-center"> <!-- Centering container -->
                                        <x-add-customer-logo class="block h-9 w-auto fill-current text-gray-800 mr-2" /> <!-- Adjusted logo position -->
                                        <span class="pl-3 inline-block align-middle">Customer Baru</span>
                                    </div>
                                </a>
                                <a href="{{ route('shipment.create') }}" class="block px-4 py-2 text-sm text-center text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                    <div class="flex items-center justify-center"> <!-- Centering container -->
                                        <x-add-shipment-logo class="block h-9 w-auto fill-current text-gray-800" />
                                        <span class="inline-block align-middle">Pengiriman Baru</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
        </div>
        <div class="flex items-center justify-start">
            <x-auth-session-status class="py-4 px-4" :status="session('status')" />
        </div>
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full table-auto text-center border-collapse">
                <thead>
                    <tr class="bg-gray-600 text-white uppercase tracking-wider">
                        <th class="px-3 py-3 border border-gray-200 text-xs">NO. STT</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">TANGGAL</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">JENIS</th>
                        <th class="px-2 py-3 border border-gray-200 text-xs">JUMLAH</th>
                        <th class="px-4 py-3 border border-gray-200 text-xs">BERAT</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">KUBIKASI</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">PENGIRIM</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">PENERIMA</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">ASAL</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">TUJUAN</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">STATUS</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">KELOLA</th>
                    </tr>
                </thead>
                <tbody id="shipment-data" class="bg-white">
                    @foreach ($shipments as $data)
                    <tr class="border border-gray-300 hover:bg-gray-200">
                        {{-- <td class="px-6 py-4 text-xs">{{ $counter++ }}</td> --}}
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->shipment_number }}</td>
                        <td class="px-4 py-4 border border-gray-200 text-xs">{{ $data->date }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->item_type }}</td>
                        <td class="px-2 py-4 border border-gray-200 text-xs">{{ $data->quantity }}</td>
                        <td class="px-4 py-4 border border-gray-200 text-xs">{{ $data->weight }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->cubic_meters }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->sender_name }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->recipient_name }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->origin_location }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->destination_location }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->status }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">
                            <div class="flex justify-center">
                                <x-anchor-button href="{{ route('shipment.edit',$data->shipment_number) }}" class="mr-1">
                                    <x-edit-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </x-anchor-button>
                                <x-anchor-button href="{{ route('shipment-event.index',$data->shipment_number) }}">
                                    <x-manage-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </x-anchor-button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

{{-- <script>
    document.getElementById('search-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const shipmentNumber = document.getElementById('shipment_number').value;
        const status = document.getElementById('shipment_status').value;

        fetch('/search-shipments', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                shipment_number: shipmentNumber,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('shipment-data');
            tableBody.innerHTML = '';

            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="12" class="text-center">No results found.</td></tr>';
            } else {
                data.forEach(shipment => {
                    const tableRow = `
                        <tr>
                            <td class="px-6 py-4 text-xs">${shipment.shipment_number}</td>
                            <td class="px-6 py-4 text-xs">${shipment.date}</td>
                            <td class="px-6 py-4 text-xs">${shipment.item_type}</td>
                            <td class="px-6 py-4 text-xs">${shipment.quantity}</td>
                            <td class="px-6 py-4 text-xs">${shipment.weight}</td>
                            <td class="px-6 py-4 text-xs">${shipment.cubic_meters}</td>
                            <td class="px-6 py-4 text-xs">${shipment.sender_name}</td>
                            <td class="px-6 py-4 text-xs">${shipment.recipient_name}</td>
                            <td class="px-6 py-4 text-xs">${shipment.origin_location}</td>
                            <td class="px-6 py-4 text-xs">${shipment.destination_location}</td>
                            <td class="px-6 py-4 text-xs">${shipment.status}</td>
                            <td class="px-6 py-4 text-xs">
                                <x-primary-button>
                                    Manage Shipment
                                </x-primary-button>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += tableRow;
                });
            }
        })
        .catch(error => console.error(error));
    });
</script> --}}

<script>
    document.getElementById('search-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const shipmentNumber = document.getElementById('shipment_number').value;
        const status = document.getElementById('shipment_status').value;

        fetch('/search-shipments', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                shipment_number: shipmentNumber,
                status: status
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.getElementById('shipment-data');
            tableBody.innerHTML = '';

            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="12" class="text-center">No results found.</td></tr>';
            } else {
                data.forEach(shipment => {
                    const editUrl = '/shipment/edit/' + shipment.shipment_number;
                    const kelolaUrl = '/shipment-event/' + shipment.shipment_number;
                    const tableRow = `
                        <tr>
                            <td class="px-6 py-4 border border-gray-200 text-xs">${shipment.shipment_number}</td>
                            <td class="px-4 py-4 border border-gray-200 text-xs">${shipment.date}</td>
                            <td class="px-6 py-4 border border-gray-200 text-xs">${shipment.item_type}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.quantity}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.weight}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.cubic_meters}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.sender_name}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.recipient_name}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.origin_location}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.destination_location}</td>
                            <td class="px-2 py-4 border border-gray-200 text-xs">${shipment.status}</td>
                            <td class="px-6 py-4 text-xs">
                                <x-anchor-button href="${editUrl}" class="mr-1">
                                    <x-edit-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </x-anchor-button>
                                <x-anchor-button href="${kelolaUrl}">
                                    <x-manage-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </x-anchor-button>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += tableRow;
                });
            }
        })
        .catch(error => console.error('There was a problem with the fetch operation:', error));
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var addButton = document.getElementById('add-button');
        var dropdownMenu = document.getElementById('dropdown-menu');

        addButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!addButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

    });
</script>
