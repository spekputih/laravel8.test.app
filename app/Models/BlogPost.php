<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Scopes\DeletedAdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

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
        return $this->hasMany('App\Models\Comment')->latest();
    }


    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query){
        return $query->withCount('comment')->orderBy('comment_count', 'desc');
    }

    public static function boot(){
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();

        // static::addGlobalScope(new LatestScope);
        static::updating(function(BlogPost $blogPost){
            Cache::forget("blog-post-{$blogPost->id}");
        });

        static::deleting(function(BlogPost $blogPost){
            $blogPost->comment()->delete();
        });
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
