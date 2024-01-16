<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    public $table = 'business_units';

    public $fillable = ['name'];

    /**
     * Get the projects for the business unit.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
