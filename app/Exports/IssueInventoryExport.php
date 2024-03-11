<?php

namespace App\Exports;

use App\Models\IssueInventory;
use Maatwebsite\Excel\Concerns\FromCollection;

class IssueInventoryExport implements FromCollection
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
        return IssueInventory::when(isset($data['startDate']), function ($query) use ($data) {
            return $query->where('isdt', '>=', $data['startDate']);
        })
        ->when(isset($data['endDate']), function ($query) use ($data) {
            return $query->where('isdt', '<=', $data['endDate']);
        })->when(isset($data['code']), function ($query) use ($data) {
            return $query->where('ic', '=', $data['code']);
        })->get();
    }
}
