<?php

// app/Models/Issue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IssueStatusHistory;

class Issue extends Model
{
    use HasFactory;

    const STATUS_OPEN = 'Open';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_DONE = 'Done';
    const STATUS_REVIEW = 'Review';
    const STATUS_APPROVED = 'Approved';
    const STATUS_FAILED = 'Failed';

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'requested_date',
        'tentative_completion_date',
        'assigned_user_id',
        'status',
    ];

    // Define the inverse relationship
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function statusHistories()
    {
        return $this->hasMany(IssueStatusHistory::class);
    }

    public function updateStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();

        // Log status change in history
        $this->statusHistories()->create([
            'status' => $newStatus,
            'changed_at' => now()
        ]);
    }
}
