<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id',
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\TaskStatus');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Models\Label');
    }
}
