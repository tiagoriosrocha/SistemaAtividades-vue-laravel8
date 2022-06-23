<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use App\Models\Frame;
use App\Models\User;
use App\Models\Situation;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'scheduledto',
        'description',
        'user_id',
        'frame_id'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class); //tem muitas
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class); //pertence a
    }

    public function user()
    {
        return $this->belongsTo(User::class); //pertence a
    }

    public function situations()
    {
        return $this->belongsToMany(Situation::class, 'situation_posts', 'post_id', 'situation_id');
    }
}
