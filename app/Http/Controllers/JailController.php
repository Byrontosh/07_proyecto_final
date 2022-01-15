<?php

namespace App\Http\Controllers;

use App\Models\Jail;
use App\Models\Ward;
use Illuminate\Http\Request;

class JailController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-jails');
    }

    public function index()
    {
        $jails = Jail::query();

        if (request('search')) {
            $jails = $jails->where('name', 'like', '%' . request('search') . '%');
        }

        $jails = $jails->orderBy('name', 'asc')
            ->paginate();

            return view('jail.index', compact('jails'));
    }


    public function create()
    {
        $wards = Ward::where('state', true)->get();
        return view('jail.create', [
            'wards' => $wards
        ]);
    }


    public function store(Request $request)
    {


        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:45'],
            'code' => ['required', 'string', 'alpha_dash', 'min:5', 'max:45'],
            'type' => ['required', 'string'],
            'capacity' => ['required', 'string', 'numeric', 'digits:1', 'min:2', 'max:5'],
            'ward_id' => ['required', 'string', 'numeric', 'exists:wards,id'],
            'description' => ['nullable', 'string', 'min:5', 'max:255'],
        ]);


        $jail = new Jail();

        $jail->create([
            "name" => $request['name'],
            "code" => $request['code'],
            "type" => $request['type'],
            "capacity" => $request['capacity'],
            "ward_id" => $request['ward_id'],
            "description" => $request['description']
        ]);

        return back()->with('status', 'Jail created successfully');
    }


    public function show(Jail $jail)
    {
        return view('jail.show', ['jail' => $jail]);
    }


    public function edit(Jail $jail)
    {
        $wards = Ward::where('state', true)->get();
        return view('jail.update', [
            'jail' => $jail,
            'wards' => $wards,
        ]);
    }


    public function update(Request $request,  Jail $jail)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:45'],
            'code' => ['required', 'string', 'alpha_dash', 'min:5', 'max:45'],
            'type' => ['required', 'string'],
            'capacity' => ['required', 'string', 'numeric', 'digits:1', 'min:2', 'max:5'],
            'ward_id' => ['required', 'string', 'numeric', 'exists:wards,id'],
            'description' => ['nullable', 'string', 'min:5', 'max:255'],
        ]);

        $jail->update([
            'name' =>  $request['name'],
            'code' =>  $request['code'],
            'type' =>  $request['type'],
            'capacity' =>  $request['capacity'],
            'ward_id' =>  $request['ward_id'],
            'description' =>  $request['description'],
        ]);
        return back()->with('status', 'Jail updated successfully');
    }


    public function destroy(Jail $jail)
    {
        $state = $jail->state;
        $message = $state ? 'inactivated' : 'activated';

        if ($this->verifyJailHasAssignedPrisoners($jail))
        {
            return back()->with([
                'status' => "The jail $jail->name has assigned prisoner(s).",
                'color' => 'yellow'
            ]);
        }

        $jail->state = !$state;
        $jail->save();
        return back()->with('status', "Jail $message successfully");
    }

    private function verifyJailHasAssignedPrisoners(Jail $jail): bool
    {
        return (bool)$jail->users->count();
    }
}
