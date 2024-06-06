<x-app-layout>

    <div class="container mx-auto mt-6">
        <div class="flex flex-grow mb-4">
            <div class="flex items-center">

                <div class="w-full px-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Customer:</label>
                    <x-text-input type="text" id="name" name="name" class="w-full"/>
                </div>

                <div class="px-2">
                    <br>
                    <x-primary-button id="search-button" class="h-full">
                        <x-search-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </x-primary-button>
                </div>

            </div>



                <div class="w-full px-2">
                    <br>
        <div class="flex justify-end">
            <x-primary-button id="add-button" class="items-center" onclick="window.location.href='{{ route('customer.create') }}'">
                <x-add-w-customer-logo class="block h-9 w-auto fill-current text-gray-800" />
            </x-primary-button>
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
                        <th class="px-1 py-3 border border-gray-200 text-xs">ID</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">NAMA</th>
                        <th class="px-1 py-3 border border-gray-200 text-xs">ALAMAT</th>
                        <th class="px-1 py-3 border border-gray-200 text-xs">TELP</th>
                        <th class="px-6 py-3 border border-gray-200 text-xs">EDIT</th>
                    </tr>
                </thead>
                <tbody id="shipment-data" class="bg-white">
                    @foreach ($customer as $data)
                    <tr class="border border-gray-300 hover:bg-gray-200">
                        <td class="px-1 py-4 border border-gray-200 text-xs">{{ $data->id }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">{{ $data->name }}</td>
                        <td class="px-1 py-4 border border-gray-200 text-xs">{{ $data->address }}</td>
                        <td class="px-1 py-4 border border-gray-200 text-xs">{{ $data->phone }}</td>
                        <td class="px-6 py-4 border border-gray-200 text-xs">
                            <x-anchor-button href="{{ route('customer.edit',$data->id) }}" class="block">
                                <x-edit-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </x-anchor-button>
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

        const name = document.getElementById('name').value;

        fetch('/search-customers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name: name })
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
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No results found.</td></tr>';
            } else {
                data.forEach(customer => {
                    const tableRow = `
                        <tr class="border border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-4 text-xs">${customer.id}</td>
                            <td class="px-6 py-4 text-xs">${customer.name}</td>
                            <td class="px-6 py-4 text-xs">${customer.address}</td>
                            <td class="px-6 py-4 text-xs">${customer.phone}</td>
                            <td class="px-6 py-4 text-xs">
                            <x-anchor-button href="{{route('customer.edit',${customer.id}) }}" class="block">
                                <x-edit-logo class="block h-9 w-auto fill-current text-gray-800" />
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
</script> --}}

<script>
    document.getElementById('search-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const name = document.getElementById('name').value;

        fetch('/search-customers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name: name })
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
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No results found.</td></tr>';
            } else {
                data.forEach(customer => {
                    const editUrl = '/customer/edit/' + customer.id; // Dynamically generate the edit URL
                    const tableRow = `
                        <tr class="border border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-4 text-xs">${customer.id}</td>
                            <td class="px-6 py-4 text-xs">${customer.name}</td>
                            <td class="px-6 py-4 text-xs">${customer.address}</td>
                            <td class="px-6 py-4 text-xs">${customer.phone}</td>
                            <td class="px-6 py-4 text-xs">
                                <x-anchor-button href="${editUrl}" class="block">
                                    <x-edit-logo class="block h-9 w-auto fill-current text-gray-800" />
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


