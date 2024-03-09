<?php

namespace App\Http\Controllers;

use App\Models\UnitMeasurement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UnitMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitMeasurements = UnitMeasurement::all();
        return view('pages.measurements.index', compact('unitMeasurements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCode = UnitMeasurement::count() + 1;
        return view('pages.measurements.create', compact('currentCode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric', 'unique:uomind'],
            'description' => ['required', 'string'],
            'factor' => ['required', 'numeric']
        ]);

        $measurement = new UnitMeasurement();

        $measurement->code = $request->input('code');
        $measurement->descrip = $request->input('description');
        $measurement->factor = $request->input('factor');

        if ($measurement->save()) {
            return redirect()->route('measurements.index')->with(['success' => 'Unit Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Unit.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitMeasurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function show(UnitMeasurement $measurement)
    {
        return view('pages.measurements.show', compact('measurement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitMeasurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitMeasurement $measurement)
    {
        return view('pages.measurements.edit', compact('measurement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitMeasurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitMeasurement $measurement)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric', Rule::unique('uomind')->ignore($measurement->code, 'code')],
            'description' => ['required', 'string'],
            'factor' => ['required', 'numeric']
        ]);

        $measurement->code = $request->input('code');
        $measurement->descrip = $request->input('description');
        $measurement->factor = $request->input('factor');

        if ($measurement->save()) {
            return redirect()->route('measurements.edit', $request->input('code'))->with(['success' => 'Unit Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Unit.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitMeasurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitMeasurement $measurement)
    {
        try {
            $measurement->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
