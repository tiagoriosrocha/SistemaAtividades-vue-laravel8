<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;

    protected $table = 'situation';

    protected $fillable = [
        'title',
        'color',
        'icon'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'situation_posts', 'situation_id', 'post_id');
    }
}
