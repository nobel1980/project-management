<?php

namespace App\Console\Commands;

use App\Models\Issue;
use Illuminate\Console\Command;

class UpdateIssueStatus extends Command
{
    protected $signature = 'update:issue-status';
    protected $description = 'Update issue status if not completed within the tentative completion date';

    public function handle()
    {
        $issues = Issue::where('status', '!=', 'Approved')
                              ->where('tentative_completion_date', '<', now())
                              ->get();

        foreach ($issues as $issue) {
            $issue->update(['status' => 'Completion Failed']);
        }

        $this->info('Issue statuses updated successfully.');
    }
}