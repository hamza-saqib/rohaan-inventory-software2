<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('pages.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCode = Vendor::orderBy('code', 'DESC')->get()->first()->code + 1;
        return view('pages.vendors.create', compact('currentCode'));
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
            'code' => ['required', 'numeric', 'unique:supplierrec,code'],
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'phone1' => 'nullable|string|max:15',
            'phone2' => 'nullable|string|max:15',
            'fax_no' => 'nullable|string|max:10',
            'ntn' => 'nullable|string|max:20',
            'stn' => 'nullable|string|max:40',
            'remarks' => 'nullable|string|max:100',
        ]);

        $vendor = new Vendor();

        $vendor->code = $request->input('code');
        $vendor->name1 = $request->input('name');
        $vendor->address = $request->input('address');
        $vendor->phone1 = $request->input('phone1');
        $vendor->phone2 = $request->input('phone2');
        $vendor->faxno = $request->input('fax_no');
        $vendor->ntn = $request->input('ntn');
        $vendor->stn = $request->input('stn');
        $vendor->remarks = $request->input('remarks');

        if ($vendor->save()) {
            return redirect()->route('vendors.index')->with(['success' => 'Suplier Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Location.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('pages.vendorss.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('pages.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {

        $this->validate($request, [
            'code' => ['required', 'numeric', Rule::unique('supplierrec', 'code')->ignore($vendor->code, 'code')],
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'phone1' => 'nullable|string|max:15',
            'phone2' => 'nullable|string|max:15',
            'fax_no' => 'nullable|string|max:10',
            'ntn' => 'nullable|string|max:20',
            'stn' => 'nullable|string|max:40',
            'remarks' => 'nullable|string|max:100',
        ]);

        $vendor->code = $request->input('code');
        $vendor->name1 = $request->input('name');
        $vendor->address = $request->input('address');
        $vendor->phone1 = $request->input('phone1');
        $vendor->phone2 = $request->input('phone2');
        $vendor->faxno = $request->input('fax_no');
        $vendor->ntn = $request->input('ntn');
        $vendor->stn = $request->input('stn');
        $vendor->remarks = $request->input('remarks');

        if ($vendor->save()) {
            return redirect()->route('vendors.edit', $request->input('code'))->with(['success' => 'Unit Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Location.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        try {
            $vendor->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
