<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    protected $disk;
    protected $templatePath;

    public function __construct()
    {
        $this->disk = env('FILESYSTEM_DRIVER', 'local');
        $this->templatePath = env('PDF_TEMPLATES_PATH', 'templates');
    }

    public function index()
    {
        $files = Storage::disk($this->disk)->files($this->templatePath);

        $templates = collect($files)
            ->filter(fn($file) => Str::endsWith($file, '.html'))
            ->map(fn($file) => basename($file, '.html'));

        return view('templates.index', compact('templates'));
    }

    public function edit(string $name = null)
    {
        $template = '';

        $name = urldecode($name);

        if ($name) {
            $path = "{$this->templatePath}/{$name}.html";

            if (Storage::disk($this->disk)->exists($path)) {
                $template = Storage::disk($this->disk)->get($path);
            } else {
                return redirect()->route('templates.index')->with('error', 'Template not found.');
            }
        }

        return view('templates.edit', compact('name', 'template'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);

        $filename = "{$this->templatePath}/{$request->name}.html";
        Storage::disk($this->disk)->put($filename, $request->content);

        return redirect()->route('templates.edit', ['name' => $request->name])
                         ->with('success', 'Template saved successfully.');
    }
}
