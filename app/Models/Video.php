<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'name',
        'image',
        'description',
        'user_id',
        'video'

    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
