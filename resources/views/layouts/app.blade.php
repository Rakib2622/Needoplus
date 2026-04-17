
    @include('customer.partial.header')

    {{-- Your Custom Navbar --}}
    @include('customer.partial.navonly')

    {{-- Page Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Your Custom Footer --}}
    @include('customer.partial.footer')
