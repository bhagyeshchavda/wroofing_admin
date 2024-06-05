<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Libraries\Constant;
use App\Libraries\CustomErrorHandler;
use App\Models\User;
use App\Models\WSErrorHandler;
use DataTables;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Validator; // Add this line

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* Admin Side User Listing Page */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userList = User::select(
                'id',
                'name',
                'email',
                'role',
                'status',
                'profile_image',
                DB::RAW('DATE_FORMAT(created_at, "%d/%m/%Y") as display_created_at'),
                'created_at'
            )
            ->where('role', '=', 'admin') // Corrected here
            ->where('id', '!=', Auth::id());

            return Datatables::of($userList)->make(true);
        }
        return view('admin.user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $retData = array(
            'userTypeList' => Constant::getUserType(),
            'userMenuList' => Constant::getMenuList(),
        );
        return view('admin.user.add', $retData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $requestData = $request->all();
            // Check if the 'thumbnail' key exists and is not empty
            if (isset($requestData['thumbnail']) && $requestData['thumbnail']) {
                $requestData['profile_image'] = $requestData['thumbnail'];
            } else {
                $requestData['profile_image'] = null; // or set it to a default value if you have one
            }
            $requestData = array(
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'password' => $requestData['password'], // Ensure password is hashed
                'email_verified_at' => now(),
                'status' => 'Active',
                'contact_number' => '0000000000',
                'zip_code' => '000000',
                'role' => $requestData['user_type'],
                'profile_image' => $requestData['profile_image'],
            );

            // Validate requestData before creating user
            $validator = Validator::make($requestData, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|string',
                'profile_image' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $userObj = User::create($requestData);
            return redirect(route('user.index'))->with('success', 'Admin Added Successfully.');
        } catch (\Exception $e) {
            CustomErrorHandler::APIServiceLog($e, "UserController: store");
            return back()->with('error', 'Something Went Wrong: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $retData = array(
            'data' => $user,
            'userTypeList' => Constant::getUserType(),
        );
        return view('admin.user.add', $retData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $requestData = $request->all();
            if (isset($requestData['thumbnail']) && $requestData['thumbnail']) {
                $requestData['profile_image'] = $requestData['thumbnail'];
            } else {
                $requestData['profile_image'] = '';
            }
            $userObj = User::findOrFail($requestData['id']);
            $userObj->update($requestData);
            return redirect(route('user.index'))->with('success', 'User Updated Successfully.');
        } catch (\Exception $e) {
            // CustomErrorHandler::APIServiceLog($e, "UserController: update");
            return back()->with('error', 'Something Went Wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Admin deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            // CustomErrorHandler::APIServiceLog($e, "UserController: destroy");
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong.',
            ], 200);
        }
    }

    /**
     * Display User Image from storage.
     *
     * @param  use File $filename
     * @return \Illuminate\Http\Response
     */
    public function displayUserImage($filename)
    {
        $path = storage_path('app/public/user_images/' . $filename);
        if (!File::exists($path)) {
            //admin-panel/img
            $path = public_path('admin-panel/img/avatar5.png');
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    /**
     * Active\Inactive User status.
     *
     * @param  use File $filename
     * @return \Illuminate\Http\Response
     */
    public function ActiveDeactiveStatus(Request $request)
    {
        $requestData = $request->all();
        try {
            $userObj = User::findOrFail($requestData['id']);
            if ($userObj->status == 'Active') {
                $project = User::updateOrCreate(
                    ['id' => $requestData['id']],
                    ['status' => 'Inactive']
                );
            }
            if ($userObj->status == 'Inactive') {
                $project = User::updateOrCreate(
                    ['id' => $requestData['id']],
                    ['status' => 'Active']
                );
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Status Update successfully.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            //CustomErrorHandler::APIServiceLog($e, "UserController: ActiveDeactiveStatus");
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong.',
            ], 200);
        }
    }

    // Error Logs
    public static function getErrorLogs()
    {
        $query = WSErrorHandler::SELECT(
            'error_handler.*',
        );
        $query = $query->ORDERBY('error_handler.created_at', 'DESC');
        return \View::make('admin.common.errorlogs', array());
    }
}
