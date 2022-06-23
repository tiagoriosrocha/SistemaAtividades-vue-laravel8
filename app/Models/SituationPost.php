<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituationPost extends Model
{
    use HasFactory;


    protected $table = 'situation_posts';

    protected $fillable = [
        'situation_id',
        'post_id',
    ];
}
