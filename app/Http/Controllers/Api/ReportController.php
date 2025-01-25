<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ReportResource;
use App\Http\Resources\UserResource;
use App\Jobs\GenerateReportJob;
use App\Models\Report;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'startDate'=> 'required|date',
            'endDate'=> 'required|date',
        ]);
    
        $report = Report::create([
            'title' => $request->title,            
            'report_link' => null,
        ]);
        $users = User::whereBetween('birth_Date', [$request->startDate, $request->endDate])->get();
        $users = UserResource::collection($users);
        
        GenerateReportJob::dispatch($report, $users);
        return response()->json([
            new ReportResource($report),
            'message' => 'The report is in process',            
        ], Response::HTTP_CREATED);
    }
    public function getReport($id)
    {
        $report = Report::findOrFail($id);
        if (!$report->report_link) {
            return response()->json([
                'message' => 'The report is not ready',
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->download(storage_path("app/{$report->report_link}"));
    }
    public function listReport()
    {
        return ReportResource::collection(Report::all());
    }
}
