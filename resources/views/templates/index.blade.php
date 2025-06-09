@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-400 to-purple-600">
    <div class="w-full max-w-[1024px] mx-auto bg-[#313331]  rounded-lg shadow-2xl flex flex-col" style="box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);">
        <!-- Title Bar -->
        <div class="flex items-center justify-between bg-[#313331] px-4 py-2 border-b border-gray-400 rounded-t-lg">
            <div class="flex items-center space-x-2">
                
                <h1 class="ml-4 text-base font-semibold text-white">Your PDF Templates</h1>
            </div>
            <div class="space-x-2">
                <button class="text-xs px-4 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600">New</button>
                <button class="text-xs px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Sort</button>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 bg-white rounded-b-lg p-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-7 gap-6">
                @foreach ($templates ?? [] as $template)
                <div class="flex flex-col items-center p-4 border border-gray-300 bg-gray-50 rounded hover:bg-blue-100 hover:border-blue-400 cursor-pointer transition">
                    <a href="{{ route('templates.view', [ "template"=>urlencode($template ]) }}">
                        <i class="fa fa-file-pdf-o fa-3x text-red-500 mb-2" aria-hidden="true"></i>
                        <span class="text-xs text-gray-900 text-center">{{ $template }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
