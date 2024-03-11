<?php

namespace App\Exports;

use App\Models\RecieveInventory;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecieveInventoryExport implements FromCollection
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
        return RecieveInventory::when(isset($data['startDate']), function ($query) use ($data) {
            return $query->where('vd', '>=', $data['startDate']);
        })
        ->when(isset($data['endDate']), function ($query) use ($data) {
            return $query->where('vd', '<=', $data['endDate']);
        })->when(isset($data['productCode']), function ($query) use ($data) {
            return $query->where('ic', '=', $data['productCode']);
        })->when(isset($data['vendorCode']), function ($query) use ($data) {
            return $query->where('sc', '=', $data['vendorCode']);
        })->get();
    }
}
