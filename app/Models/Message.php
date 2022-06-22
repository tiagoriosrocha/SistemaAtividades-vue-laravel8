<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'title',
        'text',
        'user_id',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class); //pertence a
    }

    public function user()
    {
        return $this->belongsTo(User::class); //pertence a
    }
}
