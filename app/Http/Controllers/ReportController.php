<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }



    public function index()
    {
        $guard = Auth::user();
        $reports = $guard->reports();
        if (request('search')) {
            $reports = $reports->where('title', 'like', '%' . request('search') . '%');
        }

        $reports = $reports->orderBy('title', 'asc')
            ->paginate();

        return view('report.index', [
            'reports' => $reports,
        ]);
    }


    public function create()
    {
        return view('report.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:45'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:512'], //max image size is 512 kb
        ]);

        $guard = Auth::user();
        $report = new Report();
        $report->title = $request['title'];
        $report->description = $request['description'];

        $guard->reports()->save($report);

        if ($request->has('image'))
        {
            $report->storeImage($request['image'], 'reports');
        }
        return back()->with('status', 'Report created successfully');
    }


    public function show(Report $report)
    {
        return view('report.show', ['report' => $report]);
    }


    public function edit(Report $report)
    {
        return view('report.update', ['report' => $report]);
    }


    public function update(Request $request, Report $report)
    {

        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:45'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:512'], //max image size is 512 kb
        ]);
        $report->title = $request['title'];
        $report->description = $request['description'];
        $report->save();

        if ($request->has('image'))
        {
            $report->updateImage($request['image'], 'reports');
        }

        return back()->with('status', 'Report updated successfully');
    }


    public function destroy(Report $report)
    {
        $state = $report->state;
        $message = $state ? 'inactivated' : 'activated';
        $report->state = !$state;
        $report->save();
        return back()->with('status', "Report $message successfully");
    }
}
