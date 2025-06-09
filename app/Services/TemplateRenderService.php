<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class TemplateRenderService
{

    protected $disk;
    protected $templatePath;

    public function __construct()
    {
        $this->disk = env('FILESYSTEM_DRIVER', 'local');
        $this->templatePath = env('PDF_TEMPLATES_PATH', 'templates');
    }

    public function generatePDF(string $templateName, $table, array $ids, bool $regen = false): string
    {
        $templateHtml = $this->loadTemplate($templateName);
        
        // if _GET['mode'] == html, return HTML instead of PDF
        if (request()->input('mode') === 'html') {
            echo $templateHtml;
            die();
        }

        

        // if didn't specify id or table, just skip the variable replacement
        if (!empty($ids) && !empty($table)) {

            // if ids = ["all"], fetch all records from the table
            if (count($ids) === 1 && $ids[0] === 'all') {
                $records = DB::table($table)->get();

                if ($records->isEmpty()) {
                    throw new \Exception("No records found in table '{$table}'.");
                }

                // replace ids with actual record IDs
                $ids = $records->pluck('id')->toArray();
            }
                
            
            $renderedHtml = '';
            foreach ($ids as $id) {
                $record = DB::table($table)->find($id);
                if (!$record) {
                    continue;
                }

                $html = $this->replaceVariables($templateHtml, (array) $record);

                $renderedHtml .= $html;
            }

            if (empty($renderedHtml)) {
                throw new \Exception("No valid records found for rendering.");
            }

            $templateHtml = $renderedHtml;
        }

        $pdf = Pdf::loadHTML($templateHtml)->setPaper('A4');
        return $pdf->output(); // return raw PDF string
    }

    protected function loadTemplate(string $name): string
    {
        $path = $this->templatePath."/{$name}.html";

        if (!Storage::disk('local')->exists($path)) {
            throw new \Exception("Template '{$name}' not found.");
        }

        return Storage::disk('local')->get($path);
    }

    protected function replaceVariables(string $html, array $data): string
    {
        // Matches {{ variable_name }} and replaces with actual value
        return preg_replace_callback('/\{\{\s*(\w+)\s*\}\}/', function ($matches) use ($data) {
            $field = $matches[1];
            return $data[$field] ?? '';
        }, $html);
    }
}