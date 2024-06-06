<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengiriman Baru') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <form action="{{ route('shipment.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <x-input-label for="shipment_number" :value="__('No. STT')" />
                <x-text-input id="shipment_number" class="block mt-1 w-full" type="text" name="shipment_number" :value="old('shipment_number')" required autofocus/>
                <x-input-error :messages="$errors->get('shipment_number')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="date" :value="__('Tanggal')" />
                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required/>
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="item_type" :value="__('Jenis Barang')" />
                <x-text-input id="item_type" class="block mt-1 w-full" type="text" name="item_type" :value="old('item_type')" />
                <x-input-error :messages="$errors->get('item_type')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="quantity" :value="__('Jumlah')" />
                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" required/>
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="weight" :value="__('Berat')" />
                <x-text-input id="weight" class="block mt-1 w-full" type="number" step="0.01" name="weight" :value="old('weight')" required/>
                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="cubic_meters" :value="__('Kubikasi')" />
                <x-text-input id="cubic_meters" class="block mt-1 w-full" type="number" step="0.01" name="cubic_meters" :value="old('cubic_meters')" required/>
                <x-input-error :messages="$errors->get('cubic_meters')" class="mt-2" />
            </div>

            {{-- <div class="mb-4">
                <x-input-label for="sender_id" :value="__('Sender')" />
                <x-text-input id="sender_id" class="block mt-1 w-full" type="text" name="sender_id" :value="old('sender_id')" />
                <x-input-error :messages="$errors->get('sender_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="recipient_id" :value="__('Recipient')" />
                <x-text-input id="recipient_id" class="block mt-1 w-full" type="text" name="recipient_id" :value="old('recipient_id')" />
                <x-input-error :messages="$errors->get('recipient_id')" class="mt-2" />
            </div> --}}

            <div class="mb-4">
                <label for="toggle" class="inline-flex items-center">
                    <input type="checkbox" id="toggle" class="form-checkbox" onchange="toggleInput()">
                    <span class="ml-2">{{ __('Customer sudah terdaftar') }}</span>
                </label>
            </div>

            <div id="dropdown-section" class="hidden">
                <div class="mb-4">
                    <x-input-label for="sender_id" :value="__('Pengirim')" />
                    <select id="sender_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="sender_id" onchange="updateSenderAddress()">
                        <option value="">{{ __('Pilih Pengirim') }}</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" data-address="{{ $customer->address }}"
                                data-phone="{{ $customer->phone }}"
                                >{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('sender_id')" class="mt-2" />
                    <p id="sender_address" class="text-sm mt-2"></p>
                    <p id="sender_phone" class="text-sm mt-2"></p>
                    <a id="sender_edit_link" href="#" class="text-blue-500 mt-2 hidden">{{ __('Edit Pengirim') }}</a>
                </div>

                <div class="mb-4">
                    <x-input-label for="recipient_id" :value="__('Penerima')" />
                    <select id="recipient_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="recipient_id" onchange="updateRecipientAddress()">
                        <option value="">{{ __('Pilih Penerima') }}</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" data-address="{{ $customer->address }}"
                                data-phone="{{ $customer->phone }}"
                                >{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('recipient_id')" class="mt-2" />
                    <p id="recipient_address" class="text-sm mt-2"></p>
                    <p id="recipient_phone" class="text-sm mt-2"></p>
                    <a id="recipient_edit_link" href="#" class="text-blue-500 mt-2 hidden">{{ __('Edit Penerima') }}</a>
                </div>
            </div>

            <div id="input-section">
                <div class="mb-4">
                    <x-input-label for="new_sender_name" :value="__('Nama Pengirim')" />
                    <x-text-input id="new_sender_name" class="block mt-1 w-full" type="text" name="new_sender_name" :value="old('new_sender_name')" />
                    <x-input-error :messages="$errors->get('new_sender_name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="new_sender_phone" :value="__('Telp Pengirim')" />
                    <x-text-input id="new_sender_phone" class="block mt-1 w-full" type="text" name="new_sender_phone" :value="old('new_sender_phone')" />
                    <x-input-error :messages="$errors->get('new_sender_phone')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="new_sender_address" :value="__('Alamat Pengirim')" />
                    <x-text-input id="new_sender_address" class="block mt-1 w-full" type="text" name="new_sender_address" :value="old('new_sender_address')" />
                    <x-input-error :messages="$errors->get('new_sender_address')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="new_recipient_name" :value="__('Nama Penerimma')" />
                    <x-text-input id="new_recipient_name" class="block mt-1 w-full" type="text" name="new_recipient_name" :value="old('new_recipient_name')" />
                    <x-input-error :messages="$errors->get('new_recipient_name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="new_recipient_phone" :value="__('Telp Penerima')" />
                    <x-text-input id="new_recipient_phone" class="block mt-1 w-full" type="text" name="new_recipient_phone" :value="old('new_recipient_phone')" />
                    <x-input-error :messages="$errors->get('new_recipient_phone')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="new_recipient_address" :value="__('Alamat Penerima')" />
                    <x-text-input id="new_recipient_address" class="block mt-1 w-full" type="text" name="new_recipient_address" :value="old('new_recipient_address')" />
                    <x-input-error :messages="$errors->get('new_recipient_address')" class="mt-2" />
                </div>
            </div>

            <script>
                function updateSenderAddress() {
                    var senderSelect = document.getElementById('sender_id');
                    var selectedOption = senderSelect.options[senderSelect.selectedIndex];
                    var address = selectedOption.getAttribute('data-address');
                    var phone = selectedOption.getAttribute('data-phone');
                    document.getElementById('sender_address').textContent = address ? `Address: ${address}` : '';
                    document.getElementById('sender_phone').textContent = phone ? `Phone: ${phone}` : '';

                    var senderEditLink = document.getElementById('sender_edit_link');
                    var senderId = selectedOption.value;
                    if (senderId) {
                        senderEditLink.href = `/customer/edit/${senderId}`;
                        senderEditLink.classList.remove('hidden');
                    } else {
                        senderEditLink.classList.add('hidden');
                    }
                }

                function updateRecipientAddress() {
                    var recipientSelect = document.getElementById('recipient_id');
                    var selectedOption = recipientSelect.options[recipientSelect.selectedIndex];
                    var address = selectedOption.getAttribute('data-address');
                    var phone = selectedOption.getAttribute('data-phone');
                    document.getElementById('recipient_address').textContent = address ? `Address: ${address}` : '';
                    document.getElementById('recipient_phone').textContent = phone ? `Phone: ${phone}` : '';


                    var recipientEditLink = document.getElementById('recipient_edit_link');
                    var recipientId = selectedOption.value;
                    if (recipientId) {
                        recipientEditLink.href = `/customer/edit/${recipientId}`;
                        recipientEditLink.classList.remove('hidden');
                    } else {
                        recipientEditLink.classList.add('hidden');
                    }
                }

                function toggleInput() {
                    var isChecked = document.getElementById('toggle').checked;
                    var dropdownSection = document.getElementById('dropdown-section');
                    var inputSection = document.getElementById('input-section');

                    if (isChecked) {
                        dropdownSection.classList.remove('hidden');
                        inputSection.classList.add('hidden');
                    } else {
                        dropdownSection.classList.add('hidden');
                        inputSection.classList.remove('hidden');
                    }
                }
            </script>


            <div class="mb-4">
                <x-input-label for="origin_location" :value="__('Lokasi Awal')" />
                <x-text-input id="origin_location" class="block mt-1 w-full" type="text" name="origin_location" :value="old('origin_location')" required/>
                <x-input-error :messages="$errors->get('origin_location')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="destination_location" :value="__('Lokasi Tujuan')" />
                <x-text-input id="destination_location" class="block mt-1 w-full" type="text" name="destination_location" :value="old('destination_location')" required/>
                <x-input-error :messages="$errors->get('destination_location')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="shipping_cost" :value="__('Biaya Pengiriman')" />
                <x-text-input id="shipping_cost" class="block mt-1 w-full" type="number" step="0.01" name="shipping_cost" :value="old('shipping_cost')" required/>
                <x-input-error :messages="$errors->get('shipping_cost')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="other_costs" :value="__('Biaya Lainnya')" />
                <x-text-input id="other_costs" class="block mt-1 w-full" type="number" step="0.01" name="other_costs" :value="old('other_costs')" required/>
                <x-input-error :messages="$errors->get('other_costs')" class="mt-2" />
            </div>

            {{-- <div class="mb-4">
                <x-input-label for="total_cost" :value="__('Biaya Total')" />
                <x-text-input id="total_cost" class="block mt-1 w-full" type="number" step="0.01" name="total_cost" :value="old('total_cost')" />
                <x-input-error :messages="$errors->get('total_cost')" class="mt-2" />
            </div> --}}

            <input type="hidden" name="status" value="pending">

                <div class="flex items-center mt-4 justify-between">
                <x-secondary-button  onclick="location.href='{{ route('admin.dashboard') }}'">
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
