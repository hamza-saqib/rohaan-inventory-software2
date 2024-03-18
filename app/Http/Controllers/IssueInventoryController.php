<?php

namespace App\Http\Controllers;

use App\Models\IssueInventory;
use App\Models\Location;
use App\Models\Product;
use App\Exports\IssueInventoryExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        if ($request->filled('button') && ($request->input('button') == 'export')) {
            return Excel::download(new IssueInventoryExport([
                'startDate' => $request->start_date, 'endDate' => $request->end_date, 'code' => $request->product_code
            ]), 'issue inventory data.xls', \Maatwebsite\Excel\Excel::XLS);
        }
        $products = Product::all();
        $inventories = IssueInventory::select('oldissue.*', 'icitem.name1 as product')
            ->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('isdt', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                return $query->where('isdt', '<=', $request->end_date);
            })->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('isdt', '>=', $request->start_date);
            })->when(($request->product_code != 'All'), function ($query) use ($request) {
                return $query->where('ic', '=', $request->product_code);
            })->when($request->filled('saerch_keyword'), function ($query) use ($request) {
                return $query->where('icitem.name1', 'like', '%' . $request->product_code . '%');
            })->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
            // ->leftJoin('supplierrec', 'supplierrec.code', '=', 'oldissue.sc')
            ->paginate(50);

        $request->flash();
        return view('pages.issue-inventories.index', compact('inventories', 'products'));
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
            $productCodes = IssueInventory::select('ic')
                ->where('isdt', '>=', $fiscalStartDate)->where('isdt', '<=', $fiscalEndDate)
                ->groupBy('ic')->get()->pluck('ic');
            $records = Product::whereIn('code', $productCodes)->when(($request->code != 'All'), function ($query) use ($request) {
                return $query->where('code', '=', $request->code);
            })->get();
            foreach ($records as $key => $record) {
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
        $inventories = IssueInventory::select(
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
            return redirect()->route('issue-inventories.index')->with(['success' => 'Inventory Successfully Issued.']);
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
    public function edit($issue_inventory)
    {
        $locations = Location::all();
        $products = Product::all();
        $inventory = IssueInventory::where('id_col', $issue_inventory)->get()->first();
        return view('pages.issue-inventories.edit', compact('locations', 'products', 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $issue_inventory)
    {
        // $this->validate($request, [
        //     'code' => ['required', 'numeric', Rule::unique('supplierrec', 'code')->ignore($inventory->code, 'code')],
        //     'description' => ['required', 'string'],
        //     'uom' => ['required', 'string'],
        //     'category' => ['required', 'string'],
        //     'misc_code' => 'nullable|string|max:15',
        //     'remarks' => 'nullable|string|max:100',
        // ]);
        // return $request->all();
        $inventory = IssueInventory::where('id_col', $issue_inventory)->get()->first();
        $inventory->isdt = $request->input('issue_date');
        if ($request->filled('product_code')) {
            $inventory->ic = $request->input('product_code');
        }
        $inventory->Qty = $request->input('qty');
        $inventory->Irate = $request->input('wgt_avg_rate');
        $inventory->Iamt = $request->input('qty') * $request->input('wgt_avg_rate');
        $location = Location::where('code1', $request->input('location_code'))->get()->first();
        $inventory->dpt = $location->name1;
        $inventory->remarks = $request->input('remarks');

        if ($inventory->save()) {
            return redirect()->route('issue-inventories.index')->with(['success' => 'Issue Inventory Updated Successfully Saved.']);
        } else {
            return redirect()->back()->with(['error' => 'Error while saving Issue Inventory.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($issue_inventory)
    {
        $inventory = IssueInventory::where('id_col', $issue_inventory)->get()->first();
        try {
            $inventory->delete();
            return response()->json(['success' => 'Record deleted successfully !']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Record not found !']);
        }
    }
}
