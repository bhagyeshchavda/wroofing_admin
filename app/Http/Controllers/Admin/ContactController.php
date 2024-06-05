<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use App\Models\MailSetting;
use Symfony\Component\Mime\Part\HtmlPart;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contactList = Contact::select(
                'id',
                'email',
                'name',
                'phoneno',
                'address',
                'yourcomments',
                DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y") as display_created_at'),
            );
            return DataTables::of($contactList)->make(true);
        }
        $contactList = array(
            'title' => 'Contacts',
            'name' => 'contacts',
            'add_route' => 'post-type.contacts',
            'list_route' => 'admin.contacts',
        );
        return view('admin.contacts.index', array('contactList' => $contactList));
    }
    private function renderTemplate($data, $mailTemplate)
    {
        foreach ($data as $key => $value) {
            $mailTemplate = str_replace('{' . $key . '}', $value, $mailTemplate);
        }
        return $mailTemplate;
    }

    public function bulkActionContact(Request $request)
    {
        $id = $request->ids;
        $action = $request->action;

        try {
            if (!empty($action) && $action === 'delete') {
                Contact::whereIn('id', $id)->delete();
                return $response = [
                    'status' => true,
                    'data' => array(
                        'status' => true,
                        'redirect' => '',
                        'message' => 'Contact deleted successfully.',
                    ),
                ];
            } else {
                Contact::whereIn('id', $id)->update(['status' => $action]);
                return $response = [
                    'status' => true,
                    'data' => array(
                        'status' => true,
                        'redirect' => '',
                        'message' => 'Contact status update successfully.',
                    ),
                ];
            }
        } catch (\Exception $ex) {
            return response()->json([
                'success' => true,
                'message' => 'Something is wrong, Please ask devlopment team.',
            ], 200);
        }
    }

    public function destroy(int $id)
    {
        try {
            Contact::destroy($id);
            return response()->json([
                'success' => true,
                'icon' => 'delete',
                'type' => 'danger',
                'message' => 'Contact deleted successfully.',
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => true,
                'message' => $ex->getMessage(),
            ], 200);
        }
    }
}