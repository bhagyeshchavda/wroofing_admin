<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;


class FontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Check if a user is authenticated
        if (Auth::check()) {
            // The user is logged in
            return view('admin.dashboard');
        } else {
            // No user is logged in
            return view('auth.login');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $contractorCount = DB::table('contractors')
            ->where('email_verified_at', '!=', null)
            ->where('status', '=', 'Active')
            ->count();

        $customerCount = User::where('id', '!=', Auth::id())
            ->where('role', '=', 'user')
            ->where('email_verified_at', '!=', null)
            ->where('status', '=', 'Active')
            ->count();

        $contactCount = Contact::all()->count();

        $userData = [
            "userCount" => $customerCount,
            "contactCount" => $contactCount,
            "contractorCount" => $contractorCount,
        ];
        return view('admin.dashboard', compact('userData'));
    }
}
