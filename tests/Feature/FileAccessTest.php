<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class FileAccessTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
    }

    public function test_can_write_file_to_storage()
    {
        $filePath = 'test/hello.txt';
        $content = 'Hello World';

        \Storage::disk('local')->put($filePath, $content);

        $this->assertTrue(\Storage::disk('local')->exists($filePath));
    }

    public function test_can_read_file_from_storage()
    {
        $filePath = 'test/hello.txt';
        $content = 'Hello World';

        \Storage::disk('local')->put($filePath, $content);

        $readContent = \Storage::disk('local')->get($filePath);

        $this->assertEquals($content, $readContent);
    }

    public function test_can_delete_file_from_storage()
    {
        $filePath = 'test/hello.txt';
        $content = 'Hello World';

        \Storage::disk('local')->put($filePath, $content);
        $this->assertTrue(\Storage::disk('local')->exists($filePath));

        \Storage::disk('local')->delete($filePath);

        $this->assertFalse(\Storage::disk('local')->exists($filePath));
    }

}
