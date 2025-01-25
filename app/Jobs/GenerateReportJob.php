<?php

namespace App\Jobs;

use App\Exports\ExportUser;
use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $report;
    protected $users;
    /**
     * Create a new job instance.
     */
    public function __construct($report, $users)
    {
        $this->users = $users;
        $this->report = $report;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = "reports/report_{$this->report->title}_{$this->report->id}.xlsx";
        Excel::store(new ExportUser($this->users), $path, 'local');
        $this->report->update(['report_link' => $path]);
    }
}
