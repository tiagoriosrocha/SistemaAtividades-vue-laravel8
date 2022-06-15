<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use App\Models\Frame;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

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
}
