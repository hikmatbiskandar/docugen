<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DocuGen')</title>
    @vite(['resources/css/app.css'])
    {{-- tailwind cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-white text-black min-h-screen">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-400 to-purple-600">
        <div class="w-full max-w-[1024px] mx-auto bg-[#313331] rounded-lg shadow-2xl flex flex-col" style="box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);">
            <!-- Title Bar -->
            <div class="flex items-center justify-between bg-[#313331] px-4 py-2 rounded-t-lg">
                <div class="flex items-center space-x-2">
                    <h1 class="ml-4 text-base font-semibold text-white">
                        @yield('header_title', 'Your PDF Templates')
                    </h1>
                </div>
                <div class="space-x-2">
                    {{-- <button class="text-xs px-4 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600">New</button>
                    <button class="text-xs px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Sort</button> --}}
                </div>
            </div>
            @if(session('error'))
                <div class="w-full">
                    <div class="bg-gradient-to-r from-red-500 to-pink-500 border border-red-600 text-white px-6 py-4 rounded-none shadow font-semibold text-center">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="w-full">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 border border-green-600 text-white px-6 py-4 rounded-none shadow font-semibold text-center">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <!-- Content Area -->
            <div class="flex-1 bg-white rounded-b-lg p-6">
                    @yield('content')
            </div>
        </div>
    </div>
</body>
</html>