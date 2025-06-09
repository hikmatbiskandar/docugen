@extends('layouts.app')

@section('header_title', 'Your PDF Templates')

@section('content')

@foreach ($templates ?? [] as $template)

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-7 gap-6">
    <div class="flex flex-col items-center p-4 border border-gray-300 bg-gray-50 rounded-lg hover:bg-gray-100 hover:border-gray-400 cursor-pointer transition relative h-44 min-w-[12rem] flex-1 justify-between">
        <div class="flex flex-col items-center w-full flex-1">
            <i class="fa fa-file-pdf-o fa-3x text-red-500 mb-2" aria-hidden="true"></i>
            <span class="text-xs text-gray-900 text-center break-words">{{ $template }}</span>
        </div>
        <div class="flex w-full divide-x border-t border-gray-200 mt-1 pt-0 absolute bottom-0 left-0">
            <a href="{{ route('templates.view', [ 'template' => urlencode($template) ]) }}" class="flex-1 text-center py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition border-r last:border-r-0 rounded-bl-lg" title="View">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{ route('templates.edit', [ 'name' => urlencode($template) ]) }}" class="flex-1 text-center py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition border-r last:border-r-0" title="Edit">
                <i class="fa fa-pencil"></i>
            </a>
            <a href="{{ route('templates.view', [ 'template' => urlencode($template) ]) }}" class="flex-1 text-center py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition rounded-br-lg" title="Generate">
                <i class="fa fa-cogs"></i>
            </a>
        </div>
    </div>
</div>

@endforeach

@endsection
