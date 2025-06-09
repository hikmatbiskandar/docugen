<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TemplateRenderService;
use Symfony\Component\HttpFoundation\Response;

class RenderController extends Controller
{
    protected $templateRenderer;
    protected $disk;
    protected $templatePath;

    public function __construct(TemplateRenderService $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
        $this->disk = env('FILESYSTEM_DRIVER', 'local');
        $this->templatePath = env('PDF_TEMPLATES_PATH', 'templates');
    }

    public function render(Request $request)
    {

        $request->validate([
            'template' => 'required|string',
            'id' => 'nullable|string', // supports comma-separated multiple IDs
            'table' => 'nullable|string',
            'regen' => 'nullable|boolean',
            'filename' => 'nullable|string',
        ]);

        $templateName = urldecode($request->input('template'));
        $ids = explode(',', $request->input('id'));
        $table = $request->input('table', null);
        $regen = $request->boolean('regen', false);
        $filename = $request->input('filename', 'generated.pdf');

        try {
            $pdf = $this->templateRenderer->generatePDF($templateName, $table, $ids, $regen);

            return response($pdf, 200)
            ->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate PDF',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
