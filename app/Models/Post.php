<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'website_id',
    ];

    /**
     * Check duplicate slug. If exists generate new one and repeat check again.
     *
     * @param $slug
     * @return mixed
     */
    public static function checkSlugExists($slug)
    {
        $checkExists = Post::whereSlug($slug)->first();

        if ($checkExists !== null) {
            // generate again new txId
            $slug = $slug . '-' . $checkExists->id;

            // recursive the whole process again
            return self::checkSlugExists($slug);

        } else {
            return $slug;
        }
    }
}
