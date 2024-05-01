<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class posts extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['title', 'body', 'image', 'author'];

    function Author(){
        
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '-',
                'onUpdate' => true, 
                'save_to' => 'slug', 
                'unique' => true, 
                'maxLength' => 128, 
                'maxLengthKeepWords' => true, 
                'method' => function ($string, $separator) {
                    return Str::slug($string, $separator);
                }
            ]
        ];
    }
}
