<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RecieveInventory;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecieveInventoryExport;


class RecieveInventoryController extends Controller
{
    public $years;
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        set_time_limit(3000); //3000 seconds = 50 minutes
        ini_set('memory_limit', -1);
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
        if ($request->filled('button') && ($request->input('button') == 'export')) {
            return Excel::download(new RecieveInventoryExport([
                'startDate' => $request->start_date, 'endDate' => $request->end_date, 'productCode' => $request->product_code, 'vendorCode' => $request->vendor_code,
                'saerch_keyword'=>$request->saerch_keyword
            ]), 'reciept inventory data.xls', \Maatwebsite\Excel\Excel::XLS);
        }
        $products = Product::all();
        $vendors = Vendor::all();
        $inventories = RecieveInventory::select('invrec.*', 'icitem.name1 as product', 'supplierrec.name1 as supplier')
            ->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('vd', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                return $query->where('vd', '<=', $request->end_date);
            })->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('vd', '>=', $request->start_date);
            })->when($request->filled('product_code') && ($request->product_code != 'All'), function ($query) use ($request) {
                return $query->where('ic', '=', $request->product_code);
            })
            ->when($request->filled('vendor_code') && ($request->vendor_code != 'All'), function ($query) use ($request) {
                return $query->where('sc', '=', $request->vendor_code);
            })->when($request->filled('saerch_keyword'), function ($query) use ($request) {
                return $query->where('supplierrec.name1', 'like', '%' . $request->saerch_keyword . '%')
                ->orWhere('icitem.name1', 'like', '%' . $request->saerch_keyword . '%')
                ->orWhere('remarks', 'like', '%' . $request->saerch_keyword . '%');
            })->leftJoin('icitem', 'icitem.code', '=', 'invrec.ic')
                ->leftJoin('supplierrec', 'supplierrec.code', '=', 'invrec.sc')
                ->paginate(50);
        // $sum = [
        //     'rate' => $query->sum(DB::raw('rat * qty')),
        //     'sed' => $query->sum('sed'),
        //     'fed' => $query->sum('fed'),
        //     'deduction' => $query->sum('od'),
        //     'net_value' => $query->sum('nv'),
        //     'sales_tax' => $query->sum('st')
        // ];


        $request->flash();

        return view('pages.recieve-inventories.index', compact('inventories', 'products', 'vendors'));
    }
    public function monthlyReportProduct(Request $request)
    {
        $records = [];
        $years = $this->years;
        $report = 'Item';
        $dropDownData = Product::select('code', 'name1')->get();

        if ($request->filled('year')) {
            $fiscalStartDate = Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth();
            $fiscalEndDate = Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth();
            $productCodes = RecieveInventory::select('ic')
                ->where('vd', '>=', $fiscalStartDate)->where('vd', '<=', $fiscalEndDate)
                ->groupBy('ic')->get()->pluck('ic');

            $records = Product::whereIn('code', $productCodes)->when(($request->code != 'All'), function ($query) use ($request) {
                return $query->where('code', '=', $request->code);
            })->get();

            foreach ($records as $key => $record) {
                // return $record->code;
                $record['jul']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->endOfMonth())->sum(DB::raw('nv'));
                $record['aug']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->endOfMonth())->sum(DB::raw('nv'));
                $record['sep']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->endOfMonth())->sum(DB::raw('nv'));
                $record['oct']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->endOfMonth())->sum(DB::raw('nv'));
                $record['nov']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->endOfMonth())->sum(DB::raw('nv'));
                $record['dec']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->endOfMonth())->sum(DB::raw('nv'));
                $record['jan']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->endOfMonth())->sum(DB::raw('nv'));
                $record['feb']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->endOfMonth())->sum(DB::raw('nv'));
                $record['mar']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->endOfMonth())->sum(DB::raw('nv'));
                $record['apr']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->endOfMonth())->sum(DB::raw('nv'));
                $record['may']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->endOfMonth())->sum(DB::raw('nv'));
                $record['jun']  = RecieveInventory::where('ic', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth())->sum(DB::raw('nv'));
            }
        }
        $request->flash();
        // return $records;
        return view('pages.recieve-inventories.reports-monthly', compact('records', 'years', 'report', 'dropDownData'));
    }

    public function monthlyReportSupplier(Request $request)
    {
        $records = [];
        $years = $this->years;
        $report = 'Supplier';
        $dropDownData = Vendor::select('code', 'name1')->get();
        if ($request->filled('year')) {
            $fiscalStartDate = Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth();
            $fiscalEndDate = Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth();
            $supplierCodes = RecieveInventory::select('sc')
                ->where('vd', '>=', $fiscalStartDate)->where('vd', '<=', $fiscalEndDate)
                ->groupBy('sc')->get()->pluck('sc');
            $records = Vendor::whereIn('code', $supplierCodes)->when(($request->code != 'All'), function ($query) use ($request) {
                return $query->where('code', '=', $request->code);
            })->get();
            foreach ($records as $key => $record) {
                // Log::info($key);
                $monthlyData = DB::select("
                SELECT
                    CASE
                        WHEN MONTH(vd) = 1 THEN 'jan'
                        WHEN MONTH(vd) = 2 THEN 'feb'
                        WHEN MONTH(vd) = 3 THEN 'mar'
                        WHEN MONTH(vd) = 4 THEN 'apr'
                        WHEN MONTH(vd) = 5 THEN 'may'
                        WHEN MONTH(vd) = 6 THEN 'jun'
                        WHEN MONTH(vd) = 7 THEN 'jul'
                        WHEN MONTH(vd) = 8 THEN 'aug'
                        WHEN MONTH(vd) = 9 THEN 'sep'
                        WHEN MONTH(vd) = 10 THEN 'oct'
                        WHEN MONTH(vd) = 11 THEN 'nov'
                        WHEN MONTH(vd) = 12 THEN 'dec'
                    END AS month,
                    YEAR(vd) AS year,
                    SUM(nv) AS net_value
                FROM
                    invrec
                WHERE
                    sc = " . $record->code . "
                GROUP BY
                    YEAR(vd), MONTH(vd)
                ORDER BY
                    year, month
            ");
                foreach ($monthlyData as $key => $value) {
                    if ($value->year == $request->year) {
                        switch ($value->month) {
                            case 'jan':
                                $record['jan'] = $value->net_value;
                                break;
                            case 'feb':
                                $record['feb'] = $value->net_value;
                                break;
                            case 'mar':
                                $record['mar'] = $value->net_value;
                                break;
                            case 'apr':
                                $record['apr'] = $value->net_value;
                                break;
                            case 'may':
                                $record['may'] = $value->net_value;
                                break;
                            case 'jun':
                                $record['jun'] = $value->net_value;
                                break;
                        }
                    } else if ($value->year == ($request->year-1)){
                        switch ($value->month) {
                            case 'jul':
                                $record['jul'] = $value->net_value;
                                break;
                            case 'aug':
                                $record['aug'] = $value->net_value;
                                break;
                            case 'mar':
                                $record['mar'] = $value->net_value;
                                break;
                            case 'sep':
                                $record['sep'] = $value->net_value;
                                break;
                            case 'oct':
                                $record['oct'] = $value->net_value;
                                break;
                            case 'nov':
                                $record['nov'] = $value->net_value;
                                break;
                            case 'dec':
                                $record['dec'] = $value->net_value;
                                break;
                        }
                    }
                }
            }
        }
        // return $request->filled('year');
        // if ($request->filled('year')) {
        //     $date = Carbon::createFromDate(intval($request->year), 1, 1);
        //     $records = Vendor::all();
        //     foreach ($records as $key => $record) {
        //         Log::info($key);
        //         $record['jul']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['aug']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['sep']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['oct']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['nov']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['dec']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['jan']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['feb']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['mar']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['apr']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['may']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->endOfMonth())->sum(DB::raw('nv'));
        //         $record['jun']  = RecieveInventory::where('sc', $record->code)->where('vd', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->startOfMonth())->where('vd', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth())->sum(DB::raw('nv'));
        //     }
        // }
        $request->flash();
        // return $records;
        return view('pages.recieve-inventories.reports-monthly', compact('records', 'years', 'report', 'dropDownData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCode = RecieveInventory::orderBy('gn', 'DESC')->get()->first()->gn + 1;
        try {
            $currentSIN = RecieveInventory::orderBy('sin', 'DESC')->get()->first()->sin + 1;
        } catch (\Throwable $th) {
            $currentSIN = $currentCode;
        }
        $grn = RecieveInventory::count();
        $voucher = RecieveInventory::count();
        $vendors = Vendor::all();
        $products = Product::all();
        return view('pages.recieve-inventories.create', compact('products', 'vendors', 'currentCode', 'currentSIN'));
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
            'grn' => ['required', 'numeric'],
            'grn_date' => ['required', 'string'],
            'voucher_no' => ['required', 'numeric'],
            'voucher_date' => ['required', 'string'],
            'vendor_code' => 'required|numeric',
            'vendor_inv' => 'required|string',
            'vendor_inv_date' => 'required|string',
        ]);
        $products = $request->input('products');

        foreach ($products['code'] as $key => $product) {
            $inventory = new RecieveInventory();

            $inventory->vn = $request->input('voucher_no');
            $inventory->vd = date('Y-m-d', strtotime($request->input('voucher_date')));
            $inventory->gn = $request->input('grn');
            $inventory->gd = $request->input('grn_date');
            $inventory->sc = $request->input('vendor_code');
            $inventory->sin = $request->input('vendor_inv');
            $inventory->sid = $request->input('vendor_inv_date');
            $inventory->ic = $products['code'][$key];
            $inventory->qty = $products['qty'][$key];
            $inventory->rat = $products['l_rate'][$key];
            $inventory->ved = $products['value_excle_tax'][$key];
            $inventory->st = $products['sale_tax'][$key];
            $inventory->sed = $products['sed'][$key];
            $inventory->fed = $products['fed'][$key];
            $inventory->od = $products['other_deduction'][$key];
            $inventory->nv = $products['net_value'][$key];
            $inventory->trnln = $products['ttype'][$key];
            $inventory->remarks = $products['remarks'][$key];

            $inventory->save();
        }

        if (true) {
            return redirect()->route('recieve-inventories.index')->with(['success' => 'Reciept Successfully Saved.']);
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
        return view('pages.recieve-inventories.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($recieve_inventory)
    {
        $vendors = Vendor::all();
        $products = Product::all();
        return $inventory = RecieveInventory::where('id_col', $recieve_inventory)->get()->first();
        return view('pages.recieve-inventories.edit', compact('vendors', 'products', 'inventory'));
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
            'grn' => ['required', 'numeric'],
            'grn_date' => ['required', 'string'],
            'voucher_no' => ['required', 'numeric'],
            'voucher_date' => ['required', 'string'],
            'vendor_code' => 'required|numeric',
            'vendor_inv' => 'required|string',
            'vendor_inv_date' => 'required|string',
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
            return redirect()->route('recieve-inventories.index')->with(['success' => 'Unit Successfully Saved.']);
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
    public function destroy($recieve_inventory)
    {
        $inventory = RecieveInventory::where('id_col', $recieve_inventory)->get()->first();
        try {
            $inventory->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
