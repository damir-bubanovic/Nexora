<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
    protected $fillable = [
        'task_id',
        'summary',
        'changed_files',
        'changed_lines',
        'sql_queries',
        'testing_notes',
        'created_by',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}