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
        return IssueInventory::select('oldissue.*')
        ->when(isset($data['startDate']), function ($query) use ($data) {
            return $query->where('isdt', '>=', $data['startDate']);
        })->when(isset($data['endDate']), function ($query) use ($data) {
            return $query->where('isdt', '<=', $data['endDate']);
        })->when(isset($data['code']) && ($data['code'] != 'All'), function ($query) use ($data) {
            return $query->where('ic', '=', $data['code']);
        })->when(isset($data['saerch_keyword']), function ($query) use ($data) {
            return $query->where('icitem.name1', 'like', '%' . $data['saerch_keyword'] . '%');
        })->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
        ->get();
    }
}
