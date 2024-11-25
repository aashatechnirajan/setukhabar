<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasFactory;
    /**
     * The getPosts that belong to the Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'posts_sections');
    }
}
