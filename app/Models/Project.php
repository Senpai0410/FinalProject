<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $fillable = [
        'system_name', 'business_unit_id', 'project_type','developers', 'lead_developer', 'system_owner', 'system_pic',
        'project_start_date', 'project_duration', 'project_end_date',
        'project_status', 'development_methodology', 'system_platform', 'deployment_type'
    ];

    /**
     * Get the business unit that owns the project.
     */
    public function businessUnit()
    {
        return $this->belongsTo(BusinessUnit::class,'business_unit_id');
    }

    /**
     * Get the user (lead developer) associated with the project.
     */


    /**
     * Get the progress reports for the project.
     */
    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class);
    }
}
