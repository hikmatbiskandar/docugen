@extends('layouts.app')

@section('header_title', 'Editing Template: ' . $name)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Editor (Left) -->
    <form method="POST" action="{{ route('templates.save') }}" class="w-full">
        @csrf
        <input type="hidden" name="name" value="{{ $name }}">
        <div class="mb-4 w-full">
            <label class="block text-gray-700 font-semibold mb-2">Template Content</label>
            <textarea name="content" rows="16" class="w-full border rounded p-2 text-sm">{!! old('content', $template) !!}</textarea>
            @error('content')
                <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end w-full">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
        </div>
    </form>
    <!-- Preview (Right) -->
    <div class="w-full">
        <label class="block text-gray-700 font-semibold mb-2">Preview</label>
        <iframe 
            id="template-preview" 
            src="{{ route('templates.view', ['template' => $name]) }}" 
            class="w-full border rounded bg-white"
            style="height: 80vh;"
        ></iframe>
    </div>
</div>
@endsection
