<?php
use App\Models\Post;
use App\Models\PostMetas;
use App\Models\MediaFile;
use App\Models\MediaFolder;
use App\Models\Settings;
use App\Models\Comment;
use App\Models\Module;

function seo_string($string, $chars = 70)
{
    $string = strip_tags($string);
    $string = str_replace(["\n", "\t"], ' ', $string);
    $string = html_entity_decode($string, ENT_HTML5);
    return sub_char($string, $chars);
}
function sub_char($str, $n, $end = '...')
{
    if (strlen($str) < $n) {
        return $str;
    }
    $html = mb_substr($str, 0, $n);
    $html = mb_substr($html, 0, mb_strrpos($html, ' '));
    return $html . $end;
}
function slugify($slug)
{
    // replace non letter or digits by -
    $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
    // transliterate
    if (function_exists('iconv')) {
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
    }
    // remove unwanted characters
    $slug = preg_replace('~[^-\w]+~', '', $slug);
    // trim
    $slug = trim($slug, '-');
    // remove duplicate -
    // $slug = preg_replace('~-+~', '-', $slug);
    // lowercase
    $slug = strtolower($slug);
    if (empty($slug)) {
        return 'n-a';
    }
    return $slug;
}
function imageUpload($image)
{
    $path = date('Y') . '/' . date('m');
    $destinationPath = 'public/uploads/' . $path;
    $imageFullName = $image->getClientOriginalName();
    $splitImage = explode('.', $imageFullName);
    $splitName = $splitImage[0];
    $splitExt = $splitImage[1];
    $slug = $splitName;
    $slugCount = 0;
    do {
        if ($slugCount == 0) {
            $currentSlug = slugify($slug);
        } else {
            $currentSlug = slugify($slug . '-' . $slugCount);
        }
        $checkImagePath = $destinationPath . '/' . $currentSlug . '.' . $splitExt;
        if (file_exists($checkImagePath)) {
            $slugCount++;
        } else {
            $slug = $currentSlug;
            $slugCount = 0;
        }
    } while ($slugCount > 0);
    $finalImage = $slug . '.' . $splitExt;
    $moveImage = $finalImage;
    //Insert image path
    $image->move($destinationPath, $moveImage);
    $finalImagePath = $destinationPath . '/' . $finalImage;
    return $finalImagePath;
}
if (!function_exists('adLte_date_format')) {
    /**
     * Format date to global format cms
     *
     * @param string $date
     * @param int $format // JW_DATE || JW_DATE_TIME
     * @return string
     */
    function adLte_date_format(mixed $date, int $format = 2): string
    {
        if ($date instanceof Carbon) {
            $date = $date->format('Y-m-d H:i:s');
        }
        $dateFormat = 'F j, Y';
        if ($dateFormat == 'custom') {
            $dateFormat = 'F j, Y';
        }
        if ($format == 1) {
            return date($dateFormat, $date);
        }
        $timeFormat = 'g:i a';
        if ($timeFormat == 'custom') {
            $timeFormat = 'g:i a';
        }
        return date($dateFormat . ' ' . $timeFormat, strtotime($date));
    }
}
function format_size_units($bytes, $decimals = 2): string
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, $decimals) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, $decimals) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, $decimals) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}
// breadcrumb details
function getBreadcrumbItems($folder_id = null){
    $folderBreadcrumb =  MediaFolder::where('id', '=', $folder_id)
    ->get();
    $resultLI = null;
    foreach($folderBreadcrumb as $resultDataVal){
        if($resultDataVal->folder_id != null){
            $resultData = getBreadcrumbItems($resultDataVal->folder_id);
            $resultLI .= $resultData;                        
        }
        $resultLI .= '<li class="breadcrumb-item active"><a href="'.env('APP_URL').'/admin/media/folder/'.$resultDataVal->id.'">'.strtoupper($resultDataVal->name).'</a></li>';
    }
    return $resultLI;
}
function getWorkingDirItems($folder_id = null){
    $folderBreadcrumb =  MediaFolder::where('id', '=', $folder_id)
    ->get();
    $resultLI = null;
    foreach($folderBreadcrumb as $resultDataVal){
        if($resultDataVal->folder_id != null){
            $resultData = getWorkingDirItems($resultDataVal->folder_id);
            $resultLI .= $resultData;                        
        }
        $resultLI .= '/'.$resultDataVal->name;
    }
    return $resultLI;
}
function handleShortcodes($shortcodes){
	$moduleID   = preg_replace("/\[.*?id=(\d+)\]/", "$1", $shortcodes );
	$moduleList =  DB::table('modules AS m')
    ->where('m.id', '=', $moduleID)
    ->get();
    $moduleData = array();
    if(!$moduleList->isEmpty()){
        return $moduleData = array(
            'status' => true,
            'data'   => $moduleList,
        );
    }else{
        return $moduleData = array(
            'status' => false,
            'data'   => $shortcodes,
        );
    }
}

/* GET GENERAL SETTING */
function get_general_settings(){
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
    return $dataArr;
}
/* start get edit url by id */
function get_edit_url_by_ID($id){
    $pageList = Post::where('id', '=', $id)
    ->where('status', '=', 'publish')
    ->get() 
    ->toArray();
    if(!empty($pageList)){
        if(isset($pageList[0])){
            $postType = $pageList[0]['type'];
            $homeURL  = route('home');
            if($postType == 'posts'){
                echo '<li id="wp-admin-bar-edit"><a class="ab-item" href="'.$homeURL.'/admin/post-type/'.$postType.'/'.$id.'/edit"> <img class="editpage" src="'.asset('edit-page.png').'">Edit Post</a></li>';
            }elseif($postType == 'pages'){
                echo '<li id="wp-admin-bar-edit"><a class="ab-item" href="'.$homeURL.'/admin/post-type/'.$postType.'/'.$id.'/edit"><img class="editpage" src="'.asset('edit-page.png').'">Edit Page</a></li>';
            }elseif($postType == 'services'){
                echo '<li id="wp-admin-bar-edit"><a class="ab-item" href="'.$homeURL.'/admin/post-type/'.$postType.'/'.$id.'/edit"><img class="editpage" src="'.asset('edit-page.png').'">Edit Service</a></li>';
            }elseif($postType == 'events'){
                echo '<li id="wp-admin-bar-edit"><a class="ab-item" href="'.$homeURL.'/admin/post-type/'.$postType.'/'.$id.'/edit"><img class="editpage" src="'.asset('edit-page.png').'">Edit Event</a></li>';
            }
        }        
    }
}
/* end get edit url by id */
function get_folder_id_by_folder_slug($folderName){
    if(!empty($folderName)){
        $folderPath = explode("/", $folderName);
        if(!empty($folderPath)){
            $index=1;
            $folderName = NULL;
            foreach($folderPath as $folderPathVal){
                if(!empty($folderPathVal)){
                    if($index == count($folderPath) - 1){
                        $folderName =  $folderPathVal;
                    }
                    $index++;
                }
            }
            if(!empty($folderName)){
                $FolderID = MediaFolder::where('name', '=', $folderName)
                ->get() 
                ->toArray();
                $folder_Id = NULL;
                if(isset($FolderID[0]['id'])){
                    $folder_Id = $FolderID[0]['id'];
                }
                return $folder_Id;
            }
        }
    }
}

