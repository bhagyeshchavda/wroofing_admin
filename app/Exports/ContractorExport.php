<?php
// File: app/Exports/UsersExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
use App\Models\User;

class ContractorExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $columns;
    protected $orderBy;

    public function __construct($columns, $orderBy = null)
    {
        $this->columns = $columns;
        $this->orderBy = $orderBy;
    }

    public function collection()
    {
        $query = DB::table('contractors')
        ->select($this->columns)->where('status', 'Active')
        ->where('email_verified_at', '!=', null);
        if ($this->orderBy) {
            $query->orderBy($this->orderBy[0], $this->orderBy[1]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return $this->columns;
    }
}

