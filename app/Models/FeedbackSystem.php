<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackSystem extends Model
{
    use HasFactory;
    protected $table = 'feedback_systems';

    protected $fillable = [
        'apppackagename', 'email','message',
    ];
}
