<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueStatusHistory extends Model
{
    protected $fillable = ['issue_id', 'status', 'changed_at'];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}

