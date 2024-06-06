<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-block px-4 py-2 mt-2 text-sm font-medium text-white bg-navy rounded-md shadow-sm text-center hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy']) }}>
    {{ $slot }}
</a>
