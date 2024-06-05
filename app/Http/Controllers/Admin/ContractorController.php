<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Auth;

class ContractorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    /* Admin Side Customer Listing Page */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userList = DB::table('contractors')
            ->select(
                'id',
                'name',
                'email',
                'role',
                'contact_number',
                'zip_code',
                'company_name',
                'address',
                'status',
                'profile_image',
                DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y") as display_created_at'),
                'created_at'
            )
            ->where('email_verified_at', '!=', null)
            ->where('status', 'Active')
            ->get();
            return Datatables::of($userList)->make(true);
        }
        return view('admin.contractor.list');
    }
}