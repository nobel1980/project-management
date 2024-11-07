<?php

// app/Models/Project.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Issue; 

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Define the relationship
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
