<?php

namespace App\Exports;

use App\Models\IssueInventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IssueInventoryExport implements FromCollection, WithHeadings
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
        return IssueInventory::select('oldissue.isno', 'oldissue.isdt', 'oldissue.dpt', 'icitem.name1', 'oldissue.Qty', 'oldissue.Irate', 'oldissue.Iamt', 'oldissue.remarks')
            ->when(isset($data['startDate']), function ($query) use ($data) {
                return $query->where('isdt', '>=', $data['startDate']);
            })
            ->when(isset($data['endDate']), function ($query) use ($data) {
                return $query->where('isdt', '<=', $data['endDate']);
            })
            ->when(isset($data['code']) && ($data['code'] != 'All'), function ($query) use ($data) {
                return $query->where('ic', '=', $data['code']);
            })
            ->when(isset($data['saerch_keyword']), function ($query) use ($data) {
                return $query->where('icitem.name1', 'like', '%' . $data['saerch_keyword'] . '%');
            })
            ->leftJoin('icitem', 'icitem.code', '=', 'oldissue.ic')
            ->orderBy('isdt', 'asc') // Order by isdt in ascending order
            ->orderByRaw('CAST(isno AS BIGINT) ASC') // Then order by isno in ascending order
            ->get();
    }

    public function headings(): array
    {
        return ["Issue No", "Issue Date", "Location", "Item", "Qty", "Rate", "Value", "Remarks"];
    }
}
