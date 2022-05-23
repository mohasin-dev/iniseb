<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'Post one',
                'slug' => Post::checkSlugExists(Str::slug('Post one')),
                'body' => 'This is body of post one',
                'website_id' => Website::all()->random(1)->first()->id
            ],
            [
                'title' => 'Post Two',
                'slug' => Post::checkSlugExists(Str::slug('Post Two')),
                'body' => 'This is body of post two',
                'website_id' => Website::all()->random(1)->first()->id
            ]
        ]);
    }
}
