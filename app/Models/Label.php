<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    protected $tasks;

    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task');
    }
}
