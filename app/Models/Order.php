<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'status',
        'user_id',
        'video_id'

    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function video() {
        return $this->belongsTo('App\Models\Video');
    }
}
