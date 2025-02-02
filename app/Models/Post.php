<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use Likeable;
    use HasFactory;

    /* protected $with = ['user', 'category']; */

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class);
    }
}
