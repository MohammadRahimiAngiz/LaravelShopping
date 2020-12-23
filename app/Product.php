<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'title','description','price','stock','user_id','view_count','slug_title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
