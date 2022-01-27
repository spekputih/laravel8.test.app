<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content'
    ];

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    public static function boot(){
        parent::boot();

        static::deleting(function(BlogPost $blogPost){
            $blogPost->comment()->delete();
        });
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
