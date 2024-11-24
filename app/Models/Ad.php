<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ad extends Model
{
    use HasFactory;
    /**
     * The getDisplays that belong to the Ad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getDisplays(): BelongsToMany
    {
        return $this->belongsToMany(Display::class, 'ads_displays');
    }
}
