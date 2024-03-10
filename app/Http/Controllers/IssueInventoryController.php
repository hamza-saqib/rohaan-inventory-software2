<?php

namespace App\Http\Controllers;

use App\Models\IssueInventory;
use App\Models\Location;
use App\Models\Product;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssueInventoryController extends Controller
{
    public $years;
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $currentYear = date('Y');
        for ($year = $currentYear; $year >= 2000; $year--) {
            $this->years[] = $year;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();
        $query = IssueInventory::select('oldissue.*', 'icitem.name1 as product')
            ->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('isdt', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                return $query->where('isdt', '<=', $request->end_date);
            })->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('isdt', '>=', $request->start_date);
            })->when($request->filled('product_code'), function ($query) use ($request) {
                return $query->where('ic', '=', $request->product_code);
            });

        $sum = [
            'totalValue' => $query->sum(DB::raw('Irate * Qty'))
        ];

        $inventories = $query->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
            // ->leftJoin('supplierrec', 'supplierrec.code', '=', 'oldissue.sc')
            ->paginate(50);

        $request->flash();
        return view('pages.issue-inventories.index', compact('inventories', 'products', 'sum'));
    }

    public function monthlyReportProduct(Request $request)
    {
        // return $request;
        $date = Carbon::createFromDate(intval($request->year), 1, 1);
        $records = [];
        $years = $this->years;
        $report = 'Item';
        $dropDownData = Product::select('code', 'name1')->get();

        // return $request->filled('year');
        if ($request->filled('year')) {
            $date = Carbon::createFromDate(intval($request->year), 1, 1);
            $records = Product::when(($request->code != 'All'), function ($query) use ($request) {
                return $query->where('code', '=', $request->code);
            })->get();
            foreach ($records as $key => $record) {
                // return $record->code;
                $record['jul']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['aug']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['sep']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['oct']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['nov']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['dec']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['jan']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['feb']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['mar']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['apr']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['may']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->endOfMonth())->sum(DB::raw('Iamt'));
                $record['jun']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth())->sum(DB::raw('Iamt'));
            }
        }
        $request->flash();
        // return $records;
        return view('pages.issue-inventories.reports-monthly', compact('records', 'years', 'report', 'dropDownData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCode = IssueInventory::orderBy('isno', 'DESC')->get()->first()->isno + 1;
        $locations = Location::all();
        $products = Product::all();
        return view('pages.issue-inventories.create', compact('products', 'locations', 'currentCode'));
    }
    public function voucher($isno)
    {
        $inventories = IssueInventory::
        select(
            'oldissue.*',
            'icitem.name1 as product',
        )
        ->where('isno', $isno)
        ->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
        ->get();
        $qty = 0;
        $totalValue = 0;
        foreach ($inventories as $key => $value) {
            $qty += intval($value->Qty);
            $totalValue += $value->Qty * $value->Irate;
        }
        $issueNo = $inventories[0]->isno;
        $date = $inventories[0]->isdt;
        return view('pages.issue-inventories.voucher-show', compact('inventories', 'date', 'issueNo', 'qty', 'totalValue'));
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
            'issue_no' => ['required', 'numeric'],
            'issue_date' => ['required', 'string'],
        ]);

        $products = $request->input('products');
        // $currentIDCol = IssueInventory::orderBy('id_col', 'DESC')->get()->first()->id_col;
        foreach ($products['code'] as $key => $product) {
            $inventory = new IssueInventory();

            $inventory->isno = $request->input('issue_no');
            $inventory->isdt = date('Y-m-d', strtotime($request->input('issue_date')));
            $inventory->ic = $products['code'][$key];
            $inventory->Qty = $products['qty'][$key];
            $inventory->Irate = $products['wgt_avg_rate'][$key];
            $inventory->dpt = $products['location'][$key];
            $inventory->Iamt = $products['issue_value'][$key];
            $inventory->remarks = $products['remarks'][$key];
            // $inventory->id_col = $currentIDCol++;
            $inventory->fy = 2112;

            $inventory->save();
        }

        if (true) {
            return redirect()->back()->with(['success' => 'Inventory Successfully Issued.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Location.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Product $inventory)
    {
        return view('pages.issue-inventories.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $inventory)
    {
        $units = UnitMeasurement::all();
        $categories = ProductCategory::all();
        return view('pages.issue-inventories.edit', compact('product', 'units', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $inventory)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric', Rule::unique('supplierrec', 'code')->ignore($inventory->code, 'code')],
            'description' => ['required', 'string'],
            'uom' => ['required', 'string'],
            'category' => ['required', 'string'],
            'misc_code' => 'nullable|string|max:15',
            'remarks' => 'nullable|string|max:100',
        ]);

        $inventory->code = $request->input('code');
        $inventory->name1 = $request->input('description');
        $inventory->uom = $request->input('uom');
        $inventory->catcode = $request->input('category');
        $inventory->misc_code = $request->input('misc_code');
        // $inventory->faxno = $request->input('fax_no');
        // $inventory->ntn = $request->input('ntn');
        // $inventory->stn = $request->input('stn');
        $inventory->remarks = $request->input('remarks');

        if ($inventory->save()) {
            return redirect()->route('products.edit', $request->input('code'))->with(['success' => 'Unit Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Location.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $inventory)
    {
        try {
            $inventory->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
