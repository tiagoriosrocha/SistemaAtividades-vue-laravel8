<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Frame extends Model
{
    use HasFactory;

    protected $table = 'frames';

    protected $fillable = [
        'title',
        'color',
        'user_id'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class); //tem muitas
    }

    public function user()
    {
        return $this->belongsTo(User::class); //pertence a
    }
}
