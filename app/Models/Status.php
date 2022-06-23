<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Post;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
