<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoActivity extends Model
{
    use HasFactory;

    protected $table="todo_activities";

    protected $fillable = [
        'action',
        'user_id',
    ];

}
