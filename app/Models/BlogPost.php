<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Scopes\LatestScope;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    public static function boot(){
        parent::boot();

        static::addGlobalScope(new LatestScope);

        static::deleting(function(BlogPost $blogPost){
            $blogPost->comment()->delete();
        });
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
