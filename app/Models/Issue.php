<?php

// app/Models/Issue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'requested_date',
        'tentative_completion_date',
        'status',
    ];

    // Define the inverse relationship
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
