<?php

namespace App\Models;

use Carbon\Carbon;
use Nilambar\NepaliDate\NepaliDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{

    use HasFactory;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'  => 'title',


            ]
            ];



    }

    protected $casts = [
        'image' => 'array',

    ];

    protected $fillable = [
        'views','shares',
    ];
    /**
     * The getCategories that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'posts_categories');
    }

        /**
     * The getCategories that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getSections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class,'posts_sections');
    }

    /**
     * Get all of the getComments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getTimeDifference(){
        $difference = $this->created_at->diffForHumans(Carbon::now());
        $stripped = str_replace(['ago','before'],'अगाडी',$difference);
        $final = str_replace(
            ['seconds','second','minutes','minute','hours','hour','days','day','weeks','week','months','month','years','year'],
            ['सेकेन्ड','सेकेन्ड','मिनेट','मिनेट','घण्टा','घण्टा','दिन','दिन','हप्ता','हप्ता','महिना','महिना','वर्ष','वर्ष'],$stripped);
        return $final;
    }

    public function getNepaliDate(){
        $obj = new NepaliDate;
        $year = $this->created_at->format('Y');
        $month = $this->created_at->format('m');
        $day = $this->created_at->format('d');
        $nepaliDate = $obj->convertAdToBs($year,$month,$day);
        $info = $obj->getDetails($nepaliDate['year'],$nepaliDate['month'],$nepaliDate['day'],'bs','np');
        $dateDetail = $info['m'].'-'.$info['F'].'-'.$info['Y'];
        return $dateDetail;
    }
    
    public function getFirstImagePathAttribute()
    {
        // If the image path is stored with relative path
        if ($this->image) {  // assuming 'image' is your column name
            return asset('uploads/post/' . basename($this->image));
        }
        return asset('images/default.jpg'); // fallback image
    }
}
