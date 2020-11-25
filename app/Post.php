<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'subtitle', 'content', 'tag', 'category_id', 'img', 'link','user_id'];

    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function imgs()
    {
        return $this->hasMany(Image::class);
    }
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
