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
        'todo_id'
    ];

    public function subtodo()
    {
        return $this->belongsTo(Todo::class);
    }

}
