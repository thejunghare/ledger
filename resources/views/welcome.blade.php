<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ $title ?? 'ledger' }}
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>

    </style>
</head>

<body class="h-screen flex flex-col">
    {{-- header --}}
    <div class="border h-16 bg-slate-50 flex justify-around items-center">
        <div class="w-1/2   ">
            <a href=""
                class="cursor-not-allowed p-6 font-semibold text-dark-60 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ $title ?? 'Ledger' }}</a>
        </div>
        <div class="w-1/2 text-right">
            <a href="/"
                class="p-6 font-semibold text-dark-60 hover:underline focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
        </div>
    </div>
    {{-- main --}}
    <div class="flex-1 relative isolate px-6 pt-14 lg:px-8 overflow-x-hidden">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] "
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">

            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Manage your <span
                        class="text-teal-500">finance online</span></h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Elevate your financial management experience with our
                    online platform. Effortlessly oversee and organize your finances, to gain
                    valuable insights.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    @auth
                        <a href="{{ url('/home') }}"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Home
                            <span aria-hidden="true">→</span></a>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log
                            in <span aria-hidden="true">→</span></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-sm font-semibold leading-6 text-gray-900 underline">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    {{-- footer --}}
    <footer class="h-12 border bg-slate-100  flex items-center justify-center"">
        <p class="font-medium text-justify tracking-tight">
            Developed by <span class="decoration-sky-500 underline decoration-wavy"> @thejughare</span>
        </p>
    </footer>

</body>

</html>
