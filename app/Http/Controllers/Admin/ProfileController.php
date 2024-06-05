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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Redirect;

class ProfileController extends Controller
{
    function index()
    {
        $pageDetails['title'] = 'Profile';
        return view('admin.profile.index', array('pageDetails' => $pageDetails));
    }


    function updateInfo(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if (!$query) {
                return response()->json(['status' => 0, 'success' => 'Something went wrong.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile info has been update successfuly.']);
            }
        }
    }

    function changePassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make(
            $request->all(),
            [
                'oldpassword' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!\Hash::check($value, Auth::user()->password)) {
                            return $fail(__('The current password is incorrect'));
                        }
                    },
                    'min:8',
                    'max:30',
                ],
                'newpassword' => 'required|min:8|max:30',
                'cnewpassword' => 'required|same:newpassword',
            ],
            [
                'oldpassword.required' => 'Enter your current password',
                'oldpassword.min' => 'Old password must have atleast 8 characters',
                'oldpassword.max' => 'Old password must not be greater than 30 characters',
                'newpassword.required' => 'Enter new password',
                'newpassword.min' => 'New password must have atleast 8 characters',
                'newpassword.max' => 'New password must not be greater than 30 characters',
                'cnewpassword.required' => 'ReEnter your new password',
                'cnewpassword.same' => 'New password and Confirm new password must match',
            ],
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $update = User::find(Auth::user()->id)->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }

    public function update_avatar(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required',
        ]);

        $avatarName = $request->profile_picture;
        $user = Auth::user();
        $user->profile_image = $avatarName;
        $user->save();
        return back()->with('success', 'You have successfully upload image.');
    }
}