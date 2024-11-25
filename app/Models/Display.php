<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Display extends Model
{
    use HasFactory;
    
    /**
     * The getAds that belong to the Display
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getAds(): BelongsToMany
    {
        return $this->belongsToMany(Ad::class, 'ads_displays');
    }
}
