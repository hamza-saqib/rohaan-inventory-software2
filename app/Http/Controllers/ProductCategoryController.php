<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('pages.product-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCode = ProductCategory::orderBy('code', 'DESC')->get()->first()->code + 1;
        return view('pages.product-categories.create', compact('currentCode'));
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
            'code' => ['required', 'numeric', 'unique:itemcat,code'],
            'description' => ['required', 'string'],
            'factor' => ['required', 'numeric'],
            'remarks' => ['nullable', 'string']
        ]);

        $category = new ProductCategory();

        $category->code = $request->input('code');
        $category->name1 = $request->input('description');
        $category->remarks = $request->input('remarks');
        $category->factor = $request->input('factor');

        if ($category->save()) {
            return redirect()->route('product-categories.index')->with(['success' => 'Item Category Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Category.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $product_category)
    {
        return view('pages.product-categories.show', compact('ProductCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $product_category)
    {
        return view('pages.product-categories.edit', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $product_category)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric', Rule::unique('itemcat')->ignore($product_category->code, 'code')],
            'description' => ['required', 'string'],
            'factor' => ['required', 'numeric'],
            'remarks' => ['nullable', 'string']
        ]);

        $product_category->code = $request->input('code');
        $product_category->name1 = $request->input('description');
        $product_category->remarks = $request->input('remarks');
        $product_category->factor = $request->input('factor');

        if ($product_category->save()) {
            // return redirect()->route('product-categories.edit', $request->input('code'))->with(['success' => 'Unit Successfully Saved.']);
            return redirect()->route('product-categories.index')->with(['success' => 'Unit Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving ProductCategory.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $product_category)
    {
        try {
            $product_category->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
