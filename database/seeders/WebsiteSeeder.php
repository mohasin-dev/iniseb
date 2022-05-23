<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            [
                'title' => 'Website one',
                'description' => 'This is description',
                'url' => '#',
            ],
            [
                'title' => 'Website Two',
                'description' => 'This is description',
                'url' => '##',
            ]
        ]);
    }
}
