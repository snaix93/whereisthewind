<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('navigation.head')
<body class="font-sans antialiased">
{{--        @livewireStyles--}}
<header class='bg-dark-900'>
    @include('navigation.navigation')
</header>
<x-banner />
<div class="min-h-screen bg-gray-100">
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    <!-- Page Content -->
    <main class='bg-dark-900'>
        {{ $slot }}
    </main>
</div>
@stack('modals')

{{--        @livewireScripts--}}

@include('navigation.footer')
</body>
</html>
