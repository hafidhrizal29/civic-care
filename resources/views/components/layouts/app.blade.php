<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CivicCare') }} - Dashboard</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-surface-1">
        <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
            {{-- Mobile overlay --}}
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false"
                 class="fixed inset-0 z-30 bg-ink/50 lg:hidden"></div>

            {{-- Sidebar --}}
            <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                 class="fixed inset-y-0 left-0 z-40 w-64 transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:z-auto">
                <x-sidebar />
            </div>

            {{-- Main content --}}
            <div class="flex-1 flex flex-col overflow-hidden">
                {{-- Top bar --}}
                <header class="h-16 bg-white border-b border-border-subtle flex items-center justify-between px-4 lg:px-8 shrink-0">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 text-ink-muted hover:text-ink rounded-lg hover:bg-surface-1 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <div class="hidden lg:block">
                        {{ $header ?? '' }}
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 text-sm text-ink-muted hover:text-ink transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                            <span class="hidden sm:inline">Lihat Website</span>
                        </a>
                    </div>
                </header>

                {{-- Page content --}}
                <main class="flex-1 overflow-y-auto">
                    <div class="p-4 lg:p-8">
                        <x-flash-message />
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
