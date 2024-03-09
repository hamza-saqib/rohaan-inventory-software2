<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UnitMeasurement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCode = Product::orderBy('code', 'DESC')->get()->first()->code + 1;
        $units = UnitMeasurement::all();
        $categories = ProductCategory::all();
        return view('pages.products.create', compact('units', 'categories', 'currentCode'));
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
            'description' => ['required', 'string'],
            'uom' => ['required', 'string'],
            'category' => ['required', 'string'],
            'misc_code' => 'nullable|string|max:15',
            'remarks' => 'nullable|string|max:100',
        ]);

        $product = new Product();

        $product->code = $request->input('code');
        $product->name1 = $request->input('description');
        $product->uom = $request->input('uom');
        $product->catcode = $request->input('category');
        $product->misc_code = $request->input('misc_code');
        // $product->faxno = $request->input('fax_no');
        // $product->ntn = $request->input('ntn');
        // $product->stn = $request->input('stn');
        $product->remarks = $request->input('remarks');

        if ($product->save()) {
            return redirect()->route('products.index')->with(['success' => 'Item Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Location.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $units = UnitMeasurement::all();
        $categories = ProductCategory::all();
        return view('pages.products.edit', compact('product', 'units', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric', Rule::unique('supplierrec', 'code')->ignore($product->code, 'code')],
            'description' => ['required', 'string'],
            'uom' => ['required', 'string'],
            'category' => ['required', 'string'],
            'misc_code' => 'nullable|string|max:15',
            'remarks' => 'nullable|string|max:100',
        ]);

        $product->code = $request->input('code');
        $product->name1 = $request->input('description');
        $product->uom = $request->input('uom');
        $product->catcode = $request->input('category');
        $product->misc_code = $request->input('misc_code');
        // $product->faxno = $request->input('fax_no');
        // $product->ntn = $request->input('ntn');
        // $product->stn = $request->input('stn');
        $product->remarks = $request->input('remarks');

        if ($product->save()) {
            return redirect()->route('products.edit', $request->input('code'))->with(['success' => 'Unit Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Location.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
