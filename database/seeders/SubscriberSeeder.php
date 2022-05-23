<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribers')->insert([
            [
                'email' => 'admin@test.com',
                'website_id' => Website::all()->random(1)->first()->id
            ],
            [
                'email' => 'user@test.com',
                'website_id' => Website::all()->random(1)->first()->id
            ]
        ]);
    }
}
