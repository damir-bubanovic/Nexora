<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReportRevision extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_report_id',
        'revision_number',
        'notes',
        'status',
        'created_by',
    ];

    public function report()
    {
        return $this->belongsTo(TaskReport::class, 'task_report_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}