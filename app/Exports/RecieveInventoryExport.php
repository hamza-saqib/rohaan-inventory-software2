<?php

namespace App\Exports;

use App\Models\RecieveInventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecieveInventoryExport implements FromCollection, WithHeadings
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->data;
        return RecieveInventory::select('icitem.name1', 'supplierrec.name1', 'invrec.sin', 'invrec.gn', 'invrec.gd',
        'invrec.vn', 'invrec.vd', 'invrec.qty', 'invrec.rat', 'invrec.sed', 'invrec.fed', 'invrec.od',
         'invrec.st', 'invrec.nv', 'invrec.remarks')
        ->when(isset($data['startDate']), function ($query) use ($data) {
            return $query->where('vd', '>=', $data['startDate']);
        })
        ->when(isset($data['endDate']), function ($query) use ($data) {
            return $query->where('vd', '<=', $data['endDate']);
        })->when(isset($data['productCode']) && ($data['productCode'] != 'All'), function ($query) use ($data) {
            return $query->where('ic', '=', $data['productCode']);
        })->when(isset($data['vendorCode']) && ($data['vendorCode'] != 'All'), function ($query) use ($data) {
            return $query->where('sc', '=', $data['vendorCode']);
        })->when(isset($data['saerch_keyword']), function ($query) use ($data) {
            return $query->where('supplierrec.name1', 'like', '%' . $data['saerch_keyword'] . '%')
                ->orWhere('icitem.name1', 'like', '%' . $data['saerch_keyword'] . '%')
                ->orWhere('remarks', 'like', '%' . $data['saerch_keyword'] . '%');
        })->leftJoin('icitem', 'icitem.code', '=', 'invrec.ic')
        ->leftJoin('supplierrec', 'supplierrec.code', '=', 'invrec.sc')->get();
    }

    public function headings(): array
    {
        return ["Item Description", "Supllier", "Supllier Inv.", "GRN", "GRN Date", "Voucher No.", "Voucher Date",
        "Qty", "Rate", "SED", "FED", "Deduction", "Sales Tax", "Net Value", "Remarks"];
    }
}
