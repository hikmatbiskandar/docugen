<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// View all templates
Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');

// Create / Edit template
Route::get('/template/edit/{name?}', [TemplateController::class, 'edit'])->name('templates.edit');
Route::post('/template/save', [TemplateController::class, 'save'])->name('templates.save');

// View template as rendered output
Route::get('/view', [RenderController::class, 'render'])->name('templates.view');

// Analyze variables in template
Route::get('/analyze', [ReportController::class, 'analyze'])->name('templates.analyze');