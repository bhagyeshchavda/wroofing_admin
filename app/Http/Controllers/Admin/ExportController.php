<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\ContractorExport;


class ExportController extends Controller
{
    public function customerExportExcel()
    {
        // Specify the columns you want to export
        $columns = ['id', 'name', 'email', 'contact_number', 'address', 'zip_code', 'created_at'];
        // Specify the order by column and direction
        $orderBy = ['created_at', 'desc'];
        // Pass the columns to the UsersExport class
        return Excel::download(new UsersExport($columns, $orderBy), 'customer-list.xlsx');
    }
    
    public function contractorExportExcel()
    {
        // Specify the columns you want to export
        $columns = ['id', 'name', 'email', 'contact_number', 'company_name', 'address', 'zip_code', 'created_at'];
        // Specify the order by column and direction
        $orderBy = ['created_at', 'desc'];
        // Pass the columns to the ContractorExport class
        return Excel::download(new ContractorExport($columns, $orderBy), 'contractor-list.xlsx');
    }
}
