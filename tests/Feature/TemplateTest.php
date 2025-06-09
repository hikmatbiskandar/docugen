<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class TemplateTest extends TestCase
{

    /** @test */
    public function it_lists_templates()
    {
        $templatePath = env('PDF_TEMPLATES_PATH', 'templates');
        Storage::disk('local')->put("{$templatePath}/sample.html", '<p>Hello</p>');
        Storage::disk('local')->put("{$templatePath}/ignore.txt", 'Should not show');

        $response = $this->get('/templates');

        $response->assertStatus(200);
        $response->assertSee('sample');
        $response->assertDontSee('ignore');
    }

    /** @test */
    public function it_loads_edit_view_for_existing_template()
    {
        $templatePath = env('PDF_TEMPLATES_PATH', 'templates');
        Storage::disk('local')->put("{$templatePath}/test_template.html", '<p>Test</p>');

        $response = $this->get('/template/edit/test_template');

        $response->assertStatus(200);
        $response->assertSee('<p>Test</p>', false);
    }

    /** @test */
    public function it_redirects_if_template_not_found()
    {
        $response = $this->get('/template/edit/missing_template');

        $response->assertRedirect('/templates');
        $response->assertSessionHas('error');
    }

    /** @test */
    public function it_saves_a_new_template()
    {
        $templatePath = env('PDF_TEMPLATES_PATH', 'templates');
        $response = $this->post('/template/save', [
            'name' => 'new_template',
            'content' => '<p>Saved</p>',
        ]);

        $response->assertRedirect('/template/edit/new_template');
        $response->assertSessionHas('success');

        Storage::disk('local')->assertExists("{$templatePath}/new_template.html");
        $this->assertStringContainsString(
            'Saved',
            Storage::disk('local')->get("{$templatePath}/new_template.html")
        );
    }

    /** @test */
    public function it_validates_template_inputs()
    {
        $response = $this->post('/template/save', []);

        $response->assertSessionHasErrors(['name', 'content']);
    }
}
