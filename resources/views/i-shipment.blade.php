<x-guest-layout>
    <div class="container mx-auto mt-2">
        <h2 class="font-bold text-xl text-gray-800 leading-tight mb-2">
            <span>Selamat Datang di Raja Cargo !</span>
        </h2>
        <h2 class="text-lg text-gray-800 leading-tight text-justify">
            <span>Lacak pengirman cargo anda dengan memasukan nomor STT dibawah ini.</span>
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('shipment.show') }}" method="POST" class="mt-2">
            @csrf
            <div class="mb-4">
                <label for="shipment_number" class="text-sm font-medium text-gray-700">No. STT:</label>
                <x-text-input type="text" class="block mt-2 w-full" id="shipment_number" name="shipment_number" required/>
            </div>
            <div class="px-28">
                <x-primary-button class="block mt-2 w-full justify-center">
                    {{ __('Lacak') }}
                </x-primary-button>
            </div>
        </form>
        <x-auth-session-status class="mb-4 mt-4" :status="session('status')" />
    </div>
</x-guest-layout>
