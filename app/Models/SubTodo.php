<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Title',
        'Description',
        'completed',
        'user_id',
    ];
}
