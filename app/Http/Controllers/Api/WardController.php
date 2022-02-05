<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    // Para verificar la acción (CRUD) del usuario por medio de los gates
    public function __construct()
    {
        $this->middleware('can:manage-wards')->except('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ward::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required'],
            'location' => ['required'],
            'description' => ['nullable'],
        ]);

        return Ward::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ward::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> ['required'],
            'location' => ['required'],
            'description' => ['nullable'],
        ]);
        $ward= Ward::find($id);
        $ward->update([
            "name" => $request['name'],
            "location" => $request['location'],
            "description" => $request['description']
        ]);
        return $ward;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ward= Ward::find($id);
        $state = $ward->state;

        if ($this->verifyWardHasAssignedGuards($ward))
        {
            //https://laravel.com/docs/8.x/responses#json-responses
            return response()->json([
                                        'name' => "The ward $ward->name has assigned guard(s).",
                                        'code' => '400',
                                    ]);
        }
        $ward->state = !$state;
        $ward->save();
        return $ward;

    }

    private function verifyWardHasAssignedGuards(Ward $ward)
    {
        return (bool)$ward->users->count();
    }
}
