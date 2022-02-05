<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function list_reports()
    {
        // https://laravel.com/docs/8.x/eloquent-collections#introduction
        $reports = Report::where('state', true)->get();

        // https://laravel.com/docs/8.x/eloquent-resources#resource-collections
        return ReportResource::collection($reports);
    }
}
