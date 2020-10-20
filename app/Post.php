<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'content', 'tag', 'category_id', 'date_hour', 'img', 'link','user_id'];

    public function category(){
     
        return $this->belongsTo(Category::class);
    }
    public function user(){
    return $this->belongsTo(User::class);
    }
}
