<?php

namespace App\Http\Controllers;

use App\Models\IssueInventory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RecieveInventory;
use App\Models\UnitMeasurement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // $products = Product::all();
        $products = Product::with('category')->get();
        return view('pages.products.index', compact('products'));
    }

    public function negativeBalance()
    {
        $products = Product::select('icitem.code', 'icitem.name1',
         DB::raw('SUM(oldissue.Qty) as qtyOut'),DB::raw('SUM(oldissue.Iamt) as totOut'),DB::raw('SUM(invrec.nv) as totIn'), DB::raw('SUM(invrec.qty) as qtyIn'))
         ->leftJoin('oldissue', 'oldissue.ic', '=', 'icitem.code')
         ->leftJoin('invrec', 'invrec.ic', '=', 'icitem.code')
        ->groupBy('icitem.code', 'icitem.name1')
        ->havingRaw('SUM(oldissue.Qty) > SUM(invrec.qty)')
        ->get();
        
        return view('pages.products.negative-balance', compact('products'));
    }

    public function ledger(Request $request)
    {
        // return $request;
        $records = [];
        $sum = [];
        $products = Product::select('code', 'name1')->get();
        if ($request->filled('product_code')) {
            $records = IssueInventory::select(
                'oldissue.ic',
                'oldissue.Qty as qtyOut',
                'oldissue.isdt as date',
                'icitem.name1 as product',
                'icitem.code as code',
                'oldissue.Irate as rateOut',
                'oldissue.dpt'
            )
                ->where('ic', $request->product_code)
                ->when($request->filled('start_date'), function ($query) use ($request) {
                    return $query->where('isdt', '>=', $request->start_date);
                })
                ->when($request->filled('end_date'), function ($query) use ($request) {
                    return $query->where('isdt', '<=', $request->end_date);
                })
                ->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
                ->get()->toArray();

            $recordsIn = RecieveInventory::select(
                'invrec.vn',
                'invrec.sc',
                'invrec.gn as grn',
                'invrec.qty as qtyIn',
                'invrec.vd as date',
                'icitem.name1 as product',
                'icitem.code as code',
                'invrec.rat as rateIn'
            )
                ->where('ic', $request->product_code)
                ->when($request->filled('start_date'), function ($query) use ($request) {
                    return $query->where('vd', '>=', $request->start_date);
                })
                ->when($request->filled('end_date'), function ($query) use ($request) {
                    return $query->where('vd', '<=', $request->end_date);
                })
                ->leftJoin('icitem', 'icitem.code', '=', 'invrec.ic')
                ->get()->toArray();
            // $records = $records->merge($recordsIn);
            $records = array_merge($records, $recordsIn);
            usort($records, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
            $balance = 0;
            $sum = [];
            $sum['totalQtyIn'] = 0;
            $sum['totalQtyOut'] = 0;
            $sum['totalValueIn'] = 0;
            $sum['totalValueOut'] = 0;
            foreach ($records as &$value) {
                if (isset($value['qtyIn'])) {
                    $value['qtyIn'] = intval($value['qtyIn']);
                    $value['rateIn'] = floatval($value['rateIn']);
                    $balance += $value['qtyIn'];
                    $value['valueIn'] = $value['qtyIn'] * $value['rateIn'];
                    $sum['totalQtyIn'] += $value['qtyIn'];
                    $sum['totalValueIn'] += $value['valueIn'];
                } else {
                    $value['qtyOut'] = intval($value['qtyOut']);
                    $value['rateOut'] = floatval($value['rateOut']);
                    $balance -= $value['qtyOut'];
                    $value['valueOut'] = $value['qtyOut'] * $value['rateOut'];
                    $sum['totalQtyOut'] -= $value['qtyOut'];
                    $sum['totalValueOut'] -= $value['valueOut'];
                }
                $value['balance'] = $balance;
            }
        }
        $request->flash();
        return view('pages.products.ledger', compact('products', 'records', 'sum'));
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
            return redirect()->route('products.index')->with(['success' => 'Unit Successfully Saved.']);
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
