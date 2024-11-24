<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    // use Sluggable;

    /**
     * The getPosts that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }

    // public function sluggable(): array
    // {
    //     # code...
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];

    // }
}
