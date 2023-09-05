<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Artist;
class artistSeeder extends Seeder
{
    public function run(): void
    {
      Artist::factory(10)->create();

       Artist::factory()->create([
            'name' => 'Test User',
           'bio'=>'this si the test bio',
        ]);
    }
}
