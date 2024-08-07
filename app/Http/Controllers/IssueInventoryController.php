<?php

namespace App\Http\Controllers;

use App\Models\IssueInventory;
use App\Models\Location;
use App\Models\Product;
use App\Exports\IssueInventoryExport;
use App\Models\ProductCategory;
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
    // public function index(Request $request)
    // {
    //     // return $request->all();
    //     if ($request->filled('button') && ($request->input('button') == 'export')) {
    //         set_time_limit(3000); //3000 seconds = 50 minutes
    //         ini_set('memory_limit', -1);
    //         return Excel::download(new IssueInventoryExport([
    //             'startDate' => $request->start_date, 'endDate' => $request->end_date, 'code' => $request->product_code,
    //             'saerch_keyword' => $request->saerch_keyword
    //         ]), 'issue inventory data.xls', \Maatwebsite\Excel\Excel::XLS);
    //     }
    //     $products = Product::all();

    //     $inventories = IssueInventory::select('oldissue.*', 'icitem.name1 as product')
    //         ->when($request->filled('start_date'), function ($query) use ($request) {
    //             return $query->where('isdt', '>=', $request->start_date);
    //         })
    //         ->when($request->filled('end_date'), function ($query) use ($request) {
    //             return $query->where('isdt', '<=', $request->end_date);
    //         })->when($request->filled('start_date'), function ($query) use ($request) {
    //             return $query->where('isdt', '>=', $request->start_date);
    //         })->when($request->filled('product_code') && ($request->product_code != 'All'), function ($query) use ($request) {
    //             return $query->where('ic', '=', $request->product_code);
    //         })->when($request->filled('saerch_keyword'), function ($query) use ($request) {
    //             return $query->where('icitem.name1', 'like', '%' . $request->saerch_keyword . '%');
    //         })->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
    //         ->orderBy('isdt', 'asc')
    //         ->orderByRaw('CAST(isno AS BIGINT) ASC')
    //         ->paginate(50);


    //     $request->flash();
    //     return view('pages.issue-inventories.index', compact('inventories', 'products'));
    // }

    public function index(Request $request)
{
    // return $request->all();
    if ($request->filled('button') && ($request->input('button') == 'export')) {
        set_time_limit(3000); //3000 seconds = 50 minutes
        ini_set('memory_limit', -1);
        return Excel::download(new IssueInventoryExport([
            'startDate' => $request->start_date, 'endDate' => $request->end_date, 'code' => $request->product_code,
            'saerch_keyword' => $request->saerch_keyword
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
        })->when($request->filled('product_code') && ($request->product_code != 'All'), function ($query) use ($request) {
            return $query->where('ic', '=', $request->product_code);
        })->when($request->filled('saerch_keyword'), function ($query) use ($request) {
            return $query->where('icitem.name1', 'like', '%' . $request->saerch_keyword . '%');
        })->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
        ->orderBy('isdt', 'asc') // Order by isdt in ascending order
        ->orderByRaw('CAST(isno AS BIGINT) ASC') // Then order by isno in ascending order
        ->paginate(50);

    $request->flash();
    return view('pages.issue-inventories.index', compact('inventories', 'products'));
}

    // public function monthlyReportProduct(Request $request)
    // {
    //     if ($request->has('_token')) {
    //         $this->validate($request, [
    //             'year' => ['required']
    //         ]);
    //     }
    //     $records = [];
    //     $years = $this->years;
    //     $report = 'Item';
    //     $dropDownData = Product::select('code', 'name1')->get();

    //     if ($request->filled('year')) {
    //         $fiscalStartDate = Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth();
    //         $fiscalEndDate = Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth();
    //         $productCodes = IssueInventory::select('ic')
    //             ->where('isdt', '>=', $fiscalStartDate)->where('isdt', '<=', $fiscalEndDate)
    //             ->groupBy('ic')->get()->pluck('ic');
    //         $records = Product::whereIn('code', $productCodes)->when(($request->code != 'All'), function ($query) use ($request) {
    //             return $query->where('code', '=', $request->code);
    //         })->get();
    //         foreach ($records as $key => $record) {
    //             $record['jul']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['aug']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(5)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['sep']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(4)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['oct']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(3)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['nov']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(2)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['dec']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(1)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['jan']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['feb']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(1)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['mar']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(2)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['apr']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(3)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['may']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(4)->endOfMonth())->sum(DB::raw('Iamt'));
    //             $record['jun']  = IssueInventory::where('ic', $record->code)->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->startOfMonth())->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth())->sum(DB::raw('Iamt'));
    //         }
    //     }
    //     $request->flash();
    //     $startYear = $request->year - 1;
    //     $endYear = $request->year ;
    //     // return $records;
    //     return view('pages.issue-inventories.reports-monthly', compact('records', 'years', 'report', 'dropDownData', 'startYear', 'endYear'));
    // }

    public function monthlyReportProduct(Request $request)
    {
        if ($request->has('_token')) {
            $this->validate($request, [
                'year' => ['required']
            ]);
        }

        $records = [];
        $years = $this->years;
        $report = 'Item';
        $dropDownData = Product::select('code', 'name1')->get();

        if ($request->filled('year')) {
            $fiscalStartDate = Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth();
            $fiscalEndDate = Carbon::createFromDate(intval($request->year), 1, 1)->addMonths(5)->endOfMonth();
            $productCodes = IssueInventory::select('ic')
                ->where('isdt', '>=', $fiscalStartDate)
                ->where('isdt', '<=', $fiscalEndDate)
                ->groupBy('ic')->get()->pluck('ic');
            $records = Product::whereIn('code', $productCodes)
                ->when(($request->code != 'All'), function ($query) use ($request) {
                    return $query->where('code', '=', $request->code);
                })->get();
            foreach ($records as $key => $record) {
                $record['jul'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['jul_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 1, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');
                $record['aug'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 2, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 2, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['aug_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 2, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 2, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');
                $record['sep'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 3, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 3, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['sep_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 3, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 3, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['oct'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 4, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 4, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['oct_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 4, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 4, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['nov'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 5, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 5, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['nov_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 5, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 5, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['dec'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 6, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 6, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['dec_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 6, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 6, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['jan'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 7, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 7, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['jan_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 7, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 7, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['feb'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 8, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 8, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['feb_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 8, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 8, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['mar'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 9, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 9, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['mar_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 9, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 9, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['apr'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 10, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 10, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['apr_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 10, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 10, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['may'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 11, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 11, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['may_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 11, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 11, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');

                $record['jun'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 12, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 12, 1)->subMonths(6)->endOfMonth())
                    ->sum('Iamt');
                $record['jun_qty'] = IssueInventory::where('ic', $record->code)
                    ->where('isdt', '>=', Carbon::createFromDate(intval($request->year), 12, 1)->subMonths(6)->startOfMonth())
                    ->where('isdt', '<=', Carbon::createFromDate(intval($request->year), 12, 1)->subMonths(6)->endOfMonth())
                    ->sum('Qty');


                // Calculate total
                $record['total'] = $record->jul + $record->aug + $record->sep + $record->oct + $record->nov + $record->dec + $record->jan + $record->feb + $record->mar + $record->apr + $record->may + $record->jun;
            }
        }

        $request->flash();
        $startYear = $request->year - 1;
        $endYear = $request->year;

        return view('pages.issue-inventories.reports-monthly', compact('records', 'years', 'report', 'dropDownData', 'startYear', 'endYear'));
    }



    // public function categoryWiseReprt(Request $request)
    // {
    //     $categories = ProductCategory::all();
    //     $totalValue = 0; // Initialize total value variable
    //     // Fetch records
    //     $records = [];
    //     if ($request->filled('category_code')) {
    //         $records = IssueInventory::select('oldissue.*', 'icitem.name1 as product')
    //             ->when($request->filled('start_date'), function ($query) use ($request) {
    //                 return $query->where('isdt', '>=', $request->start_date);
    //             })
    //             ->when($request->filled('end_date'), function ($query) use ($request) {
    //                 return $query->where('isdt', '<=', $request->end_date);
    //             })->when($request->filled('start_date'), function ($query) use ($request) {
    //                 return $query->where('isdt', '>=', $request->start_date);
    //             })->when($request->filled('category_code') && ($request->category_code != 'All'), function ($query) use ($request) {
    //                 return $query->where('icitem.catcode', '=', $request->category_code);
    //             })->when($request->filled('saerch_keyword'), function ($query) use ($request) {
    //                 return $query->where('icitem.name1', 'like', '%' . $request->saerch_keyword . '%');
    //             })->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
    //             ->get();

    //         // Calculate total value
    //         foreach ($records as $record) {
    //             $totalValue += $record->Irate * $record->Qty;
    //         }
    //     }
    //     return view('pages.issue-inventories.category-wise-report', compact('categories', 'records', 'totalValue'));
    // }


    public function categoryWiseReprt(Request $request)
    {
        $categories = ProductCategory::all();
        $selectedCategory = $request->input('category_code');
        $sDate = $request->input('start_date');
        $eDate = $request->input('end_date');
        $totalValue = 0; // Initialize total value variable
        // Fetch records
        $records = [];
        if ($request->filled('category_code')) {
            $records = IssueInventory::select('oldissue.*', 'icitem.name1 as product')
                ->when($request->filled('start_date'), function ($query) use ($request) {
                    return $query->where('isdt', '>=', $request->start_date);
                })
                ->when($request->filled('end_date'), function ($query) use ($request) {
                    return $query->where('isdt', '<=', $request->end_date);
                })->when($request->filled('start_date'), function ($query) use ($request) {
                    return $query->where('isdt', '>=', $request->start_date);
                })->when($request->filled('category_code') && ($request->category_code != 'All'), function ($query) use ($request) {
                    return $query->where('icitem.catcode', '=', $request->category_code);
                })->when($request->filled('saerch_keyword'), function ($query) use ($request) {
                    return $query->where('icitem.name1', 'like', '%' . $request->saerch_keyword . '%');
                })->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
                ->get();

            // Calculate total value
            foreach ($records as $record) {
                $totalValue += $record->Irate * $record->Qty;
            }
        }
        $selectedCategoryName = ProductCategory::where('code', $selectedCategory)->value('name1');

        return view('pages.issue-inventories.category-wise-report', compact('categories', 'records', 'totalValue', 'selectedCategory', 'selectedCategoryName', 'sDate', 'eDate'));
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
        $products = Product::select(
            'icitem.code',
            'icitem.name1',
            DB::raw('SUM(oldissue.Qty) as qtyOut'),
            DB::raw('SUM(invrec.qty) as qtyIn')
        )
            ->leftJoin('oldissue', 'oldissue.ic', '=', 'icitem.code')
            ->leftJoin('invrec', 'invrec.ic', '=', 'icitem.code')
            ->groupBy('icitem.code', 'icitem.name1')
            ->get();
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
            $location = Location::where('code1', $products['locationCode'][$key])->get()->first();
            $inventory->isno = $request->input('issue_no');
            $inventory->isdt = date('Y-m-d', strtotime($request->input('issue_date')));
            $inventory->ic = $products['code'][$key];
            $inventory->Qty = $products['qty'][$key];
            $inventory->Irate = $products['wgt_avg_rate'][$key];
            $inventory->dpt = $location->name1; //$products['location'][$key];
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
        $products = Product::select(
            'icitem.code',
            'icitem.name1',
            DB::raw('SUM(oldissue.Qty) as qtyOut'),
            DB::raw('SUM(invrec.qty) as qtyIn')
        )
            ->leftJoin('oldissue', 'oldissue.ic', '=', 'icitem.code')
            ->leftJoin('invrec', 'invrec.ic', '=', 'icitem.code')
            ->groupBy('icitem.code', 'icitem.name1')
            ->get();
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
