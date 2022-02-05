<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-wards');
    }


    public function index()
    {
        $wards = Ward::query();

        if (request('search'))
        {
            $wards = $wards->where('name', 'like', '%' . request('search') . '%');
        }

        $wards = $wards->orderBy('name', 'asc')
            ->paginate();

        return view('ward.index', compact('wards'));

    }


    public function create()
    {
        return view('ward.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required', 'string', 'min:3', 'max:45'],
            'location' => ['required', 'string', 'min:3', 'max:45'],
            'description' => ['nullable', 'string', 'min:5', 'max:255'],
        ]);
        $ward = new Ward();

        $ward->create([
            "name" => $request['name'],
            "location" => $request['location'],
            "description" => $request['description']
        ]);

        return back()->with('status', 'Ward created successfully');
    }


    public function show(Ward $ward)
    {
        return view('ward.show', ['ward' => $ward]);
    }


    public function edit(Ward $ward)
    {
        return view('ward.update', ['ward' => $ward]);
    }


    public function update(Request $request, Ward $ward)
    {
        $request->validate([
            'name'=> ['required', 'string', 'min:3', 'max:45'],
            'location' => ['required', 'string', 'min:3', 'max:45'],
            'description' => ['nullable', 'string', 'min:5', 'max:255'],
        ]);

        $ward->update([
            "name" => $request['name'],
            "location" => $request['location'],
            "description" => $request['description']
        ]);

        return back()->with('status', 'Ward updated successfully');
    }


    public function destroy(Ward $ward)
    {

        $state = $ward->state;
        $message = $state ? 'inactivated' : 'activated';

        if ($this->verifyWardHasAssignedGuards($ward))
        {
            return back()->with([
                'status' => "The ward $ward->name has assigned guard(s).",
                'color' => 'yellow'
            ]);
        }

        $ward->state = !$state;

        $ward->save();

        return back()->with('status', "Ward $message successfully");
    }

        private function verifyWardHasAssignedGuards(Ward $ward)
        {
            return (bool)$ward->users->count();
        }

}
