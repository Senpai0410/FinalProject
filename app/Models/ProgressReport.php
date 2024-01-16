<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $fillable = [
        'project_id', 'date_of_progress', 'status', 'description'
    ];
    protected $casts = [
        'date_of_progress' => 'date',
    ];
    /**
     * Get the project that the progress report belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
