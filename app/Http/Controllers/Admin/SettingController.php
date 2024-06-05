<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostMetas;
use App\Models\User;
use DataTables;
use DB;
use App\Models\SeoMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Settings;
use App\Http\Requests\StoreGeneralSettings;
use Session;

class SettingController extends Controller {
    public function index() {
        $settings = Settings::all();
        $dataArr  = [];
        if(!empty($settings)){
            $settings = $settings->toArray();
            if(!empty($settings)){
                foreach($settings as $settingsVal){
                    $dataArr = json_decode($settingsVal['value'], true);
                }
            }
        }        
        return view('admin.setting.index', array('data' => $dataArr));
    }
    public function updateSettings(StoreGeneralSettings $request) {
        parse_str($request->formData, $searcharray);
        $data = array(
            "gs_ficon"          => $searcharray['gs_ficon'],
            "gs_sidebaricon"    => $searcharray['gs_sidebaricon'],
            "gs_adminlogo"      => $searcharray['gs_adminlogo'],
            "gs_sitetitle"      => $searcharray['gs_sitetitle'],
        );
        $generalSettingData =  json_encode($data);
        
        $generalSetting = Settings::updateOrCreate(
            ['name'     =>  'general_setting'],
            ['value'    =>  $generalSettingData],
        );
        return response()->json(['status' => 1, 'msg' => 'Setting updated successfuly.']);
    }
}
