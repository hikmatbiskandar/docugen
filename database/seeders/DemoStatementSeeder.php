<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DemoStatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * How to run:
     * 
     * php artisan db:seed --class=DemoStatementSeeder
     */
    public function run(): void
    {
        if (!Schema::hasTable('statement_econsent')) {
            Schema::create('statement_econsent', function (Blueprint $table) {
                $table->id();
                $table->uuid('document_id');
                $table->string('name');
                $table->date('dob');
                $table->string('email')->unique();
                $table->string('company_name');
                $table->text('procedures')->nullable();
                $table->text('risks_benefits')->nullable();
                $table->timestamps();
            });
        }

        $faker = Faker::create();

        foreach (range(1, 100) as $i) {
            DB::table('statement_econsent')->insert([
                'document_id' => strtoupper(Str::uuid()),
                'name' => $faker->name,
                'dob' => $faker->date('Y-m-d'),
                'email' => $faker->unique()->safeEmail,
                'company_name' => $faker->company,
                'procedures' => $faker->paragraph,
                'risks_benefits' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
