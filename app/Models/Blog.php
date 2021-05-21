<?php

namespace App\Models;

use App\Traits\CustomSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes, CustomSearch;

    protected $appends = ['short_description'];
    
    protected $searchable = [
        'title',
        'slug',
        'description'
    ];
    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 50, ' ...');
    } 
}
